@extends('layouts.default_layouts')

@section('main')
<div class="users-page">
   <histories-group :histories="{{$histories}}" />
</div>
@endsection