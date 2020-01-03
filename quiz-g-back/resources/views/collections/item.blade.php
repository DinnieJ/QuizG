@extends('layouts.default_layouts')

@section('main')
<div class="users-page">
   <collection-show :collection="{{$collection}}" />
</div>
@endsection