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
@section('title', 'Smart Job')

{{-- Conteudo do site --}}
@section('content')
    <body class="body-register">
        @include('layouts/menu')
        <div class="container container-login">
            <div class="row row-login">
                <div class="col col-img-register" style="background: #5bb4ff">
                    <img src="{{asset('img/register.png')}}" class="img-login" srcset="">
                </div>
                <div class="col">
                    <form class="row g-3 form-login" method="POST" action="{{ route('register') }}">
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade alert-login show" role="alert">
                                {{session()->get('success')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        
                        {{-- MENSAGEM ERRO --}}
                        @if(session()->has('danger'))
                            <div class="alert alert-danger alert-dismissible fade alert-login show" role="alert">
                                {{session()->get('danger')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @csrf
                        <h1>Cadastre-se</h1>
                        <p>Se tiver uma conta no Paçoca entre com mesmo login e senha</p>
                        {{-- NOME --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" autocomplete="name" autofocus>
                            
                            @error('name')
                                <span class="invalid-feedback" role="alert" style="text-align: left">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="col-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" autocomplete="email">
                            
                            @error('email')
                                <span class="invalid-feedback" role="alert" style="text-align: left">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>

                        {{-- NOME DE USUÁRIO --}}
                        <div class="col-6 mb-3">
                            <label for="user_name" class="form-label">Nome de usuário</label>
                            <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user_name" name="user_name" value="{{old('user_name')}}" autocomplete="user_name">
                            
                            @error('user_name')
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
                          <label for="password_confirmation" class="form-label">Senha</label>
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

                        <div class="row col mb-3 mt-3">
                            
                            <label class="form-check-label col-12" for="termos">
                                <input class="form-check-input" type="checkbox" {{ old('termos') ? 'checked' : '' }} name="termos"  id="termos">
                                Concordo em criar uma conta no 
                                <a class="link" href="{{config("app.pacoca_url")}}" target="_blank" rel="noopener noreferrer">Paçoca</a>
                                e com os
                                <input class="link" type="button" data-bs-toggle="modal" data-bs-target="#modal-termos-de-uso" value="termos de uso"/> e as
                                <input class="link" type="button" data-bs-toggle="modal" data-bs-target="#modal-politicas-de-privacidade" value="diretrizes"/>
                            </label>

                            @error('termos')
                                <span class="invalid-feedback" role="alert" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="mb-2">
                          <button class="btn btn-login" type="submit">Cadastrar</button>
                        </div>
                        <div class="" style="text-align: center">
                            <a href="{{route('login')}}">Já tem conta? Faça Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- BOTÃO WHATSAPP --}}
        <a target="_BLANK" class="btn-adicionar-livro"  href="https://api.whatsapp.com/send?phone=+5528999571689&text=Smart Job" style="background: #40C351;">
            <img src="../img/whatsapp_green.png" height="40px" srcset="">
        </a>

        <!-- MODAL DE TERMOS DE USO -->
        <div class="modal fade" style="overflow: hidden" id="modal-termos-de-uso" tabindex="-1" aria-labelledby="modal-termos-de-uso" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-termos-de-uso">Termos de uso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 80vh!important; overflow: auto">
                    @include('components.termos-uso')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" data-bs-dismiss="modal" id="btnCheck" class="btn btn-blue">Aceitar</button>
                </div>
                </div>
            </div>
        </div>

        {{-- MODAL DE POLITICAS SE PRIVACIDADE --}}
        <div class="modal fade" style="overflow: hidden" id="modal-politicas-de-privacidade" tabindex="-1" aria-labelledby="modal-politicas-de-privacidade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-politicas-de-privacidade">Diretrizes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 80vh!important; overflow: auto">
                    @include('components.diretrizes')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" data-bs-dismiss="modal" id="btnCheck" class="btn btn-blue">Aceitar</button>
                </div>
                </div>
            </div>
        </div>
    </body>

    <script src="{{asset('js/code.jquery.com_jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
@endsection

