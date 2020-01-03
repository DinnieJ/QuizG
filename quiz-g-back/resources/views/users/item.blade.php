@extends('layouts.default_layouts')

@section('main')
<div class="users-page">
   <user-show :user="{{$user}}" :collections="{{$collections}}" :quizzes="{{$quizzes}}" :histories="{{$histories}}" />
</div>
@endsection