@extends('layouts.app')
@section('content')
<center id="register" class="row ui grid">
    <div class="column five wide"></div>
    <div class="column six wide card ui">
        <h1>Registro</h1>
        <p>Casa inteligente</p>
        <form class="ui form" action="/user/create" method="POST">@csrf
            <div class="row">
                <div class="column">
                    <label for="user">Usuario</label>
                    <input class="ui input" name="username" type="text" placeholder="Usuario" id="user">
                </div>
            </div>  
            <div class="row">
                <div class="column column-50">
                    <label for="name">Nombre</label>
                    <input class="ui input" name="name" type="text" placeholder="Nombre" id="name">
                </div>
                
                <div class="column column-50">
                    <label for="lastname">Apellido</label>
                    <input class="ui input" name="lastname" type="text" placeholder="Apellido" id="lastname">
                </div>
            </div>
            
            <div class="row">
                <div class="column column-50">
                    <label id="password" for="password">Contraseña</label>
                    <input class="ui input" name="password" type="password" placeholder="Contraseña" id="password" v-model="password">
                </div>
                
                <div class="column column-50">
                    <label id="password_confirm" for="password_confirm">Repite la contraseña</label>
                    <input class="ui input" name="password_confirm" type="password" placeholder="Repite la contraseña" id="password_confirm" v-model="password_confirm">
                </div>
            </div>
            
            <p v-if="password != password_confirm">Las contraseñas no coinciden</p>
            <input v-if="password == password_confirm" class="ui button blue" type="submit" value="Registrar">
            
            <p><a href="/">Regresar</a></p>
        </form>
    </div>
</center>
@endsection
@section('js')
<script>
    let register = new Vue({
        el: '#register',
        data: {
            password_match: false,
            password_confirm: '',
            password: '',
        },
        methods: {
            
        }
    });
</script>
@endsection
