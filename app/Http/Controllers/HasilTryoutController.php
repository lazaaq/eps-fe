<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TryoutUser;
use Auth;
use PDF;

class HasilTryoutController extends Controller
{
    public function index()
    {
        $data = TryoutUser::where('collager_id',Auth::user()->collager->id)->orderBy('created_at','desc')->get();
        return view('hasil-tryout.index',compact('data'));
    }

    public function show(Request $request, $id)
    {
        $data = TryoutUser::with('answer')->where('collager_id',Auth::user()->collager->id)->findOrFail($id);
        return view('hasil-tryout.detail',compact('data'));
    }

    public function generatePDF(Request $request, $id)
    {
        $data = TryoutUser::with('answer')->where('collager_id',Auth::user()->collager->id)->findOrFail($id);
        $pdf = PDF::loadView('hasil-tryout.pdf', compact('data'));
        return $pdf->download('Hasil '.$data->quiz->title.' | '.Auth::user()->name.'.pdf');
    }
}
