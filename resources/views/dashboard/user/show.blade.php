@extends('layouts.app')
@section('content')
<div class="ui grid row">
    <div class="four wide column"></div>
    <div class="eight wide column card ui">
        <div class="content">
            <div class="ui dividing header">{{ $user->name }} {{ $user->lastname }} <i class="{{ $user->superuser == 1 ? 'shield' : '' }} icon"></i></div>
            <div class="meta">{{ "@".$user->username }}</div>
            <div class="content">
                <p>Se unió el {{ \App\Misc::fancy_date($user->created_at) }}</p>
            </div>
            <h3 class="ui dividing header">Perfiles que puede administrar:</h3>
            @foreach (\App\Profile::ofUser($user->id)->where('deleted', false)->get() as $profile)
            <div class="inline field">
                <div class="ui checkbox">
                    <p>{{ $profile->name }}</p>
                </div>
            </div>
            @endforeach
            <h3 class="ui dividing header">Log de actividad:</h3>
            
            <div class="ui relaxed list">
                @foreach (\App\ProfileLog::where('user_id', $user->id)->orderBy('created_at', 'desc')->get() as $log)
                @php ($profile = \App\Profile::find($log->profile_id))
                <div class="item">
                    <div class="content" data-content="{{ $profile->description }}">
                        <a href="/profile/{{ $profile->id }}" class="header">{{ $profile->name }}</a>
                        <p class="description">
                            el {{ \App\Misc::fancy_datetime($profile->created_at) }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection