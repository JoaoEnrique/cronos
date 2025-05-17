<nav class="navbar navbar-expand-xl fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler" style="border: 0!important" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <img src="{{asset('img/menu.svg')}}" height="25px" srcset="">
        </button>
        <a class="navbar-brand logo" href="{{route('index')}}">
            <img class="logo-nav" src="{{asset('img/logo.png')}}" height="100%" srcset="">
        </a>
        <div class="offcanvas text-bg-dark text-bg-dark offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header" style="padding-bottom: 0!important; min-height: 100px;">

                {{-- NOME DA PAGINA MENU CELULAR - NAO LOGADO --}}
                @if(!auth()->check())
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="font-size: 30px">Smart Job</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                @else

                    @php 
                        $path = str_replace('../', "", auth()->user()->img_account);

                        if (file_exists($path)) {
                            $img_account = config("app.pacoca_back_url") . "/" .  $path;
                        } else {
                            $img_account = asset('img/img_account/img_account.png');
                        }
                    @endphp

                    
                    {{-- Caso esteja logado, verifica se é admin --}}
                    @if(auth()->check())
                        {{-- veririca se é admin --}}
                        @php
                            $admin_controller = app(App\Http\Controllers\AdminController::class);
                            $isAdmin = $admin_controller->isAdmin(auth()->user()->id);
                        @endphp
                    @endif

                    {{-- IMAGEM DA CONTA MENU CELULAR --}}
                    <ul class="navbar-nav navbar-conta-menu-cel">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%; display: flex; align-items: center;">
                                
                            <div class="row" style="width: 100%;">
                                <div class="" style="width: 65px">
                                    {{-- <img src="{{asset(auth()->user()->img_account)}}" height="50px" srcset=""> --}}
                                    <div class="img-account-menu" style="background-image: url('{{$img_account}}')"></div>
                                </div>
                                <div class="col">
                                    <p style="margin: 0; font-size: 20px">{{auth()->user()->name}}</p>
                                    <p style="font-size: 15px">{{"@" . auth()->user()->user_name}}</p>
                                </div>
                            </div>

                            </a>
                            <ul class="dropdown-menu dropdown-100" style="min-width: 100%; position: absolute;">
                                <li><a class="dropdown-item" href="/{{"@" . auth()->user()->user_name}}">Conta</a></li>
                                <li><hr class="dropdown-divider"></li>
                                {{-- Sai da conta --}}
                                <li>
                                    <form id="logout" action="{{ route('logout') }}" method="post" class="d-none">
                                        @csrf
                                    </form>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); console.log(document.getElementById('logout')); document.getElementById('logout').submit();">
                                        {{ __('Sair') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                @endif
            </div>
            <div class="container-fluid offcanvas-body" style="justify-content: space-between; align-items: center;">
                <ul class="navbar-nav">
                    <hr style="margin: 0!important">
                </ul>

                {{-- MENU --}}
                <ul class="navbar-nav">
                    <button type="button" class="link-close-menu" data-bs-dismiss="offcanvas" aria-label="Close">{{-- Fechar menu ao ir para link --}}
                        <li class="nav-item">
                            <a id="link-home" class="nav-link" href="{{route('index')}}">
                                Home
                            </a>
                        </li>
                    </button>
                    <hr>
                    {{-- Se for admin,  mostra criar quiz e tabelas de listagem--}}
                    {{-- @if(auth()->check() && $isAdmin)
                        @if ($isAdmin)
                            <li class="nav-item dropdown" style="flex-wrap: wrap;">
                                <a
                                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link dropdown-toggle 
                                    @if(Route::getCurrentRoute()?->getName() == 'admin.list_students' || Route::getCurrentRoute()?->getName() == 'admin.list_admins' || Route::getCurrentRoute()?->getName() == 'admin.create')
                                        active 
                                    @endif">
                                        Administrar
                                </a>
                                <ul class="dropdown-menu dropdown-100" style="min-width: 100%">
                                    <li><a class="dropdown-item @if(Route::getCurrentRoute()?->getName() == 'admin.list_students') active @endif" href="{{route('admin.list_students')}}">Listar Alunos</a></li>
                                    <li><a class="dropdown-item @if(Route::getCurrentRoute()?->getName() == 'admin.list_admins') active @endif" href="{{route('admin.list_admins')}}">Listar Administradores</a></li>
                                    <li><a class="dropdown-item @if(Route::getCurrentRoute()?->getName() == 'admin.create') active @endif" href="{{route('admin.create')}}">Criar Administrador</a></li>
                                </ul>
                            </li>
                        @endif
                    @endif --}}

                    {{-- <li class="nav-item">
                        <a class="nav-link @if(Route::getCurrentRoute()?->getName() == 'teams') active @endif" href="{{route('teams')}}">
                            Turmas
                        </a>
                    </li> --}}

                    {{-- Form para entrar na  turma se não for admin --}}
                    @if(auth()->check() && !$isAdmin)
                        <li class="nav-item none-pc" style="margin-top: 20px">
                            <div class="form-odpen-team" style="width: 100%; padding: 8px">
                                <form action="{{route('team.enter')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-7" style="padding-right: 0">
                                            <input class="form-control @error('team_code') is-invalid @enderror" type="text" placeholder="Código da turma" name="team_code" id="team_code" value="{{old('team_code')}}">                       
                                            
                                            @error('team_code')
                                                <span class="invalid-feedback" role="alert" style="text-align: left; display: block!important;">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <button style="width: 100%" class="btn btn-yellow" type="submit">Entrar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                    @endif

                    <hr>
                        {{-- Se o usuário não for logado --}}
                    @if(!auth()->check())
                        {{-- Entrar --}}
                        <li class="nav-item">
                            <a  class="nav-link @if(Route::getCurrentRoute()?->getName() == 'login') active @endif" href="{{route('login')}}">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link @if(Route::getCurrentRoute()?->getName() == 'register') active @endif" href="{{route('register')}}">Cadastrar</a>
                        </li>

                    {{-- Se o usuário for logado --}}
                    @else
                        {{-- IMAGEM DA CONTA PC --}}
                        <li class="none-cel nav-item dropdown" style="flex-wrap: wrap;">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%; display: flex; align-items: center;">
                                {{-- Verifica se tem imagem --}}

                                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                                <script>
                                $(document).ready(function() {
                                    var imageUrl = "{{ $img_account }}"; // Substitua $caminhoParaImagem pela variável Blade real
                                    var timestamp = new Date().getTime();
                                    // $(".img-account-menu").attr("src", imageUrl + "?v=" + timestamp);
                                    $(".img-account-menu").css("background-image", "url('" + imageUrl + "?v=" + timestamp + "')");
                                });
                                </script>



                                {{-- IMAGEM DA CONTA --}}
                                {{-- <div class="img-account-menu" style="background-image: url('{{asset($img_account)}}')"></div> --}}
                                <div class="img-account-menu"></div>
                            </a>
                            <ul class="dropdown-menu dropdown-100" style="">
                                <li><a class="dropdown-item" href="/{{"@" . auth()->user()->user_name}}">Conta</a></li>
                                <li><hr class="dropdown-divider"></li>
                                {{-- Sai da conta --}}
                                <li>
                                    <form id="logout" action="{{ route('logout') }}" method="post" class="d-none">
                                        @csrf
                                    </form>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); console.log(document.getElementById('logout')); document.getElementById('logout').submit();">
                                        {{ __('Sair') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
            </div>
        </div>
    </div>
</nav>

<script>
    // Função para verificar quando a div#sobre está visível na janela
    function isElementInViewport(el) {
        if(el){
            var rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
            );
        }
    }

    // Função para adicionar a classe "active" ao link quando a div#sobre estiver visível
    function checkSobreVisibility() {
        var linkHome = document.getElementById('link-home');
        var linkAbout = document.getElementById('link-about');
        var linkService = document.getElementById('link-service');
        var linkProject = document.getElementById('link-project');
        var linkContact = document.getElementById('link-contact');

        var divHome = document.getElementById('home');
        var divAbout = document.getElementById('about');
        var divService = document.getElementById('servicos');
        var divProject = document.getElementById('project');
        var divContact = document.getElementById('contact');

        if (isElementInViewport(divHome)) {
            linkHome.classList.add('active');
        } else {
            linkHome.classList.remove('active');
        }

        if (isElementInViewport(divAbout)) {
            linkAbout.classList.add('active');
        } else {
            linkAbout.classList.remove('active');
        }

        if (isElementInViewport(divService)) {
            linkService.classList.add('active');
        } else {
            linkService.classList.remove('active');
        }

        if (isElementInViewport(divProject)) {
            linkProject.classList.add('active');
        } else {
            linkProject.classList.remove('active');
        }

        if (isElementInViewport(divContact)) {
            linkContact.classList.add('active');
        } else {
            linkContact.classList.remove('active');
        }
    }


    // Verificar a visibilidade da div#sobre ao carregar a página e ao rolar
    window.addEventListener('load', checkSobreVisibility);
    window.addEventListener('scroll', checkSobreVisibility);
</script>



