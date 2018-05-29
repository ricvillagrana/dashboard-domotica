@extends('layouts.app')
@section('content')
<div class="ui grid row">
    <div class="four wide column"></div>
    <div class="eight wide column card ui">
        <div class="content">
            <div class="header">{{ $user->name }} {{ $user->lastname }} <i class="{{ $user->superuser == 1 ? 'shield' : '' }} icon"></i></div>
            <div class="meta">{{ $user->username }}</div>
            <div class="content">
                    
            </div>
        </div>
    </div>
</div>
@endsection