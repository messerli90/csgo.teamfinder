@extends('layouts.master')

@section('content')
<h1>Index</h1>

<p><a href="{{ action('UserController@index') }}">Users</a></p>
<p><a href="{{ action('PostController@index') }}">Posts</a></p>

@stop