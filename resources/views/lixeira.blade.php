@extends('layouts.main')

@section('title', 'Users')

@section('content')

    {{-- Incluindo css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/lixeira.css') }} ">

    {{-- Incluindo sidebar --}}
    @include('includes.sidebar')

    <div class="users-container">
        <div class="users-box">

            <h1>Lixeira</h1>
            <hr>

            @php

            $lixoCount = 0;

            @endphp
            @foreach ($lixos as $lixo)
            @if (Auth::user()->id == $lixo->user_id)
                @php
                    $lixoCount++;
                @endphp
            @endif
            @endforeach

            @if ($lixoCount <= 0)
                <br>
                <center><i>Você ainda não possui nenhum reservatorio na lixeira</i></center>
            @else
            <br>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Volume Atual</th>
                            <th scope="col">Volume Maximo</th>
                            <th scope="col">Criado em</th>
                            <th scope="col">Deletar</th>
                            <th scope="col">Restaurar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lixos as $lixo)
                            @if (Auth::user()->id == $lixo->user_id)
                                <tr>
                                    <td>{{ $lixo->nome }}</td>
                                    <td>{{ $lixo->volume_atual }}</td>
                                    <td>{{ $lixo->volume_maximo }}</td>
                                    <td>{{ $lixo->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <form action="/deletarlixo/{{ $lixo->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                Deletar</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/restaurarlixo/{{ $lixo->id }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-success">
                                                Restaurar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">   <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>   <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/> </svg></button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif


        </div>
    </div>

@endsection
