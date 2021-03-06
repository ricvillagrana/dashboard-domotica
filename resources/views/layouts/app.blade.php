<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Domótica Project</title>
    <link rel="stylesheet" href="/css/app.css">
    @yield('css')
</head>
<body style="background:#efefef;">
    <div class="container">
        
        @if(session('user'))
        <div class="ui menu">
            <a href="/" class="item">Home</a>       
            
            @if(session('user')->superuser)     
            <a href="/profile/new" class="item">Nuevo perfil</a>            
            <a href="/profiles" class="item">Admin. perfiles</a>            
            <a href="/users" class="item">Admin. usuarios</a>
            @endif        
            <div class="right menu">
                <div class="item">
                    <div class="ui transparent icon input">
                        <input type="text" placeholder="Buscar...">
                        <i class="search link icon"></i>
                    </div>
                </div>
            </div>
            <div class="item ui dropdown">
                <span class=""><i class="dropdown icon"></i> {{ session('user')->name }}</span>
                <div class="menu">
                    <a class="item">Mi perfil</a>
                    <div class="divider"></div>
                    <a href="/logout" class="item">Cerrar sesión</a>
                </div>
            </div>
        </div>
        @endif
        @yield('content')
    </div>
    <script src="/js/app.js"></script>
    @yield('js')
    <script>
    $('.popup').popup();
    $('.ui.dropdown').dropdown();
    </script>
</body>
</html>