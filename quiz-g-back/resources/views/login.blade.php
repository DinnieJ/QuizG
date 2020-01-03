@extends('layouts.auth_layouts')

@section('form')
<div class="form form-user">
    <h2 class="text-center form-header">Login Admin QuizG</h2>
    <form action="login" method="post" name="login">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputUsername" class="text-uppercase">Username</label>
            <input type="username" name="username" class="form-control" placeholder="" required>

        </div>
        <div class="form-group">
            <label for="exampleInputEmail1" class="text-uppercase">Password</label>
            <input type="password" name="password" class="form-control" placeholder="" required>
        </div>
        <div>
            <button type="submit" class="btn text-uppercase btn-login">Login</button>
        </div>
    </form>
</div>
@endsection