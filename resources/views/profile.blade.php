@extends('layout')

@section('content')
    <h1>Welcome, {{ $student->name }}</h1>

    <h3>Your Courses:</h3>
    <ul>
        @foreach($student->courses as $course)
            <li>{{ $course->name }}</li>
        @endforeach
    </ul>
@endsection
