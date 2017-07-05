@extends('layouts.app')

@section('title', 'Dashboard')

@section('sidebar')
    @parent
    <p>3</p>
@endsection

@section('content')
    @if(count($cameras) > 1)
        @foreach ($cameras as $camera)
            @include('cameras/list')
        @endforeach
    @else
        No cameras available, add one now?
    @endif
@endsection