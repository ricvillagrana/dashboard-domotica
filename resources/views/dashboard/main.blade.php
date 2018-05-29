@extends('layouts.app')
@section('content')
<div class="ui grid row">
    <div class="one wide column"></div>
    <div class="four wide column card ui">
        <div class="content">
            <div class="header">Perfiles</div>
            <div class="meta">Perfiles registrados</div>
            <div class="content">
                <ul>
                    @if(count(\App\Profile::all())>0)
                    @foreach (\App\Profile::all() as $profile)
                    <li>{{ $profile->name }}</li>
                    @endforeach
                    @else
                    @if(session('user')->superuser)
                    <h5>No hay perfiles, <a href="/profile/new">crea uno.</a></h5>
                    @else
                    <h5>No hay perfiles.</h5>
                    @endif
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="one wide column"></div>
    
    <div class="four wide column card ui">
        <div class="content">
            <div class="header">Acciones</div>
            <div class="meta">Acciones que se administran</div>
            <div class="content">
                <ul>
                    @if(count(\App\Actions::all())>0)
                    @foreach (\App\Actions::all() as $action)
                    <div class="ui comments">
                        <div class="comment">
                            <div class="content">
                                <a class="author">{{ $action->name }}</a><br />
                                <div class="metadata">
                                    <div class="date">Creado el {{ \App\Misc::fancy_date($action->created_at) }}</div>
                                </div>
                                <div class="text">
                                    {{ $action->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <h5>No hay acciones para administrar.</h5>
                    @endif      
                </ul>
            </div>
        </div>
    </div>

    <div class="one wide column"></div>
    
    <div class="four wide column card ui">
        <div class="content">
            <div class="header">Usuarios</div>
            <div class="meta">Usuario que están registrados en el sistema</div>
            <div class="content">
                <ul>
                    @if(count(\App\User::all())>0)
                    @foreach (\App\User::all() as $user)
                    <div class="ui comments">
                        <div class="comment">
                            <div class="content">
                                <a href="/user/{{ $user->username }}" class="author">{{ $user->name }} {{ $user->lastname }}</a><br />
                                <div class="metadata">
                                    <b>{{ $user->username }}</b> · 
                                    <div class="date">Se unió el {{ \App\Misc::fancy_date($user->created_at) }}</div>
                                </div>
                                <div class="text">
                                    {{ $user->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <h5>No hay acciones para administrar.</h5>
                    @endif      
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection