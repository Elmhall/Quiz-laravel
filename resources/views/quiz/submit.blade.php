@extends('layout')
@section('content')
    <h2>{{$quiz->name}}</h2>
    <form action="{{route('quiz.create', $quiz->id)}}" method="post">
        {{ csrf_field() }}

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label for="emailInput" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="emailInput">
        </div>
        <div class="mb-3">
            <label for="nameInput" class="form-label">Full name</label>
            <input type="text" name="name" class="form-control" id="nameInput">
        </div>

        <div class="d-flex justify-content-between mt-2">
            <a class="btn btn-secondary" href="{{ route('quiz.show', ['name' => $quiz->id]) }}">Go back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

@endsection

