@extends('layouts.main')

@section('title', "Sistema de monitoramento de reservatório d'água")

@section('content')

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', Helvetica, sans-serif;
    }

    body, html {
        height: 100%;
        background-image: url('https://www.ecospeed.co.uk/wp-content/uploads/2020/09/Dovestone-Reservoir.jpg');
        /*background-size: cover;*/
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden; /* Para evitar rolagem desnecessária */
    }

    .form-container {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        padding: 30px;
        width: 100%;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .form-container h2 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }

    input[type="text"]:focus, input[type="password"]:focus {
        padding: 1%;
        border-color: #5E5DF0;
        outline: none;
    }

    .botao {
        background: #5E5DF0;
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 12px 30px;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
        transition: background 0.3s ease;
    }

    .botao:hover {
        background: #fff;
        color: #5E5DF0;
    }

    .form-container a {
        text-decoration: none;
        color: #5E5DF0;
        font-size: 14px;
        margin-top: 10px;
        display: inline-block;
    }

</style>

<div class="form-container">
    <h2>Login</h2>
    <form action="/login" method="post">
        @csrf
        <input type="text" name="email" placeholder="Digite seu e-mail" required><br><br>
        <input type="password" name="password" placeholder="Digite sua senha" required><br><br>
        <input type="submit" value="Entrar" class="botao">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <i>{{ $error }}</i>
            @endforeach
        @endif
    </form>
    <a href="#">Esqueceu a senha?</a>
</div>

@endsection
