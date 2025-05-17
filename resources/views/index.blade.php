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
    <body class="body-main" id="home">
        @include('layouts/menu')
        <div class="background-home">
            <div class="row">
                <div class="col-text-home show-item" style="position: relative;">
                    
                    @error('name')
                        <div class="alert alert-home alert-danger alert-dismissible fade form-login show" role="alert" style="position: absolute; top: 150px; width: 50%; margin: 0 auto;">
                            {{$message}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror

                    @error('email')
                        <div class="alert alert-home alert-danger alert-dismissible fade form-login show" role="alert" style="position: absolute; top: 150px; width: 50%; margin: 0 auto;">
                            {{$message}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror

                    @error('phone')
                        <div class="alert alert-home alert-danger alert-dismissible fade form-login show" role="alert" style="position: absolute; top: 150px; width: 50%; margin: 0 auto;">
                            {{$message}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror

                    @error('message')
                        <div class="alert alert-home alert-danger alert-dismissible fade form-login show" role="alert" style="position: absolute; top: 150px; width: 50%; margin: 0 auto;">
                            {{$message}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror

                    @if(session()->has('success'))
                        <div class="alert alert-home alert-success alert-dismissible fade form-login show" role="alert" style="position: absolute; top: 150px; width: 50%; margin: 0 auto;">
                            {{session()->get('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <h1 class="title-home">Smart Job</h1>
                    <p class="text-home">Soluções criativas, resultados criativos.</p>
                    {{-- <a href="#about" class="btn btn-gray">Sobre Nós</a> --}}
                </div>
            </div>
        </div>


        <div id="about">
            <div class="container container-about">
                <div class="row" style="flex-wrap: nowrap;">
                    <div class="col-sm-12 col-md-12 col-lg-7 col-text-about show-item">
                        <h1>SOBRE NÓS</h1>
                        <div class="line"></div>
                        <p>
                            A Smart Job Oficial nasceu do desejo genuíno de aniquilar a dor de muitas organizações, oferecendo um serviço que vai além do convencional. Com uma 
                            solução inteligente e eficaz, atendemos às necessidades de empresas de todos os tamanhos, <strong>especialmente</strong> aquelas de <strong>porte pequeno a médio</strong>, que 
                            muitas vezes sofrem com a escassez de recursos para recrutamento.

                        </p>
                        <p>
                            Nossa jornada é pautada na confiança e no comprometimento, valores que se refletem nas parcerias firmadas e em cada etapa dos nossos serviços.
                            Somos apaixonados por conectar talentos e empresas de forma inovadora. 
                        </p>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-3 col-img-about show-item"></div>
                </div>
            </div>
        </div>


        <div id="servicos">
            <div class="container" style="padding: 0; ">
                <div class="row" style="width: 100%">
                    <h1>SERVIÇOS</h1>
                    <div class="line"></div>
                    <h2>Para Empresas</h2>
                </div>
                <div class="row" style="width: 100%; margin-top: 60px">
                  <div class="col-lg-4 mt-5 show-item d-flex" style="justify-content: center; flex-direction: column;align-items: center;">
                    <img src="{{asset('img/brain.png')}}" class="img-service" srcset="">
                    <h2 class="fw-normal text-center">Recrutamento <br>& Seleção</h2>
                    <button class="btn-mais-servico" type="button" data-bs-toggle="modal" data-bs-target="#recrutamento">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                        </svg>
                    </button>
                  </div>
                  
                  <div class="col-lg-4 mt-5 show-item d-flex" style="justify-content: center; flex-direction: column;align-items: center;">
                    <img src="{{asset('img/people.png')}}" class="img-service" srcset="">
                    <h2 class="fw-normal text-center">Mapeamento <br> Comportamental</h2>
                    <button class="btn-mais-servico" type="button" data-bs-toggle="modal" data-bs-target="#mapeamento">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                        </svg>
                    </button>
                  </div>

                  <div class="col-lg-4 mt-5 show-item d-flex" style="justify-content: center; flex-direction: column;align-items: center;">
                    <img src="{{asset('img/manager.png')}}" class="img-service" srcset="">
                    <h2 class="fw-normal text-center">Gerenciamento de <br>Projetos</h2>
                    <button class="btn-mais-servico">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                        </svg>
                    </button>
                  </div><!-- /.col-lg-4 -->

                  
                  <h2 style="margin-top: 100px">Para Empresas</h2>
                  <div class="col-lg-6 mt-5 show-item d-flex" style="justify-content: center; flex-direction: column;align-items: center;">
                    <img src="{{asset('img/brain.png')}}" class="img-service" srcset="">
                    <h2 class="fw-normal text-center">Recrutamento <br>& Seleção</h2>
                    <button class="btn-mais-servico" type="button" data-bs-toggle="modal" data-bs-target="#recrutamento">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                        </svg>
                    </button>
                  </div>
                  
                  <div class="col-lg-6 mt-5 show-item d-flex" style="justify-content: center; flex-direction: column;align-items: center;">
                    <img src="{{asset('img/people.png')}}" class="img-service" srcset="">
                    <h2 class="fw-normal text-center">Mapeamento <br> Comportamental</h2>
                    <button class="btn-mais-servico" type="button" data-bs-toggle="modal" data-bs-target="#mapeamento">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                        </svg>
                    </button>
                  </div>

                  {{-- <div class="col-lg-3 mt-5 show-item d-flex" style="justify-content: center; flex-direction: column;align-items: center;">
                    <img src="{{asset('img/folder.png')}}" class="img-service" srcset="">
                    <h2 class="fw-normal text-center">Entrega de <br>Projetos</h2>
                    <button class="btn-mais-servico">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                        </svg>
                    </button>
                  </div><!-- /.col-lg-4 --> --}}
                </div><!-- /.row -->
              </div>
        </div>

        <div id="project">
            <div class="container">
                <div class="row">
                    <h1>PROJETOS</h1>
                    <div class="line"></div>
                </div>
                <div class="row">
                    <div class="col show-item">
                        <div id="carouselExampleIndicators" class="carousel slide">
                            <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active btn-state-carouse" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class="btn-state-carouse" aria-label="Slide 2"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-img-project col-md-4 col-sm-12">
                                            <img src="{{asset('img/servico1.png')}}" class="img-project" srcset="">
                                        </div>
                                        <div class="col-text-project col-md-8 col-sm-12">
                                            <span><strong>First Job:&nbsp;</strong> Para jovens que estão à procura do primeiro emprego</span><br>
                                            <p>Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-img-project col-md-4 col-sm-12">
                                            <img src="{{asset('img/servico2.png')}}" class="img-project" srcset="">
                                        </div>
                                        <div class="col-text-project col-md-8 col-sm-12">
                                            <span><strong>First Job:&nbsp;</strong> Para jovens que estão à procura do primeiro emprego</span><br>
                                            <p>Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            {{-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> --}}
                            <img src="{{asset('../img/chevron-left.svg')}}" class="" srcset="">
                            <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <img src="{{asset('../img/chevron-right.svg')}}" class="" srcset="">
                            {{-- <span class="carousel-control-next-icon" aria-hidden="true"></span> --}}
                            <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="contact">
            <div class="container">
                <h1>CONTATO</h1>
                <div class="line"></div>

                <div class="row row-contact">
                    <div class="col-sm-12 col-md-6 show-item">
                        <div class="text-contact">
                            <p class="text-contact">São Paulo, Sao Paulo, Brazil</p>
                            <p class="text-contact">+55-(28) 99957-1689</p>
                            <p class="text-contact">smartjoboficial@gmail.com</p>
                            <p class="text-contact">Eaí, está pronto(a) para começar?</p>
                            <div class="" style="width: 100%; display: flex; justify-content:center; margin-bottom:20px">
                                <ul class="navbar-nav navbar-footer" style="opacity: 1; display:flex; flex-direction:row; flex-wrap: wrap;">
                                    <li class="nav-item">
                                        <a target="_BLANK" class="nav-link link-footer1" href="https://api.whatsapp.com/send?phone=+5528999571689&text=Smart Job">
                                            <img style="filter: invert(100%);" src="{{asset('img/whatsapp.png')}}" height="40px" srcset="">
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a target="_BLANK" class="nav-link link-footer1" href="https://www.instagram.com/smartjoboficial/">
                                            <img style="filter: invert(100%);" src="{{asset('img/instagram.png')}}" height="40px" srcset="">
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a target="_BLANK" class="nav-link link-footer1" href="https://www.linkedin.com/in/tamara-sant-ana-2838a76a/">
                                            <img style="filter: invert(100%);" src="{{asset('img/linkedin.png')}}" height="40px" srcset="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 show-item">
                        <form method="POST" action="{{route('user.send_contact')}}" class="form-contact">
                            @csrf 
                            <div class="text-left"> 
                                <div class="custom-form-steps" data-total-steps="1">
                                    <div class="custom-form-step step-1" data-step="1">
                                        <div class="row"><div class="col-xs-12 c-f-field-type" data-field-type="text">
                                            <div class="form-group">
                                                <input required type="text" id="name" name="name" placeholder="Nome" class="form-control @error('name') is-invalid @enderror" data-msg-required="Este campo é necessário.">
                                            </div>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert" style="text-align: left; display: block!important">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 c-f-field-type" data-field-type="text">
                                            <div class="form-group">
                                                <input required type="text" id="phone" name="phone" placeholder="Telefone" class="form-control @error('phone') is-invalid @enderror">
                                            </div>
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert" style="text-align: left; display: block!important">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 c-f-field-type" data-field-type="email">
                                            <div class="form-group">
                                                <input required type="email" id="email" name="email" placeholder="Endereço de e-mail" class="form-control @error('email') is-invalid @enderror" data-msg-required="Este campo é necessário.">
                                            </div>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert" style="text-align: left; display: block!important">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 c-f-field-type" data-field-type="textarea">
                                            <div class="form-group">
                                                <textarea required id="message" name="message" placeholder="Mensagem" class="form-control @error('message') is-invalid @enderror" rows="4" ></textarea>
                                            </div>
                                            @error('message')
                                                <span class="invalid-feedback" role="alert" style="text-align: left; display: block!important">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-gray btn-block submit-single-step-btn" style="width: 100%; margin-bottom: 20px">Fale conosco!</button>
                            </div> 
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    {{-- BOTÃO WHATSAPP --}}
    <a target="_BLANK" class="btn-adicionar-livro"  href="https://api.whatsapp.com/send?phone=+5528999571689&text=Smart Job" style="background: #40C351;">
      <img src="../img/whatsapp_green.png" height="40px" srcset="">
    </a>


        {{-- <div class="container container-home">
            <div class="row row-home">
                <div class="col col-text-home">
                    <h1>Smart Job</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam vero repellendus quae molestiae ratione sed modi earum, saepe</p>
                </div>
                <div class="col col-img-search-people">
                    <img src="{{asset('img/search_people.png')}}" class="img-search-people" srcset="">
                </div>
            </div>
        </div> --}}

        <script src="{{asset('js/code.jquery.com_jquery-3.6.0.min.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>


        {{-- MODALS --}}

        {{-- RECRUTAMENTO & SELEÇÃO --}}
        <div class="modal fade" id="recrutamento" tabindex="-1" aria-labelledby="recrutamento" aria-hidden="true">
            <div class="modal-dialog modal-servicos">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="recrutamento">Recrutamento & Seleção</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>R&S Smart</strong></p>
                        <p>
                            Para empresas que já possuem boas práticas de R&S mas precisam de mais pessoas candidatas para preencher as vagas em aberto. 
                        </p><br>

                        <p><strong>R&S Smart Standard</strong></p>
                        <p>
                            Para empresas que necessitam da estruturação e gerenciamento do processo seletivo  end-to-end.
                        </p><br>

                        <p><strong>R&S Smart Plus</strong></p>
                        <p>
                            Para empresas que desejam ir além do processo de R&S, mas também querem garantir a excelência na experiência da pessoa candidata contando com nosso apoio no processo admissional e onboarding do novo contratado.
                        </p>

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mapeamento Comportamental --}}
        <div class="modal fade" id="mapeamento" tabindex="-1" aria-labelledby="mapeamento" aria-hidden="true">
            <div class="modal-dialog modal-servicos">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="mapeamento">Mapeamento Comportamental</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    @include("layouts/footer")

    
@endsection

