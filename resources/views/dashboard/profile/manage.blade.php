@extends('layouts.app')
@section('content')
<div class="ui stackable grid row">
    <div class="two wide column"></div>
    <div class="twelve wide column cards">
        <a href="/profile/new" class="ui right floated button green"><i class="icon plus"></i> Nuevo</a>
    </div>
    
</div>

<div class="ui stackable grid row">
    
    <div class="two wide column"></div>
    <div class="twelve wide column cards ui row">
        
        @if ( \App\Profile::where('deleted', false)->get()->count() == 0 ) 
        <div class="ui icon message">
            <i class="times circle outline icon"></i>
            <div class="content">
                <div class="header">
                    No hay perfiles creados
                </div>
                <p>Pero puedes <a href="/profile/new">crear uno</a></p>
            </div>
        </div>
        @else
        
        @endif
        @foreach(\App\Profile::where('deleted', false)->get() as $profile)
        <div class="card five wide column">
            <div class="content">
                <div class="header">
                    {{ $profile->name }}
                </div>
                <div class="meta">
                    Creado por: {{ "@".\App\User::find($profile->user_id)->username }}
                </div>
                <div class="description">
                    {{ $profile->description }}
                </div>
            </div>
            <div class="extra content">
                <div class="ui two buttons">
                    <a href="/profile/edit/{{ $profile->id }}" class="ui basic green button"><i class="icon edit"></i> Editar</a>
                    <a href="/profile/{{ $profile->id }}" class="ui basic blue button"><i class="icon eye"></i> Ver</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection