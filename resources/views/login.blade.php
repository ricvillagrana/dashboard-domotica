@extends('layouts.app')
@section('content')
<center class="ui grid">
    <div class="column five wide"></div>
    
    <div class="column six wide ui card top">
        <h1>Login</h1>
        <p>Casa inteligente</p>
        @if(session('error'))
        <blockquote>
            <div class="ui icon message">
                <div class="content">
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        </blockquote>
        @endif
        <form class="ui form" action="/auth" method="POST">@csrf
            <label for="user">Usuario</label>
            <input class="ui input" name="username" type="text" placeholder="Usuario" id="user">
            <label for="password">Contraseña</label>
            <input class="ui input" name="password" type="password" placeholder="Contraseña" id="password">
            <input class="ui button blue" type="submit" value="Entrar">
            <p>Si no tienes cuenta, <a href="/register">Regístrate</a></p>
        </form>
    </div>
</center>
@endsection