@extends('layouts/app')

@section('content')
<div class="bg-white">
    <ul>
        @foreach($todos as $todo)
            <li>{{$todo['title']}}</li>
        @endforeach
    </ul>
</div>
@endsection
