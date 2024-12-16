@extends('layouts.main')

@section('title', "Sistema de monitoramento de reservatorio d'agua")

@section('content')
<style>
            *{
                margin: 0;
                font-family:Arial, Helvetica, sans-serif;
            }
            h1{
                font-size: 350%;
            }
            a{
                color: white;
                text-decoration: none;

            }
            button{
                margin-top: 1%;
                margin-left: 1%;
                background: #5E5DF0;
                border-radius: 999px;
                box-shadow: #5E5DF0 0 10px 20px -10px;
                box-sizing: border-box;
                color: #FFFFFF;
                cursor: pointer;
                font-family: Inter,Helvetica,"Apple Color Emoji","Segoe UI Emoji",NotoColorEmoji,"Noto Color Emoji","Segoe UI Symbol","Android Emoji",EmojiSymbols,-apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue","Noto Sans",sans-serif;
                font-size: 16px;
                font-weight: 700;
                line-height: 24px;
                opacity: 1;
                outline: 0 solid transparent;
                padding: 8px 18px;
                user-select: none;
                -webkit-user-select: none;
                touch-action: manipulation;
                width: fit-content;
                word-break: break-word;
                border: 0;
            }
            .container1{
                height: 100vh;
                width: 100%;
                background-image: url('https://www.ecospeed.co.uk/wp-content/uploads/2020/09/Dovestone-Reservoir.jpg');
            }
        </style>
<div class="container1">
    <button><a href="/login">Login</a></button> |<button><a href="/">Mais informações</a></button>
    <br><br><br><br><br><br><br><br>
    <center><h1>SISTEMA DE MONITORAMENTO DE RESERVATORIO D'AGUA</h1></center>
</div>

@endsection