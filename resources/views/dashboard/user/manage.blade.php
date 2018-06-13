@extends('layouts.app')
@section('content')
<div class="ui stackable grid row">
    <div class="two wide column"></div>
    <div class="twelve wide column cards ui row relaxed grid">
        @if(isset($error))
        <div class="ui icon message">
            <i class="times circle outline icon"></i>
            <div class="content">
                <div class="header">
                    Error
                </div>
                <p>{{ $error }}</p>
            </div>
        </div>
        @endif
        @foreach(\App\User::all() as $user)
        <div class="card five wide column">
            <div class="content">
                <img class="right floated mini ui image" src="http://www.hrzone.com/sites/all/themes/pp/img/default-user.png">
                <div class="header">
                    {{ $user->name }} {{ $user->lastname }}
                </div>
                <div class="meta">
                    {{ "@".$user->username }}
                </div>
                <div class="description">
                    Miembro desde {{ \App\Misc::fancy_date($user->created_at) }}
                </div>
            </div>
            <div class="extra content">
                <div class="ui two buttons">
                    <a href="/user/edit/{{ $user->username }}"  class="ui basic green button"><i class="icon edit"></i> Editar</a>
                    <a href="/user/{{ $user->username }}"  class="ui basic blue button"><i class="icon user"></i> Perfil</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection