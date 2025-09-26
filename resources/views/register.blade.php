@extends('layouts.auth')

@section('content')
    <form action="{{route ('register.submit') }}" method="post">
        @csrf
    <label for="username">username</label>
    <input type="text" name="username">
    <label for="email">email</label>
    <input type="email" name="email" >
    <label for="password">password</label>
    <input type="password" name="password">
    <button type= "submit">MASUK</button>
    </form>
    @endsection