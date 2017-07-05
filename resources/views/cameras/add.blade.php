@extends('layouts.app')

@section('title', 'Add Camera')

@section('sidebar')
    @parent
@endsection

@section('content')
<section id="add" class="select">
    <div class="boxed text-center">
        <a class="btn btn-recessed" href="{{ route('add', [ 'manual' ]) }}"><span>Manual Setup</span></a>
        <a class="btn btn-recessed" href="{{ route('add', [ 'scan' ]) }}"><span>Scan for Cameras<span></a>
    </div>
</section>
@endsection