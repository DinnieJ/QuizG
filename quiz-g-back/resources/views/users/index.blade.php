@extends('layouts.default_layouts')

@section('main')
<div class="users-page">
<users-group :users="{{$users}}"/>
</div>
@endsection