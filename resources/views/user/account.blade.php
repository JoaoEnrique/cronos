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
    <body class="body-main">
        @include('layouts/menu')
        <div class="container container-account" style="padding-bottom: 100px; position: relative">
            {{-- MENSAGEM DE SUCESSO --}}
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom: 30px!important;">
                    {{session()->get('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- MENSAGEM DE ERRO --}}
            @if(session()->has('danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom: 30px!important;">
                    {{session()->get('danger')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row" style="justify-content: center;">
                <div class="col-md-8 col-sm-8 col-name-usser">
                    <h2>{{$user->name}}</h2>
                    <p>{{"@$user->user_name"}}</p>
                    {{-- <p class="seguidores">3 
                        publicações &nbsp;&nbsp; - &nbsp;&nbsp;  
                        <span id="numero-seguidor">1</span> seguidores &nbsp;&nbsp; - &nbsp;&nbsp; 
                        1 seguindo
                    </p>  --}}

                    @if(auth()->check() && $user->id == auth()->user()->id)
                        <a target="_blank" href="{{config("app.pacoca_url")}}/conta" class="btn btn-yellow" style="width: 100%;">
                            Editar
                        </a>
                    @else
                    
                        @php
                            $admin_controller = app(App\Http\Controllers\AdminController::class);
                            $isAdmin = $admin_controller->isAdmin(auth()->user()->id);
                        @endphp


                        <div class="d-flex">
                            <a target="_blank" href="{{config("app.pacoca_url")}}/{{"@" . $user->user_name}}" class="btn btn-yellow" style="width: {{ $user->readbook_user_id ? "50%" : "100%"}};">
                                Paçoca
                            </a>

                            @if($user->readbook_user_id )
                                <a target="_blank" href="{{config("app.readbooks_url")}}/compartilhar-livro/{{$user->id}}" class="btn btn-yellow" style="width: 50%;">
                                    Read Books
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

                @php 
                    $path = str_replace('../', "", $user->img_account);

                    if (file_exists($path)) {
                        $img_account = config("app.pacoca_back_url") . "/" .  $path;
                    } else {
                        $img_account = asset('img/img_account/img_account.png');
                    }
                @endphp


                <div class="col-md-2 col-sm-2 col-img-cosnta">
                    <div class="img-conta-perfil" style="background-image: url('{{$img_account}}')"></div>
                </div>
            </div>
    
            <div class="row">
                <div class="hr"></div>
            </div>
        </div>


    </body>
@endsection

