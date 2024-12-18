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

<h1>{{$nome}}</h1>

@endsection
