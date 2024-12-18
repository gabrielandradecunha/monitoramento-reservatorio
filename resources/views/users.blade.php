@extends('layouts.main')

@section('title', "Dashboard")

@section('content')

{{-- Bootsrap --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

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
        overflow: auto; /* Adiciona rolagem se necessário */
    }
    .sidebar a {
        text-decoration: none;
        color: #5E69FF;
        margin-bottom: 10px;
        display: block;
        white-space: nowrap;
    }

    .users-container {
        overflow: auto;
        position: relative;
        margin-left: 4%;
        width: 100%;
        display: flex;
        flex-direction: column;
        padding: 1%;
    }

    .users-box {
        padding: 3%;
        background-color: white;
        box-shadow: 4px 0 8px rgba(0, 0, 0, 0.2);
        height: 100%;
        width: 100%;
    }

    .userbox{
        background-color:white;
        border: 1px solid black;
        padding: 2%;
        margin-bottom: 1%;
        overflow: hidden;
    }
    .novousuario{
        background: #5E5DF0;
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 0.5%;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s ease;
    }
    .novousuario:hover{
        background: #fff;
        color: #5E5DF0;
    }

    .deletarusuario{
        color:red;
        position: absolute;
        right: 10%;
        transform: translateY(-50%);
        cursor: pointer;
    }

    /* Responsividade para telas menores */
    @media (max-width: 768px) {
        .sidebar {
            width: 10%;
        }
        .users-container {
            margin-left: 10%;
        }
    }

    @media (max-width: 480px) {
        .sidebar {
            width: 15%;
        }
        .users-container {
            margin-left: 15%;
        }
    }

</style>

{{--Incluindo sidebar--}}

@include('includes.sidebar')

<div class="users-container">
    <div class="users-box">
        <h1>Usuarios</h1>
        <hr>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Novo usuario</button><br><br>
        @foreach($usuarios as $usuario)
            <div class="userbox">
            <h3>{{$usuario->name;}}</h3><a class="deletarusuario" href="/deleteuser/{{ $usuario->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/><path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/></svg></a>
            @if ($usuario->is_admin)
                <i>Administrador</i><br>
            @else
                <i>Usuario</i><br>
            @endif
            <i>{{$usuario->email}}</i><br>
            <i>{{$usuario->created_at->format('d/m/Y H:i')}}</i>
            </div>
        @endforeach

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Novo usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/createuser" method="post">
                            @csrf
                            <label for="">Nome:</label>
                            <input type="text" name="name" id=""><br>
                            <label for="">Email:</label>
                            <input type="email" name="email" id=""><br>
                            <label for="">Senha:</label>
                            <input type="password" name="password" id=""><br>
                            <label for="">Nivel de acesso:</label><br>
                            <label>
                                Admin: <input type="radio" name="is_admin" value="1">
                            </label><br>
                            <label>
                                User: <input type="radio" name="is_admin" value="0">
                            </label><br>
                            <hr>
                            <input type="submit" class="btn btn-primary" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
