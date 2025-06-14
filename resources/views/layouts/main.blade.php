<!--
    "PRA QUE SERVE
    TANTO CÓDIGO
    SE A VIDA
    NÃO É PROGRAMADA
    E AS MELHORES COISAS
    NÃO TEM LÓGICA".
    Algúem (algum ano)
-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css?v=14') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar-pc.css?v=14') }}">
     <script src="{{asset('lucide@0.511.0/dist/umd/lucide.min.js')}}"></script>
     <script src="https://unpkg.com/lucide@latest"></script>
    <link href="{{asset('bootstrap-5.3.0-dist/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="{{asset('bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>    
    <link href="{{ asset('bootstrap-5.3.0-dist\css\bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

  @yield('content')

  <script>
    lucide.createIcons();

    console.log('%cDesenvolvido pelo João Enrique', 'font-size: 30px; color: red;');
    console.log(`%chttps://github.com/JoaoEnrique`, 'font-size: 20px; color: #5bb4ff;');
    console.log(`%Cronos ${new Date().getFullYear()}`, 'font-size: 30px; color: #5bb4ff;');
  </script>

</html>