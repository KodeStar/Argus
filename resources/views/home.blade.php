@extends('layouts.app')

@section('title', 'Dashboard')

@section('sidebar')
    @parent
    <p>3</p>
@endsection

@section('content')
    <div id="cameralist">
    @if(count($cameras) > 1)
        @foreach ($cameras as $camera)
            @include('cameras/list')
        @endforeach
    @else
        <div class="boxed">
        No cameras currently added, add one now?
        </div>
    @endif
    </div>
@endsection