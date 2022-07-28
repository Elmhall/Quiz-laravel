@extends('layout')
@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="p-6">
            @foreach($quizzes as $quiz)
                <h2>{{$quiz->name}}</h2>
                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                    {{$quiz->description}}
                    <a href="{{ route('quiz.show', $quiz->id) }}" class="btn btn-primary btn-block">Goto Quiz</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
