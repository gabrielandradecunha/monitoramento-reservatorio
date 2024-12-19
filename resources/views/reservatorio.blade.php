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

{{--Incluindo sidebar--}}

@include('includes.sidebar')

<div class="reservatorios-container">
    <div class="reservatorios-box">
        <a href="/dashboard" style="text-decoration: none; color: #5E69FF;"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">   <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/> </svg></a><br><br>
        <h1>{{$reservatorios->nome}}</h1>
    </div>
</div>

@endsection
