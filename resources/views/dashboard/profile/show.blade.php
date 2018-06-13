@extends('layouts.app')
@section('content')
<div class="ui grid row">
    <div class="four wide column"></div>
    <div class="eight wide column card ui">
        <div class="content">
            <div class="ui dividing header">{{ $profile->name }}</div>
            <div class="meta">Creado por {{ "@".\App\User::find($profile->user_id)->username }}</div>
            <div class="content">
                {{ $profile->description }}
                <table class="ui celled table">
                    <thead>
                        <tr>
                            <th>Campo</th>
                            <th>Dato</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Horarios de actividad</td>
                            <td>desde {{ \App\Misc::fancy_time($profile->time_start) }} hasta {{ \App\Misc::fancy_time($profile->time_finish) }}</td>
                        </tr>
                        <tr>
                            <td>Horarios de sueño</td>
                            <td>desde {{ \App\Misc::fancy_time($profile->sleep_start) }} hasta {{ \App\Misc::fancy_time($profile->sleep_finish) }}</td>
                        </tr>
                        <tr>
                            <td>Temperatura </td>
                            <td>{{ $profile->temperature }}</td>
                        </tr>
                        <tr>
                            <td>Fecha de creación </td>
                            <td>{{ \App\Misc::fancy_date($profile->created_at) }}</td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
@endsection