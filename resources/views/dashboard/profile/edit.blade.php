@extends('layouts.app')
@section('content')
<div id="profile" class="ui grid row">
    <div class="four wide column"></div>
    <div class="eight wide column card ui">
        <h1 class="ui dividing header">
            Editar de perfil
            <a class="ui button basic red mini" @click="delete_profile">Eliminar mi perfil</a>
        </h1>
        <form class="ui form" action="/profile/update" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $profile->id }}">
            <div class="ui grid row">
                <div class="eight wide column">
                    <label for="name">Nombre del perfil</label>
                    <input class="ui input" type="text" name="name" placeholder="Nombre del perfil" value="{{ $profile->name }}">
                </div>
                <div class="eight wide column">
                    <label for="temperature">Temperatura preferida</label>
                    <input class="ui input" type="number" name="temperature" placeholder="Temperatura preferida" value="{{ $profile->temperature }}">
                </div>
            </div>
            
            
            <h3 class="ui dividing header">Horarios de actividad</h3>
            <div class="ui grid row">
                <div class="six wide column">
                    <label for="time_start">Hora de inicio</label>
                    <input id="time_start" class="ui input" type="time" name="time_start" placeholder="Hora de inicio" value="{{ $profile->time_start }}">
                </div>
                <div class="six wide column">
                    <label for="time_finish">Hora de finalización</label>
                    <input id="time_finish" class="ui input" type="time" name="time_finish" placeholder="Hora de finalización" value="{{ $profile->time_finish }}">
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
                    <input class="ui input" type="time" name="sleep_start" placeholder="Hora de inicio" value="{{ $profile->sleep_start }}">
                </div>
                <div class="six wide column">
                    <label for="time_finish">Hora de finalización</label>
                    <input class="ui input" type="time" name="sleep_finish" placeholder="Hora de finalización" value="{{ $profile->sleep_finish }}">
                </div>
            </div>
            <div class="ui grid row">
                <div class="sixteen wide column">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" cols="30" rows="5">{{ $profile->description }}</textarea>
                </div>
            </div>
            <br />
            <input class="ui button green right floated" type="submit" value="Guardar">
            <a class="ui button red right floated" href="/profiles">Cancelar</a>
        </form>
    </div>
</div>
@endsection
@section('js')
<script>
    let profile = new Vue({
        el: '#profile',
        data: {
            link_delete: '/profile/delete',
            name: '{{ $profile->name }}',
            id: '{{ $profile->id }}'
            
        },
        methods: {
            active_always: () => {
                document.getElementById('time_start').value = "00:00"
                document.getElementById('time_finish').value = "23:59"
            },
            delete_profile: () =>{
            swal({
                title: 'Deseas eliminar a ' + profile.name,
                text: "No podrás recuperar el perfil",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.value){
                    profile.loading()
                    $.ajax({
                        url: profile.link_delete,
                        type: 'post',
                        data: {'id': profile.id},
                        success: (result) => {
                            window.location = '/profiles'
                            //swal(result)
                        },
                        error: (error) => {
                            swal({
                                type: 'error',
                                title: 'Error al eliminar a ' + profile.name,
                                html: 'Error: <code>'+jQuery.parseJSON(error.responseText).message+'</code>'
                                +'Excepción: <code>'+jQuery.parseJSON(error.responseText).exception+'</code>',
                            })
                        }
                        
                    })
                }
            })
        },
        loading: () => {
            swal({
                title: 'Ejecutando...',
                onOpen: () => {
                    swal.showLoading()
                }
            })
        }
    }
})
</script>
@endsection