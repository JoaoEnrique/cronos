{{-- 
    "PRA QUE SERVE
    TANTO CÓDIGO
    SE A VIDA
    NÃO É PROGRAMADA
    E AS MELHORES COISAS
    NÃO TEM LÓGICA". 
    Alguém (algum ano)
--}}

@extends('layouts.main')
@section('title', 'Cronos')

@section('content')
<body class="body-main" id="home">
    @include('layouts/menu')

    <section id="about">
        <div class="container container-about">
            <div class="row" style="flex-wrap: nowrap;">
                <div class="col-sm-12 col-md-12 col-lg-12 col-text-about show-item">
                    <h1>SOBRE O CRONOS</h1>
                    <div class="line"></div>
                    <p>
                        O <strong>Cronos</strong> é um sistema inteligente para <strong>gerenciamento de atividades e tarefas</strong>, projetado para facilitar o seu dia a dia com organização, praticidade e controle total do tempo.
                    </p>
                    <p>
                        Com uma interface simples e objetiva, o Cronos ajuda você a planejar compromissos, acompanhar prazos e aumentar sua produtividade, seja para uso pessoal, acadêmico ou profissional.
                    </p>
                    <p>
                        Organize sua rotina. Economize tempo. Foque no que realmente importa.
                    </p>
                </div>
                {{-- <div class="col-sm-12 col-md-12 col-lg-3 col-img-about show-item"></div> --}}
            </div>
        </div>
    </section>

    <script src="{{ asset('js/code.jquery.com_jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
@include("layouts/footer")
@endsection
