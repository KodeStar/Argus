@extends('layouts.app')

@section('title', 'Setup')

@section('sidebar')
    @parent
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <i class="icon-warning"></i>
        <div class="alert-title">Error running setup</div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form class="style" method="POST" action="/setup">
        {{ csrf_field() }}
        <div class="inputrow">
            <label>Backend</label>
            <select name="backend">
                <option value="zoneminder">ZoneMinder</option>
            </select>
        </div>
        <div class="inputrow">
            <label>Backend Location</label>
            <input type="text" name="backend_location" placeholder="eg http://192.168.0.20:8081" value="" />
        </div>
        <button type="submit" class="btn">Install</button>
    </form>
@endsection