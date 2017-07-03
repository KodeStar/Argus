@extends('layouts.app')

@section('title', 'Dashboard')

@section('sidebar')
    @parent
    <p>3</p>
@endsection

@section('content')
    @foreach ($cameras as $camera)
        @include('cameras/list')
    @endforeach
@endsection