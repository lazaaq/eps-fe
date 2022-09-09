<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\TryoutUser;
use Carbon\Carbon;
use Auth;
use Str;
use DB;

class TryOutController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->session()->all());
        try {
            $quiz_id = Str::replaceFirst(session()->getId(), '', $request->session);
            $quiz = Quiz::findOrFail($quiz_id);
            $checkTryout = TryoutUser::where('quiz_id',$quiz->id)->where('collager_id',Auth::user()->collager->id)->first();

            // if ($request->session == NULL || !empty($checkTryout)) {
            //     $request->session()->forget(['user-quiz','page-load','first-time-quiz']);
            //     abort();
            // }

            $readingSection = Question::with('answer')->whereHas('quiz', function($query) use($quiz){
                $query->where('id',$quiz->id)->whereNull('audio_url');
            })->orderBy('id')->get();
            $audioSection = Question::with('answer')->whereHas('quiz', function($query) use($quiz){
                $query->where('id',$quiz->id)->whereNotNull('audio_url');
            })->orderBy('id')->get();

            // $questionList = $readingSection->merge($audioSection);
            $questionListReading = $readingSection;
            $questionListListening = $audioSection;

            $data = '';
            $path = ['path'=>'try-out'];

            // first time take tryout
            if (!session()->has('user-quiz')) {

                //random
                // $randomQuestionReading = $readingSection->shuffle();
                // $randomQuestionListening = $audioSection->shuffle();

                //no random
                $randomQuestionReading = $readingSection;
                $randomQuestionListening = $audioSection;

                // array question reading for session
                $questionReading = $randomQuestionReading->pluck('id')->toArray();
                $questionListening = $randomQuestionListening->pluck('id')->toArray();

                // pagination
                $data = $this->paginateCollection($randomQuestionReading,1,NULL,$path);

                // store session
                session(['first-time-quiz-reading'=>true]);
                session(['user-quiz.section'=> 'membaca']);

                session(['user-quiz.start-time-reading' => Carbon::now()->format('Y-m-d H:i:s')]);
                session(['user-quiz.end-time-reading' => Carbon::now()->addMinutes($quiz->timer_quiz/2)->format('Y-m-d H:i:s')]);

                session(['user-quiz.start-time-listening' => Carbon::parse(session('user-quiz.end-time-reading'))->format('Y-m-d H:i:s')]);
                session(['user-quiz.end-time-listening' => Carbon::parse(session('user-quiz.end-time-reading'))->addMinutes($quiz->timer_quiz/2)->format('Y-m-d H:i:s')]);

                session(['user-quiz.quiz_id' => $quiz->id]);
                session(['user-quiz.timer' => $quiz->timer_quiz/2 * 60]);

                session(['user-quiz.question-reading-id'=>$questionReading]);
                session(['user-quiz.question-listening-id'=>$questionListening]);

                foreach ($randomQuestionReading as $key => $value) {
                    $option = ['question_id'=>$value->id,'option_id'=>NULL,'option'=>NULL];
                    $no = (int) $key+1;
                    $request->session()->push('user-quiz.answer-reading.'.($no), $option);
                }
                foreach ($randomQuestionListening as $key => $value) {
                    $option = ['question_id'=>$value->id,'option_id'=>NULL,'option'=>NULL];
                    $no = (int) $key+1;
                    $request->session()->push('user-quiz.answer-listening.'.($no), $option);
                }
                $request->session()->forget('page-load');
            } else { // after (page load ect)
                if (session('user-quiz.section') == 'membaca') {
                    // reordering
                    $arrayQuestion = session('user-quiz.question-reading-id');
                    $question = $questionListReading->whereIn('id',session('user-quiz.question-reading-id'))->values();
                    $sorted = $question->map(function($item, $key) use($arrayQuestion) {
                        $id = $arrayQuestion[$key];
                        return $item->with('answer')->where('id',$id)->first();
                    });
                } elseif (session('user-quiz.section') == 'mendengarkan') {
                    // reordering
                    $arrayQuestion = session('user-quiz.question-listening-id');
                    $question = $questionListListening->whereIn('id',session('user-quiz.question-listening-id'))->values();
                    $sorted = $question->map(function($item, $key) use($arrayQuestion) {
                        $id = $arrayQuestion[$key];
                        return $item->with('answer')->where('id',$id)->first();
                    });
                }
                // pagination
                $data = $this->paginateCollection($sorted,1,NULL,$path);
            }
            // pagination query parameter
            $data->appends(['session' => $request->session]);

            $section = session('user-quiz.section') == 'membaca' ? 'reading':'listening';

        } catch (\Throwable $th) {
            abort(404);
        }
        return view('tryout.index',compact('data','quiz','section'));
    }

    public function updateData(Request $request, $id)
    {
        switch ($request->tipe) {
            case 'update':
                if ($request->sisa_waktu == 0 && session('user-quiz.section') == 'membaca') {
                    session(['user-quiz.section'=>'mendengarkan']);
                    session(['first-time-quiz-listening'=>true]);
                } else {
                    // session(['user-quiz.timer' => $request->sisa_waktu]);
                }
                break;
            case 'delete':
                $request->session()->forget(['user-quiz','page-load','first-time-quiz']);
                break;
        }
        // return $request->session()->all();
    }

    public function storeAnswer(Request $request, $id)
    {
        if (session('user-quiz.section') == 'membaca') {
            $option = $request->session()->pull('user-quiz.answer-reading.'.$request->question_no);
            if (empty($option) || $option[0]['option'] != $request->option) {
                $option = ['question_id'=>$request->question_id,'option_id'=>$request->option_id,'option'=>$request->option];
                $request->session()->push('user-quiz.answer-reading.'.$request->question_no, $option);
            }
        } elseif (session('user-quiz.section') == 'mendengarkan') {
            $option = $request->session()->pull('user-quiz.answer-listening.'.$request->question_no);
            if (empty($option) || $option[0]['option'] != $request->option) {
                $option = ['question_id'=>$request->question_id,'option_id'=>$request->option_id,'option'=>$request->option];
                $request->session()->push('user-quiz.answer-listening.'.$request->question_no, $option);
            }
        }
        return response()->json('success');
    }

    public function submit(Request $request)
    {
        $data = session('user-quiz');
        DB::transaction(function () use($data) {
            $userAnswer = [];

            // sort by number
            ksort($data['answer-reading']);
            ksort($data['answer-listening']);
            $mergeAnswer = array_merge($data['answer-reading'],$data['answer-listening']);

            foreach ($mergeAnswer as $key => $answer) {
                $trueOption = Answer::where('question_id',$answer[0]['question_id'])->where('isTrue','1')->first()->option;
                // $answer[0]['option'] == $trueOption ? $skor++ : '';
                $userAnswer[] = ['question_id'=> $answer[0]['question_id'],
                                'collager_answer'=> $answer[0]['option'],
                                'isTrue'=> $answer[0]['option'] == $trueOption ? 1 : 0,
                                'score'=> $answer[0]['option'] == $trueOption ? (@comValue('SCORE_TRYOUT_1')?:1) : 0];
            }
            $tryout = new TryoutUser;
            $tryout->quiz_id = $data['quiz_id'];
            $tryout->collager_id = Auth::user()->collager->id;
            $tryout->total_score = array_sum(array_column($userAnswer,'score'));
            $tryout->save();
            $tryout->answer()->createMany($userAnswer);
        });
        return response()->json(['hasil'=>Auth::user()->collager->tryout->last()->id]);
    }

    public function data(Request $request, $id)
    {
        // $second = session('user-quiz.timer');
        $second = Quiz::find($id)->timer_quiz/2 * 60;
        $section = session('user-quiz.section');
        $quiz_id = session('user-quiz.quiz_id');

        if ($request->session()->has('first-time-quiz-reading')) {
            $second = $second;
            $request->session()->forget('first-time-quiz-reading');
        } elseif($request->session()->has('first-time-quiz-listening')) {
            $second = Quiz::find($id)->timer_quiz/2 * 60;
            $request->session()->forget('first-time-quiz-listening');
        } else {
            // if ($request->session()->has('page-load')) {
                if ($section == 'membaca') {
                    $startTime = Carbon::parse(session('user-quiz.start-time-reading'));
                    $endTime = Carbon::parse(session('user-quiz.end-time-reading'));
                    if (Carbon::now()->between($startTime,$endTime)) {
                        $second = Carbon::now()->diffInSeconds($endTime);
                    } else {
                        $second = Quiz::find($quiz_id)->timer_quiz/2 * 60;
                        session(['user-quiz.section'=>'mendengarkan']);
                    }
                } elseif ($section == 'mendengarkan') {
                    $startTime = Carbon::parse(session('user-quiz.start-time-listening'));
                    $endTime = Carbon::parse(session('user-quiz.end-time-listening'));
                    if (Carbon::now()->between($startTime,$endTime)) {
                        $second = Carbon::now()->diffInSeconds($endTime);
                    } else {
                        $second = 0;
                    }
                }
                // $request->session()->forget('page-load');
            // } else {
            //     $second = $second;
            // }
        }
        return response()->json(['time'=>$second,'section'=>$section]);
    }

    public function checkUser(Request $request)
    {
        $startTime = Carbon::parse(session('user-quiz.start-time-reading'));
        $endTime = Carbon::parse(session('user-quiz.end-time-reading'));
        if (!Carbon::now()->between($startTime,$endTime) && session('user-quiz.section') == 'membaca') {
            session(['user-quiz.section'=>'mendengarkan']);
        }
        session(['page-load'=>'first']);
        $id = session('user-quiz.quiz_id');
        $cek = $request->session()->has('user-quiz');
        $kuis = Quiz::find($id);
        return response()->json(['cek'=>$cek,'kuis'=>$kuis,'id'=>$id]);
    }

    public function paginateCollection($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (\Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof \Illuminate\Support\Collection ? $items : \Illuminate\Support\Collection::make($items);
        return new \Illuminate\Pagination\LengthAwarePaginator(array_values($items->forPage($page, $perPage)->toArray()), $items->count(), $perPage, $page, $options);
    }
}
