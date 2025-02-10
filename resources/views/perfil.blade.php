@extends('layouts.main')

@section('title', 'Perfil')

@section('content')

    {{-- Incluindo css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/perfil.css') }} ">

    {{-- Incluindo sidebar --}}
    @include('includes.sidebar')

    <div class="perfil-container">
        <div class="perfil-box">
            <h1>{{ Auth::user()->name }}</h1>
            <hr>
            <h3>Informações <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                    style="background-color: rgb(0, 0, 0, 0 ); border: none;"><svg xmlns="http://www.w3.org/2000/svg"
                        width="25" height="25" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                        <path
                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                    </svg></a></h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Nivel de acesso</th>
                            <th scope="col">Email</th>
                            <th scope="col">Criado em</th>
                            <th scope="col">Atualizado em</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ Auth::user()->name }}</td>
                            @if (Auth::user()->is_admin == 1)
                                <td>Administrador</td>
                            @else
                                <td>Usuario</td>
                            @endif
                            <td>{{ Auth::user()->email }}</td>
                            <td>{{ Auth::user()->created_at }}</td>
                            <td>{{ Auth::user()->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
                {{-- Vazio pois o usuario não possui reservatorios --}}
            @else
                <br>
                <hr><br>
                <h3>Reservatorios de <i>{{ Auth::user()->name }}</i></h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Volume Atual</th>
                                <th scope="col">Volume Maximo</th>
                                <th scope="col">Criado em</th>
                                <th scope="">Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservatorios as $reservatorio)
                                @if (Auth::user()->id == $reservatorio->user_id)
                                    <tr>
                                        <td>{{ $reservatorio->nome }}</td>
                                        <td>{{ $reservatorio->volume_atual }}</td>
                                        <td>{{ $reservatorio->volume_maximo }}</td>
                                        <td>{{ $reservatorio->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <form action="/deletarreservatorio/{{ $reservatorio->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    Deletar</button>
                                        </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar perfil</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/editarperfil/{{ Auth()->user()->id }}" method="post">
                                @method('PUT')
                                @csrf
                                <label for="nome">Nome:</label>
                                <input type="text" name="name" id="nome" class="input-text"
                                    value="{{ Auth::user()->name }}">
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('nome') }}</div>
                                @endif
                                <br><br>
                                <label for="volume_maximo">Email:</label>
                                <input type="email" name="email" id="email" class="input-text"
                                    value="{{ Auth::user()->email }}">
                                @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                                <br><br>

                                <hr>
                                <input type="submit" class="btn btn-primary" style="background-color: rgb(94, 105, 255)" value="Salvar">
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
