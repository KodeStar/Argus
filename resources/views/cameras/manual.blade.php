@extends('layouts.app')

@section('title', 'Manually Add Camera')

@section('sidebar')
    @parent
@endsection

@section('content')
    <form class="boxed" method="POST" action="/setup">
        {{ csrf_field() }}
        <div class="inputrow">
            <label>Name</label>
            <input type="text" name="name" placeholder="eg http://192.168.0.20" value="" />
        </div>
        <div class="inputrow">
            <label>IP Address</label>
            <input type="text" name="ip" placeholder="eg http://192.168.0.20" value="" />
        </div>
        <div class="inputrow">
            <label>IP Address</label>
            <input type="text" name="ip" placeholder="eg http://192.168.0.20" value="" />
        </div>
        <button type="submit" class="btn">Install</button>
    </form>@endsection