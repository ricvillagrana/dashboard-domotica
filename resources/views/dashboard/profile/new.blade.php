@extends('layouts.app')
@section('content')
<div id="profile" class="ui grid row">
    <div class="four wide column"></div>
    <div class="eight wide column card ui">
        <h1 class="ui dividing header">Registro de perfil</h1>
        <form class="ui form" action="/profile/create" method="POST">
            {{ csrf_field() }}
            <div class="ui grid row">
                <div class="eight wide column">
                    <label for="name">Nombre del perfil</label>
                    <input class="ui input" type="text" name="name" placeholder="Nombre del perfil">
                </div>
                <div class="eight wide column">
                    <label for="temperature">Temperatura preferida</label>
                    <input class="ui input" type="number" name="temperature" placeholder="Temperatura preferida" value="23">
                </div>
            </div>
            
            
            <h3 class="ui dividing header">Horarios de actividad</h3>
            <div class="ui grid row">
                <div class="six wide column">
                    <label for="time_start">Hora de inicio</label>
                    <input id="time_start" class="ui input" type="time" name="time_start" placeholder="Hora de inicio">
                </div>
                <div class="six wide column">
                    <label for="time_finish">Hora de finalización</label>
                    <input id="time_finish" class="ui input" type="time" name="time_finish" placeholder="Hora de finalización">
                </div>
                <div class="four wide column">
                    <br />
                    <a @click="active_always" class="ui button gray large">Siempre</a>
                </div>
            </div>
            <h3 class="ui dividing header">Horarios de sueño</h3>
            <div class="ui grid row">
                    <div class="six wide column">
                        <label for="time_start">Hora de inicio</label>
                        <input class="ui input" type="time" name="sleep_start" placeholder="Hora de inicio">
                    </div>
                    <div class="six wide column">
                        <label for="time_finish">Hora de finalización</label>
                        <input class="ui input" type="time" name="sleep_finish" placeholder="Hora de finalización">
                    </div>
                </div>
            <div class="ui grid row">
                <div class="sixteen wide column">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" cols="30" rows="5"></textarea>
                </div>
            </div>
            <br />
            <input class="ui button green right floated" type="submit" value="Guardar">
            <a class="ui button red right floated" href="/">Cancelar</a>
        </form>
    </div>
</div>
@endsection
@section('js')
<script>
    let profile = new Vue({
        el: '#profile',
        data: {
        },
        methods: {
            active_always: () => {
                document.getElementById('time_start').value = "00:00"
                document.getElementById('time_finish').value = "23:59"
            }
        },
    })
</script>
@endsection