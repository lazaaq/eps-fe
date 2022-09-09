<!DOCTYPE html>
<html lang="ko">
<head  >
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RUKO - Hasil Test</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100&display=swap" rel="stylesheet">
    
</head>
<style>

.my-table {
  font-family:  Arial, Helvetica, sans-serif,;
  border-collapse: collapse;
  width: 100%;
}

.my-table td, .my-table th {
  border: 1px solid #ddd;
  padding: 8px;
}

.my-table tr:nth-child(even){background-color: #f2f2f2;}

.my-table tr:hover {background-color: #ddd;}

.my-table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #7ac6c4;
  color: white;
}

</style>
<body>
    <div class="d-flex flex-column mb-2">
        <strong>Hasil  {{$data->quiz->title}} | {{Auth::user()->name}}</strong>
        <br>
        <strong class="text-muted">Tanggal: {{$data->created_at->isoFormat('D MMMM Y H:MM')}}</strong>
    </div>
    <div style="margin-top:10px">
        <div>Skor  : {{$data->total_score}} </div>
        <div>Benar : {{$data->answer->where('isTrue',1)->count()}} </div>
        <div>Salah : {{$data->answer->where('isTrue',0)->count()}}</div>  
    </div>
    <table class="my-table" style="margin-top:20px">
        <thead class="bg-lightblue">
            <tr>
                <th width="30">No</th>
                <th>Soal</th>
                <th>Kunci Jawaban</th>
                <th>Jawaban Anda</th>
                <th width="50">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data->answer as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td style="font-style: 'Noto Sans KR', sans-serif;">
                        @if($item->question->audio_url == NULL)
                        {{$item->question->question}}
                        @else
                        [soal mendengarkan]
                        @endif
                    </td>
                    <td>{{$item->question->answer->where('isTrue',1)->first()->option .'. '.$item->question->answer->where('isTrue',1)->first()->content}}</td>
                    <td>{{$item->collager_answer ? $item->collager_answer .'. '.$item->question->answer->where('option',$item->collager_answer)->first()->content : '-'}}</td>
                    <td>
                        @if($item->isTrue)
                            Benar
                        @else
                            Salah
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>