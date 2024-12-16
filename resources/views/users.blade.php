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

<div class="users-container">
    <div class="users-box">
        <h1>Usuarios</h1>
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
