@extends('layouts.app')
@section('content')
<div id="edit_user" class="ui grid row">
    <div class="four wide column"></div>
    <div class="eight wide column card ui">
        <div class="content">
            <div class="header">
                {{ $user->name }} {{ $user->lastname }} 
                <i class="{{ $user->superuser == 1 ? 'shield' : '' }} icon"></i>
                @if(session('user')->username  == $user->username)
                <a class="ui button basic red mini" @click="delete_user()">Eliminar mi cuenta</a>
                @else
                <a class="ui button basic red mini" @click="delete_user()">Eliminar cuenta</a>
                @endif
            </div>
            <div class="meta">{{ "@".$user->username }}</div>
            <div class="content">
                <form class="ui form" action="/user/update" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="column">
                            <label for="user">Usuario</label>
                            <input class="ui input" name="username" type="text" placeholder="Usuario" id="user" readonly="readonly" value="{{ $user->username }}">
                        </div>
                    </div>  
                    <div class="row">
                        <div class="column column-50">
                            <label for="name">Nombre</label>
                            <input class="ui input" name="name" type="text" placeholder="Nombre" id="name" value="{{ $user->name }}">
                        </div>
                        
                        <div class="column column-50">
                            <label for="lastname">Apellido</label>
                            <input class="ui input" name="lastname" type="text" placeholder="Apellido" id="lastname" value="{{ $user->lastname }}">
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        @foreach (\App\Profile::where('deleted', false)->get() as $profile)
                        <div class="inline field">
                            <div class="ui checkbox">
                                <input {{ (\App\UserProfiles::check($user->id, $profile->id)) ? 'checked="checked"' : '' }} @click="toggle_profile" profile_id="{{ $profile->id }}" id="{{ $profile->id }}" name="{{ $profile->id }}" type="checkbox" tabindex="0">
                                <label @click="toggle_profile" profile_id="{{ $profile->id }}" for="{{ $profile->id }}">{{ $profile->name }}</label>
                            </div>
                        </div>
                        
                        @endforeach
                    </div>
                    <br />
                    <a href="/profiles" class="ui button teal"><i class="icon add"></i> Gestionar perfiles</a>
                    <div class="ui buttons right floated">
                        <a href="/users" class="ui button red"><i class="icon times"></i> Cancelar</a>
                        <button type="submit" class="ui button green"><i class="icon save"></i> Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    let edit_user = new Vue({
        el: '#edit_user',
        data: {
            link_delete: '/user/delete',
            user: '{{ $user->username }}',
            user_name: '{{ $user->name }}',
            user_lastname: '{{ $user->lastname }}',
            user_id: {{ $user->id }},
        },
        methods: {
            toggle_profile: event => {
                console.log({
                    'active': (document.getElementById(event.target.getAttribute('profile_id')).checked),
                    'profile_id': event.target.getAttribute('profile_id'),
                    'user_id': edit_user.user_id,
                })
                $.ajax({
                    url: '/user/profiles/update',
                    type: 'post',
                    data: {
                        'active': (document.getElementById(event.target.getAttribute('profile_id')).checked == true),
                        'profile_id': event.target.getAttribute('profile_id'),
                        'user_id': edit_user.user_id,
                    },
                    error: (error) => {
                        swal({
                            type: 'error',
                            title: 'Error en el servidor',
                            html: 'Error: <code>'+jQuery.parseJSON(error.responseText).message+'</code>'
                            +'Excepción: <code>'+jQuery.parseJSON(error.responseText).exception+'</code>',
                        })
                    }
                    
                })
            },
            delete_user: () => {
                swal({
                    title: 'Deseas eliminar a ' + edit_user.user_name + " " + edit_user.user_lastname,
                    text: "No podrás recuperar al usuario",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#3085d6',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value){
                        edit_user.loading()
                        $.ajax({
                            url: edit_user.link_delete,
                            type: 'post',
                            data: {'username': edit_user.user},
                            success: (result) => {
                                window.location = '/users'
                            },
                            error: (error) => {
                                swal({
                                    type: 'error',
                                    title: 'Error al eliminar a ' + edit_user.user_name + " " + edit_user.user_lastname,
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
    });
</script>
@endsection
