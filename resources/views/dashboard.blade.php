@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    {{-- Incluindo css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/dashboard.css') }} ">

    {{-- Incluindo sidebar --}}
    @include('includes.sidebar')

    <div class="reservatorios-container">

        <div class="reservatorios-box">
            <p>Reservatórios de <i>{{ Auth::user()->name }}</i></p>

                <button class="btn btn-primary d-none d-sm-block" data-toggle="modal" data-target="#exampleModal" style="background-color: rgba(94, 105, 255)">Novo
                    Reservatório</button>

                <!-- Para telas pequenas -->
                <button class="btn btn-primary d-block d-sm-none" data-toggle="modal" data-target="#exampleModal" style="background-color: rgba(94, 105, 255);">Novo
                    Reservatório</button>
            <hr>

            {{-- Importando biblioteca de graficos --}}
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            {{-- Reservatorios do usuario --}}
            @php

                $reservatorioCount = 0;

            @endphp
            @foreach ($reservatorios as $reservatorio)
                @if (Auth::user()->id == $reservatorio->user_id)
                    @php
                        $reservatorioCount++;
                    @endphp
                @endif
            @endforeach

            @if ($reservatorioCount <= 0)
                <br>
                <center><i>Você ainda não possui nenhum reservatório 😥</i></center>
            @else
                <div id="div-graficos" style="display: flex; justify-content: left; align-items: center; flex-wrap: wrap;">
                    @foreach ($reservatorios as $reservatorio)
                        @if (Auth::user()->id == $reservatorio->user_id)
                            <div class="graficos" id="div-{{ $reservatorio->id }}" style="margin-bottom: 5%;">
                                <center>
                                    <canvas id='{{ $reservatorio->id }}'></canvas>
                                    <a href="/reservatorio/{{ $reservatorio->id }}">
                                        <button type="button" class="btn btn-primary" style="background-color: rgb(94, 105, 255)">Mais</button>
                                    </a>
                                <center>
                            </div>
                            <script>
                                var volumeAtual = {{ $reservatorio->volume_atual }};
                                var volumeMaximo = {{ $reservatorio->volume_maximo }};
                                var volumeLivre = volumeMaximo - volumeAtual;

                                var ctx = document.getElementById(`{{ $reservatorio->id }}`).getContext('2d');
                                console.log('{{ $reservatorio->id }}')
                                new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: ['Usado', 'Livre'],
                                        datasets: [{
                                            data: [volumeAtual, volumeLivre], // Valores
                                            backgroundColor: ['rgba(94, 105, 255)', '#7f8c8d'],
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            title: {
                                                display: true,
                                                text: '{{ $reservatorio->nome }}',
                                                font: {
                                                    size: 18
                                                }
                                            },
                                            legend: {
                                                position: 'bottom',
                                            }
                                        }
                                    }
                                });
                            </script>
                        @endif
                    @endforeach
                </div>
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
                                @foreach ($reservatorios as $reservatorio)
                                    @if (Auth::user()->id == $reservatorio->user_id)
                                        '{{ $reservatorio->nome }}',
                                    @endif
                                @endforeach
                            ],
                            datasets: [{
                                label: 'Armazenamento em relação a outros reservatorios',
                                data: [
                                    @foreach ($reservatorios as $reservatorio)
                                        @if (Auth::user()->id == $reservatorio->user_id)
                                            '{{ $reservatorio->volume_atual }}',
                                        @endif
                                    @endforeach
                                ],
                                backgroundColor: 'rgba(94, 105, 255, 0.2)',
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
            @endif
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Novo reservatorio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/createreservatorio/{{ Auth()->user()->id }}" method="post">
                                @csrf
                                <label for="nome">Nome do Reservatório:</label>
                                <input type="text" name="nome" id="nome" class="input-text">
                                @if ($errors->has('nome'))
                                    <div class="text-danger">{{ $errors->first('nome') }}</div>
                                @endif
                                <br><br>

                                <label for="volume_maximo">Volume Máximo:</label>
                                <input type="number" name="volume_maximo" id="volume_maximo" class="input-text">
                                @if ($errors->has('volume_maximo'))
                                    <div class="text-danger">{{ $errors->first('volume_maximo') }}</div>
                                @endif
                                <br><br>

                                <label for="volume_atual">Volume Atual:</label>
                                <input type="number" name="volume_atual" id="volume_atual" class="input-text">
                                @if ($errors->has('volume_atual'))
                                    <div class="text-danger">{{ $errors->first('volume_atual') }}</div>
                                @endif
                                <br><br>

                                <label for="mac">MAC do Microcontrolador:</label>
                                <input type="text" name="mac" id="mac" class="input-text"/>
                                @if ($errors->has('mac'))
                                    <div class="text-danger">{{ $errors->first('mac') }}</div>
                                @endif
                                <br><br>

                                <label for="descricao">Descrição:</label>
                                <textarea name="descricao" id="descricao" class="input-text"></textarea>
                                @if ($errors->has('descricao'))
                                    <div class="text-danger">{{ $errors->first('descricao') }}</div>
                                @endif
                                <br><br>

                                <hr>
                                <input type="submit" class="btn btn-primary" style="background-color: rgb(94, 105, 255)" value="Criar">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
