@extends('layout')
@section('content')
    <h2>{{$quiz->name}}</h2>
    <form action="{{route('quiz.store', $quiz->id)}}" method="post">
        {{ csrf_field() }}
        <input name="page" value="{{$page}}" hidden>
        @foreach($questions as $question)
            <div class="mt-2 text-gray-600 dark:text-gray-400">
                <p>{{ $question->title }}</p>
                @foreach($question->answers as $answer)
                    <div class="input-group mt-1">
                        <div class="input-group-text">
                            @if($question->isMultipleChoice)
                                <input
                                    @if(isset($previousAnswers[$question->id])) {{ in_array($answer->id, $previousAnswers[$question->id]) ? "checked" : "" }} @endif class="form-check-input mt-0"
                                    type="checkbox" name="{{$question->id}}[]"
                                    value="{{$answer->id}}">
                            @else
                                <input
                                    @if(isset($previousAnswers[$question->id])) {{ $answer->id == $previousAnswers[$question->id] ? "checked" : "" }} @endif class="form-check-input mt-0"
                                    type="radio" name="{{$question->id}}"
                                    value="{{$answer->id}}">
                            @endif
                        </div>
                        <p class="form-control m-0" aria-label="Text input with radio button">{{$answer->title}}</p>
                    </div>
                @endforeach
            </div>
        @endforeach
        <div class="d-flex justify-content-between mt-2">
            <input type="submit" name="action" class="btn btn-secondary" value="Previous">

            <input type="submit" name="action" class="btn btn-primary" value="Next">
        </div>
    </form>


@endsection

