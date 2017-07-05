@extends('layouts.app')

@section('title', 'Scan for Camera')

@section('sidebar')
    @parent
@endsection

@section('content')
<section id="add" class="select">
    <div class="boxed">
        Range: {{ $range }}.2 - {{ $range }}.255
    </div>
</section>
@endsection