@extends('layouts.default_layouts')

@section('main')
<div class="users-page">
   <quizzes-group :quizzes="{{$quizzes}}" />
</div>
@endsection