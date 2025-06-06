{{-- 
    "PRA QUE SERVE
    TANTO CÓDIGO
    SE A VIDA
    NÃO É PROGRAMADA
    E AS MELHORES COISAS
    NÃO TEM LÓGICA". 
    Algúem (algum ano)
--}}

@extends('layouts.main')
@section('title', 'Cronos')

{{-- Conteudo do site --}}
@section('content')
    <body class="body-register">
        @include('layouts/menu')
        <div class="container container-edit-account" style="display:flex; justify-content: center; flex-wrap: wrap">
            <form class="col" action="{{ route('account.update_img') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- LABEL MUDAR IMAGEM --}}
                <div class="row" style="width: 100%; margin: 0">
                    <div class="col" style="display:flex; justify-content: center;">
                        <label id="label-img" for="img" class="label-img-edit" style="background-image: url('{{ auth()->user()->img_account }}')">
                            <img src="{{asset('img/photo.png')}}" class="img-choose-picture-perfil" srcset="">
                        </label>
                    </div>
                </div>

                {{-- ERRO --}}
                @error('img')
                    <div class="invalid-feedback" style="display: block!important; text-align: center">
                        Clique na imagem acima para escolher uma nova
                    </div>
                @enderror

                {{-- BTN MUDAR IMAGEM --}}
                <div class="row" style="width: 100%; margin: 0">
                    <div class="col" style="display:flex; justify-content: center;">
                        <button class="btn btn-login" type="submit" style="width: 150px; margin-top: 5px">Mudar Imagem</button>
                    </div>
                </div>

                {{-- CAMOPO DA IMAGE  --}}
                <div class="row">
                    <div class="col">
                        <input type="file" class="d-none img-account-preview" name="img" id="img">
                    </div>
                </div>
            </form>
    </div>
        <div class="container container-login" style="margin-top: 50px!important">
            <div class="row row-edit-accoount">
                <div class="col">
                    <form class="row g-3 form-login" method="POST" action="{{ route('account.update') }}">
                        @csrf
                        <h1>Editar Conta</h1>
                        {{-- NOME --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ auth()->user()->name }}" autocomplete="name" autofocus>
                            
                            @error('name')
                                <span class="invalid-feedback" role="alert" style="text-align: left">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="col-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ auth()->user()->email }}" autocomplete="email">
                            
                            @error('email')
                                <span class="invalid-feedback" role="alert" style="text-align: left">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>

                        {{-- NOME DE USUÁRIO --}}
                        <div class="col-6 mb-3">
                            <label for="username" class="form-label">Nome de usuário</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ auth()->user()->user_name }}" autocomplete="username">
                            
                            @error('username')
                                <span class="invalid-feedback" role="alert" style="text-align: left">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>

                        {{-- SENHA --}}
                        <div class="mb-3">
                          <label for="password" class="form-label">Senha</label>
                            <div class="col" style="position: relative">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password_confirmation') }}" autocomplete="password">
                                <img class="view-password" id="view-password" src="{{asset('img/eye.svg')}}" onclick="showPassword()" srcset="">
                            </div>

                            @error('password')
                                <span class="invalid-feedback" role="alert" style="text-align: left; display: block!important">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- SENHA --}}
                        <div class="mb-5">
                          <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                            <div class="col" style="position: relative">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" autocomplete="new-password">
                                <img class="view-password" id="view-password-confirm" src="{{asset('img/eye.svg')}}" onclick="showPasswordConfirm()" srcset="">
                            </div>

                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert" style="text-align: left; display: block!important">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        
                        <div class="mb-2">
                          <button class="btn btn-login" type="submit">Editar</button>
                        </div>
                        <div class="" style="text-align: center">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

    <script src="{{asset('js/code.jquery.com_jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
@endsection

