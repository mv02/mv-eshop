@extends('layout')

@section('content')
    {{ auth()->user()->email }}
@endsection