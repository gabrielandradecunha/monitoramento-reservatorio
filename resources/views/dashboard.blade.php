@extends('layouts.main')

@section('title', "Dashboard")

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        background-color: rgb(240, 240, 240);
        display: flex;
        min-height: 100vh;
    }

    .sidebar {
        padding: 0.5%;
        background-color: white;
        height: 100vh;
        width: 4%; /* Largura fixa da sidebar */
        position: fixed;
        box-shadow: 4px 0 8px rgba(0, 0, 0, 0.2); /* Sombra */
        top: 0;
        left: 0;
        display: flex;
        flex-direction: column; /* Organiza os itens em uma coluna */
        justify-content: flex-start; /* Garante que os links fiquem no topo */
        overflow-y: auto; /* Adiciona rolagem se necessário */
    }
    .sidebar a {
        text-decoration: none;
        color: #5E69FF;
        margin-bottom: 10px;
        display: block;
        white-space: nowrap;
    }

    .reservatorios-container {
        margin-left: 4%;
        width: 100%;
        height: 100vh;
        /*display: flex;*/
        flex-direction: column;
        padding: 1%;
    }

    .reservatorios-box {
        padding: 3%;
        background-color: white;
        box-shadow: 4px 0 8px rgba(0, 0, 0, 0.2);
        display: inline-block;
        height: 100%;
        width: 100%;
        overflow: auto;
        display: inline-block;
    }

    .graficos{
        width: 20%;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 10%;
        }
        .
        .reservatorios-container {
            margin-left: 10%;
        }
    }

    @media (max-width: 480px) {
        .sidebar {
            width: 15%;
        }
        .reservatorios-container {
            margin-left: 15%;
        }

        .btn-primary{
            width: 10%;
        }
    }

</style>

{{--Boostratp--}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

{{--Incluindo sidebar--}}

@include('includes.sidebar')

<div class="reservatorios-container">
    <div class="reservatorios-box">
        <h1>Reservatórios de {{ Auth::user()->name }}</h1>
        <hr>

        {{--Importando biblioteca de graficos--}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        {{--Reservatorios do usuario--}}
        {{-- @php
                dd($reservatorios);
            @endphp --}}

        <div id="div-graficos" style="display: flex;">
            @foreach ($reservatorios as $reservatorio)
                @if (Auth::user()->id == $reservatorio->user_id)
                    <div class="graficos" id="div-{{$reservatorio->id}}">
                        <center>
                            <canvas id='{{ $reservatorio->id }}'></canvas>
                            <button class="btn btn-primary"><a href="/reservatorio/{{$reservatorio}}" style="color: white; text-decoration:none;">Mais informações</a></button>
                        </center>
                    </div>
                    <script>
                        // Dados do reservatório
                        var volumeAtual = {{$reservatorio->volume_atual}};
                        var volumeMaximo = {{$reservatorio->volume_maximo}};
                        var volumeLivre = volumeMaximo - volumeAtual;

                        // Configuração do gráfico de pizza
                        var ctx = document.getElementById(`{{ $reservatorio->id }}`).getContext('2d');
                        console.log('{{$reservatorio->id}}')
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


    </div>
</div>

@endsection
