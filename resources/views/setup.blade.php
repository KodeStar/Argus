@extends('layouts.app')

@section('title', 'Setup')

@section('sidebar')
    @parent
@endsection

@section('content')

    <form class="boxed" method="POST" action="/setup">
        {{ csrf_field() }}
        <div class="inputrow">
            <label>Backend</label>
            <select name="backend">
                @foreach($available_backends as $interface => $backend)
                <option value="{{ $interface }}">{{ $backend['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="inputrow">
            <label>Backend Location</label>
            <input type="text" name="backend_location" placeholder="eg http://192.168.0.20:8081" value="" />
        </div>
        <div class="inputrow">
            <label>Backend Username (if any)</label>
            <input type="text" name="backend_username" placeholder="If any" value="" />
        </div>
        <div class="inputrow">
            <label>Backend Password (if any)</label>
            <input type="text" name="backend_password" placeholder="If any" value="" />
        </div>
        <button type="submit" class="btn">Install</button>
    </form>
@endsection