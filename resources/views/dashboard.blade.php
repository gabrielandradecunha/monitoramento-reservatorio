@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    {{-- Incluindo css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/dashboard.css')}} ">

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    {{-- Incluindo sidebar --}}

    @include('includes.sidebar')

    <div class="reservatorios-container">

        <div class="reservatorios-box">
            <h1>Reservatórios de {{ Auth::user()->name }}</h1>

            <div class="botaobox d-flex justify-content-end align-items-center">
                <button class="btn btn-primary">Novo reservatorio</button>
            </div>
            <hr>

            {{-- Importando biblioteca de graficos --}}
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            {{-- Reservatorios do usuario --}}

            <div id="div-graficos" style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap;">

                @foreach ($reservatorios as $reservatorio)
                    @if (Auth::user()->id == $reservatorio->user_id)
                        <div class="graficos" id="div-{{ $reservatorio->id }}">
                            <center>
                                <canvas id='{{ $reservatorio->id }}'></canvas>
                                <button class="btn btn-primary"><a href="/reservatorio/{{ $reservatorio->id }}"
                                        style="color: white; text-decoration:none;">Mais informações</a></button>
                            </center>
                        </div>
                        <script>
                            // Dados do reservatório
                            var volumeAtual = {{ $reservatorio->volume_atual }};
                            var volumeMaximo = {{ $reservatorio->volume_maximo }};
                            var volumeLivre = volumeMaximo - volumeAtual;

                            // Configuração do gráfico de pizza
                            var ctx = document.getElementById(`{{ $reservatorio->id }}`).getContext('2d');
                            console.log('{{ $reservatorio->id }}')
                            new Chart(ctx, {
                                type: 'pie', // Tipo do gráfico
                                data: {
                                    labels: ['Usado', 'Livre'], // Legendas das fatias
                                    datasets: [{
                                        data: [volumeAtual, volumeLivre], // Valores
                                        backgroundColor: ['#3498db', '#7f8c8d'], // Cores: azul e cinza escuro
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        title: {
                                            display: true,
                                            text: '{{ $reservatorio->nome }}', // Título do gráfico
                                            font: {
                                                size: 18
                                            }
                                        },
                                        legend: {
                                            position: 'bottom', // Posiciona a legenda abaixo do gráfico
                                        }
                                    }
                                }
                            });
                        </script>
                    @endif
                @endforeach
            </div>
            <br>
            <br>
            <hr>
            <br>



            {{-- Grafico de barra --}}
            <center>
                <div class="barra">
                    <canvas id="barra"></canvas>
                </div>
            </center>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                const barra = document.getElementById('barra');

                new Chart(barra, {
                    type: 'bar',
                    data: {
                        labels: [
                            //Codigo blade para pegar os graficos do banco
                            @foreach ($reservatorios as $reservatorio)
                                '{{ $reservatorio->nome }}',
                            @endforeach
                        ],
                        datasets: [{
                            label: 'Armazenamento em relação a outros reservatorios',
                            data: [
                                @foreach ($reservatorios as $reservatorio)
                                    '{{ $reservatorio->volume_atual }}',
                                @endforeach
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>

        </div>
    </div>

@endsection
