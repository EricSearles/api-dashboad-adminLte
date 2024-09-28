<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Minha Competição</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384" />

    <!-- Styles -->

    <!-- <style>

    </style> -->
</head>

<body>
    <div class="topo">
        @if (Route::has('login'))
        <div class="">
            @auth
            <a href="{{ url('/home') }}" class="">Home</a>
            @else
            <a href="{{ route('login') }}" class="">Entrar</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="">Cadastro</a>
            @endif
            @endauth
        </div>
        @endif
    </div>
    <div class="header">
        <img src="{{ asset('images/Header.png') }}" alt="" id="imagem header" width="100%" />
    </div>
    <!-- <div class="conteudo">
        <h2>"The easy way to create your championship"</h2>
        <a href="{{ route('register') }}" class="btn btn-outline-primary">Crie sua competição agora!</a>
    </div> -->
    <div class="footer">
        <p>&copy; Searles Soluções Web 2021 - <?php echo date('Y'); ?> - Locadora de veículos</p>
    </div>

    </div>
</body>

</html>