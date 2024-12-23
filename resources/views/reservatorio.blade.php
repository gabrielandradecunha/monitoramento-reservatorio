@extends('layouts.main')

@section('title', $reservatorio->nome)

@section('content')

    {{-- Incluindo css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/dashboard.css') }} ">

    {{-- Incluindo sidebar --}}

    @include('includes.sidebar')

    <div class="reservatorios-container">
        <div class="reservatorios-box">
            <a href="/dashboard" style="text-decoration: none; color: #5E69FF;"><svg xmlns="http://www.w3.org/2000/svg"
                    width="40" height="40" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
                </svg></a><br><br>
            <h1>{{ $reservatorio->nome }}</h1>
            @method('delete')
            <i>Ultima atualização: {{ $reservatorio->updated_at }}</i><a href="/deletarreservatorio/{{ $reservatorio->id }}"
                style="text-align: right; display: block;">
                <form action="/deletarreservatorio/{{ $reservatorio->id }}" method="POST" style="text-align: right; display: block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Deletar reservatório</button>
                </form>
            </a><br>

            <hr>
        </div>
    </div>

@endsection
