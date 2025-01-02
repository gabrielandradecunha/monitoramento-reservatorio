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
            

        </div>
    </div>

@endsection
