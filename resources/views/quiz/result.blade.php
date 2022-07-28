@extends('layout')
@section('content')

    <div>
        <h2 class="text-center">Your score is {{ $score }} / {{ $quiz->questions->count() }}</h2>


        <div class="accordion accordion-flush" id="accordion">
            @foreach($quiz->questions as $index => $question)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading{{$index}}">
                        <button
                            class="accordion-button collapsed {{ in_array($question->id, $correctQuestionsArray) ? "text-success" : "text-danger" }}"
                            type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse{{$index}}" aria-expanded="false"
                            aria-controls="flush-collapseOne">
                            Question #{{ $index + 1 }} - {{ $question->title }}
                        </button>
                    </h2>
                    <div id="flush-collapse{{$index}}" class="accordion-collapse collapse"
                         aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            @foreach($question->answers as $answer)
                                <div class="input-group mt-1 {{$answer->isCorrect ? 'border border-success' : ''}}">
                                    <div class="input-group-text">
                                        @if($question->isMultipleChoice)
                                            <input
                                                @if(isset($previousAnswers[$question->id])) {{ in_array($answer->id, $previousAnswers[$question->id]) ? "checked" : "" }} @endif class="form-check-input mt-0"
                                                type="checkbox" name="{{$question->id}}[]"
                                                value="{{$answer->id}}" disabled>
                                        @else
                                            <input
                                                @if(isset($previousAnswers[$question->id])) {{ $answer->id == $previousAnswers[$question->id] ? "checked" : "" }} @endif class="form-check-input mt-0"
                                                type="radio" name="{{$question->id}}"
                                                value="{{$answer->id}}" disabled>
                                        @endif
                                    </div>
                                    <p class="form-control m-0"
                                       aria-label="Text input with radio button">{{$answer->title}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <a href="{{route('quiz.index')}}" class="btn btn-primary">Back to home</a>
    </div>
@endsection

