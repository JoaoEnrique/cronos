<!-- 
    "PRA QUE SERVE
    TANTO CÓDIGO
    SE A VIDA
    NÃO É PROGRAMADA
    E AS MELHORES COISAS
    NÃO TEM LÓGICA". 
    Algúem (algum ano)
    JOÃO ENRIQUE
    https://github.com/joaoenrique
-->

@extends('layouts.main')
@section('title', 'Smart Job')

{{-- Conteudo do site --}}
@section('content')
    <body class="body-main">
        
        @include('layouts/menu')
        
        <div class="container container-teams">
            <h3>Mensagens</h3>

            @foreach($messages as $message)
                    <div class="div-public-team" style="margin-top: 20px; padding: 20px; position:relative;">
                        <div class="row">
                            <div class="col">
                                <h2> {{-- NOME --}}
                                        {{  $message->name  }}
                                </h2>
                                {{-- NOME DE USUARIO --}}
                                <p class="username-public-team">
                                        {{ "$message->email"   }} -  {{ "$message->phone"   }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="">{{ $message->message }}</p>
                            </div>
                        </div>

                        {{-- EDITAR MENSAGEM SE FOR DO USUARIO LOGADO OU FOR ADMIN --}}
                        
                </div>
            @endforeach
        </div>

        
    </body>

@endsection

