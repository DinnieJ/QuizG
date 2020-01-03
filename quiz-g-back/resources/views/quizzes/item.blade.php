@extends('layouts.default_layouts')

@section('main')
<div>
   <quiz-show :quiz="{{$quiz}}" />
</div>
@endsection