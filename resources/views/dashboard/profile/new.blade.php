@extends('layouts.app')
@section('content')
<div class="ui grid row">
    <div class="four wide column"></div>
    <div class="eight wide column card ui">
        <h1 class="ui dividing header">Registro de perfil</h1>
        <form class="ui form" action="/profile/create" method="POST">
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
                    <input class="ui input" type="time" name="time_start" placeholder="Hora de inicio">
                </div>
                <div class="six wide column">
                    <label for="time_finish">Hora de finalización</label>
                    <input class="ui input" type="time" name="time_finish" placeholder="Hora de finalización">
                </div>
                <div class="four wide column">
                    <br />
                    <a class="ui button gray large">Siempre</a>
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