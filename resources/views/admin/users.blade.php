@extends('layouts.main')

@section('title', 'Users')

@section('content')

    {{-- Incluindo css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/users.css') }} ">

    {{-- Incluindo sidebar --}}
    @include('includes.sidebar')

    <div class="users-container">
        <div class="users-box">
            <h1>Usuarios</h1>
            <hr>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="background-color: rgb(94, 105, 255)">Novo
                usuario</button><br><br>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Nivel de acesso</th>
                            <th scope="col">Email</th>
                            <th scope="col">Criado em</th>
                            <th scope="">Deletar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td scope="row">{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                @if ($usuario->is_admin)
                                    <td>Administrador</td>
                                @else
                                    <td>Usuario</td>
                                @endif
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->created_at->format('d/m/Y H:i') }}</td>
                                <td><a href="/deleteuser/{{ $usuario->id }}" style="color: red;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                        </svg></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
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
                                <label for="name">Nome:</label>
                                <input type="text" name="name" id="name" class="input-text" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                                <br><br>

                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="input-text" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                                <br><br>

                                <label for="password">Senha:</label>
                                <input type="password" name="password" id="password" class="input-text">
                                @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                @endif
                                <br><br>

                                <hr>
                                <label for="">Nivel de acesso:</label><br>
                                <label>
                                    Admin <input type="radio" name="is_admin" value="1" {{ old('is_admin') == 1 ? 'checked' : '' }}>
                                </label>
                                <label>
                                    User <input type="radio" name="is_admin" value="0" {{ old('is_admin') == 0 ? 'checked' : '' }}>
                                </label><br>
                                @if ($errors->has('is_admin'))
                                    <div class="text-danger">{{ $errors->first('is_admin') }}</div>
                                @endif
                                <hr>
                                <input type="submit" class="btn btn-primary" style="background-color: rgb(94, 105, 255)" value="Enviar">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
