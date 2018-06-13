@extends('layouts.app')
@section('content')
<div id="main">
    <div class="ui grid row">
        
        <div class="two wide column"></div>
        <div class="twelve wide column card ui">
            <div class="content">
                <div class="header">Configuración actual</div>
                <div class="meta"></div>
                <div class="description">
                    <div class="ui horizontal list huge divided">
                        <div class="item">
                            <h2 class="ui icon header">
                                <div class="content">
                                    <p>Perfil activo: @{{ profile }}</p>
                                    <div class="sub header">@{{ description }}</div>
                                </div>
                            </h2>
                        </div>
                        <div class="item">
                            <h2 class="ui icon header">
                                <div class="content">
                                    <p>Horas de actividad</p>
                                    <div class="sub header">@{{ time_start }} a @{{ time_finish }}</div>
                                </div>
                            </h2>
                        </div>
                        <div class="item">
                            <h2 class="ui icon header">
                                <div class="content">
                                    <p>Horas de sueño</p>
                                    <div class="sub header">
                                        @{{ sleep_start }} a @{{ sleep_finish }}
                                    </div>
                                </div>
                            </h2>
                        </div>
                        <div class="item">
                            <h2 class="ui icon header">
                                <div class="content">
                                    <p>Temperatura preferida</p>
                                    <div class="sub header">
                                        @{{ temperature }} °C
                                    </div>
                                </div>
                            </h2>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="extra content">
                <i class="clock icon"></i>
                Última modificación por <a :href="mod_user_link">@{{ mod_user }}</a> el @{{ mod_date }} a las @{{ mod_hour }}
            </div>
        </div>
        <div class="ui grid row">
            <div class="one wide column"></div>
            <div class="four wide column card ui">
                <div class="content">
                    <div class="header">Perfiles</div>
                    <div class="meta">Perfiles registrados</div>
                    <div class="content">
                        @if(count(\App\Profile::ofUser(session('user')->id)->where('deleted', false)->get())>0)
                        @foreach (\App\Profile::ofUser(session('user')->id)->where('deleted', false)->get() as $profile)
                        <div class="ui card">
                            <div class="content">
                                <a href="/profile/{{ $profile->id }}" class="author">{{ $profile->name }}</a> ({{ $profile->temperature }} °C) · 
                                <a href="/user/{{ \App\User::find($profile->user_id)->username }}" class="ui gray image label mini">
                                    <img src="http://www.hrzone.com/sites/all/themes/pp/img/default-user.png">
                                    {{ "@".\App\User::find($profile->user_id)->username }}
                                    <div class="detail">{{ \App\Misc::fancy_date($profile->created_at) }}</div>
                                </a>
                            </div>
                            
                            <button @click="active_profile({{ $profile->id }})" class="ui button green">Activar</button>
                        </div>
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
                                    <a class="author" href="/actions/{{ $action->slug }}">{{ $action->name }}</a><br />
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
                                        <b>{{ "@".$user->username }}</b> · 
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
</div>
@endsection

@section('js')
<script>
    let main = new Vue({
        el: '#main',
        data: {
            profile: '',
            description: '',
            mod_user: '',
            mod_date: '',
            mod_hour: '',
            time_start: '',
            time_finish: '',
            sleep_start: '',
            sleep_finish: '',
            temperature: '',
        },
        methods: {
            active_profile: (profile_id) => {
                //main.loading()
                $.ajax({
                    url: '/profile/active',
                    type: 'post',
                    data: {'profile_id': profile_id},
                    success: (result) => {
                        //swal('Perfil activado: ' + result)
                        main.updateData()
                    },
                    error: (error) => {
                        swal({
                            type: 'error',
                            title: 'Error al activar el perfil',
                            html: 'Error: <code>'+jQuery.parseJSON(error.responseText).message+'</code><br />'
                            +'Excepción: <code>'+jQuery.parseJSON(error.responseText).exception+'</code>',
                        })
                    }
                })
            },
            updateData: () => {
                $.ajax({
                    url: '/data',
                    type: 'get',
                    success: (result) => {
                        //console.log(result)
                        let json = jQuery.parseJSON(result)
                        main.profile        = json.profile_name
                        main.description    = json.profile_description
                        main.mod_user       = json.mod_user
                        main.mod_date       = json.mod_date
                        main.mod_hour       = json.mod_hour
                        main.time_start     = json.profile_time_start
                        main.time_finish    = json.profile_time_finish
                        main.sleep_start    = json.profile_sleep_start
                        main.sleep_finish   = json.profile_sleep_finish
                        main.temperature    = json.profile_temperature
                    },
                    error: (error) => {
                        swal({
                            type: 'error',
                            title: 'Error al recibir datos del seridor',
                            html: 'Error: <code>'+jQuery.parseJSON(error.responseText).message+'</code><br />'
                            +'Excepción: <code>'+jQuery.parseJSON(error.responseText).exception+'</code>',
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
        },
        computed: {
            mod_user_link: () => {
                return "/user/" + main.mod_user
            }
        }
    }) 
    
    
    
    
    
    main.updateData()
</script>
@endsection
