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
    @include('layouts.menu')

    <section id="about" class="py-5" style="min-height: 100vh; display: flex; align-items: center; background: linear-gradient(135deg, #eef2f3 0%, #8e9eab 100%);">
        <div class="container text-center">
            <div class="mb-5">
                <h1 class="display-3 fw-bold text-dark" style="margin-top: 50px">CRONOS</h1>
            </div>

            <div class="bg-white p-5 rounded shadow-lg" style="max-width: 700px; margin: 0 auto;">
                <h2 class="mb-4 text-primary">Crie sua turma</h2>
                <p class="mb-4">Grupos particulares com convite por código. Simples, rápido e seguro.</p>

                <form method="POST" action="{{ route('team.store') }}">
                    @csrf

                    {{-- Nome --}}
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Nome da Turma">
                        <label for="name">Nome</label>
                        @error('name')
                            <div class="invalid-feedback text-start">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Descrição --}}
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}" placeholder="Descrição da Turma">
                        <label for="description">Descrição</label>
                        @error('description')
                            <div class="invalid-feedback text-start">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Turma fechada --}}
                    <div class="form-check mb-3 text-start">
                        <input class="form-check-input" type="checkbox" id="closed" name="closed">
                        <label class="form-check-label" for="closed">
                            Turma fechada
                        </label>
                        <div class="form-text">Apenas administradores podem publicar.</div>
                    </div>

                    {{-- Cores --}}
                    <div class="mb-4 text-start">
                        <label class="form-label d-block mb-2">Cor da turma:</label>
                        <div class="d-flex flex-wrap gap-3">
                            @php
                                $colors = [
                                    ['id' => '1', 'hex' => '#5bb4ff'],
                                    ['id' => '2', 'hex' => '#009788'],
                                    ['id' => '3', 'hex' => 'rgb(25, 103, 210)'],
                                    ['id' => '4', 'hex' => 'rgb(95, 99, 104)'],
                                    ['id' => '5', 'hex' => 'rgb(232, 113, 10)'],
                                ];
                            @endphp
                            @foreach ($colors as $color)
                                <div>
                                    <input class="form-check-input d-none" type="radio" name="color" id="color{{ $color['id'] }}" value="{{ $color['hex'] }}" {{ $loop->first ? 'checked' : '' }}>
                                    <label class="label-color rounded-circle d-inline-block" for="color{{ $color['id'] }}" style="background: {{ $color['hex'] }}; width: 32px; height: 32px; cursor: pointer; border: 2px solid #ccc;"></label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Criar Turma</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/code.jquery.com_jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
@include('layouts.footer')
@endsection
