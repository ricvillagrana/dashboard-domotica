@extends('layouts.app')
@section('content')
<div id="led">
    <button class="ui button red" @click="switch_red">Switch red!</button>
    @{{ red }}
    <button class="ui button blue" @click="switch_blue">Switch blue!</button>
    @{{ blue }}
</div>
@endsection
@section('js')
<script>
    let led = new Vue({
        el: '#led',
        data: {
            red: false,
            blue: false,
        },
        methods: {
            switch_red: () => {
                $.ajax({
                    url: '/led/red',
                    type: 'get',
                    success: (result) => {
                        led.red = (result == "1")
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
            switch_blue: () => {
                $.ajax({
                    url: '/led/blue',
                    type: 'get',
                    success: (result) => {
                        led.blue = (result == "1")
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
            red_status: () => {
                $.ajax({
                    url: '/led/red/get',
                    type: 'get',
                    success: (result) => {
                        led.red = (result == "1")
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
            blue_status: () => {
                $.ajax({
                    url: '/led/blue/get',
                    type: 'get',
                    success: (result) => {
                        led.blue = (result == "1")
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
            }
        }
        
    })
    led.red_status()
    led.blue_status()
</script>
@endsection