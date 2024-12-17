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
    }

</style>

{{--Boostratp--}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<div class="sidebar">
    <a href="/dashboard" alt="dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-droplet" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M7.21.8C7.69.295 8 0 8 0q.164.544.371 1.038c.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10a6 6 0 0 1-12 0C2 6.668 5.58 2.517 7.21.8m.413 1.021A31 31 0 0 0 5.794 3.99c-.726.95-1.436 2.008-1.96 3.07C3.304 8.133 3 9.138 3 10a5 5 0 0 0 10 0c0-1.201-.796-2.157-2.181-3.7l-.03-.032C9.75 5.11 8.5 3.72 7.623 1.82z"/>
            <path fill-rule="evenodd" d="M4.553 7.776c.82-1.641 1.717-2.753 2.093-3.13l.708.708c-.29.29-1.128 1.311-1.907 2.87z"/>
        </svg>
    </a><br><br>
        @if (Auth::user()->is_admin)
        <a href="/users">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
            </svg>
        @endif
    <a href="/login" alt="logout">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
        </svg>
    </a>
</div>

<div class="reservatorios-container">
    <div class="reservatorios-box">
        <h1>Reservatórios de {{ Auth::user()->name }}</h1>

        {{--Importando biblioteca de graficos--}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        {{--Reservatorios do usuario--}}
        {{-- @php
            dd($reservatorios);
        @endphp --}}

        <div id="div-graficos" style="display: flex;">
            @foreach ($reservatorios as $reservatorio)
            <div class="graficos" id="div-{{$reservatorio->id}}">
                <center>
                    <canvas id='{{ $reservatorio->id }}'></canvas>
                    <button class="btn btn-primary">Mais informações</button>
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
             @endforeach
        </div>


    </div>
</div>

@endsection
