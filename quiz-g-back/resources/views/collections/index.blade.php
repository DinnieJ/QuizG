@extends('layouts.default_layouts')

@section('main')
<div class="users-page">
   <collections-group  :collections="{{$collections}}"/>
</div>
@endsection