@extends('layouts.main')

@section('title', $reservatorio->nome)

@section('content')

    {{-- Incluindo sidebar --}}
    @include('includes.sidebar')

    <div class="reservatorios-container">
        <div class="reservatorios-box">

            <div style="display: flex; justify-content: space-between; align-items: center;">
            
                <center><img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('imgs/logo-if.png'))) }}" alt="Logo" height="20%"></center>

            </div>
            <br>
            <h1>{{ $reservatorio->nome }}<a type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModal" style="background-color: rgb(0, 0, 0, 0 ); border: none;"></a></h1>
            @method('delete')
            <i>Ultima atualização: {{ $reservatorio->updated_at }}
                @php
                    $volume_anterior = null;
                    $down = false;
                @endphp

                @foreach ($historico_reservatorio as $hist_reserv)
                    @if ($volume_anterior !== null && $hist_reserv->volume < $volume_anterior)
                        @php
                            $down = true;
                        @endphp
                    @else
                        @php
                            $down = false;
                        @endphp
                    @endif

                    @php
                        $volume_anterior = $hist_reserv->volume;
                    @endphp
                @endforeach

                @if ($down)
                    <i style="color: red"></i>
                @else
                    <i style="color: green"></i>
                @endif
            </i>


            <br>

            @if ($reservatorio->descricao == null)
                {{-- Caso não haja descrição ele não exibira nada --}}
                <br>
            @else
                <hr>
                <h2>Descrição</h2>
                <p>{{ $reservatorio->descricao }}</p><br>
            @endif

            <h2>Graficos e Métricas</h2>
            <hr>

            @php
                $volume_anterior = null;
                $vazao = 0;
                $retencao = 0;
                $tempo_anterior = null;
                $velocidade_vazao = 0;
                $velocidade_retencao = 0;
            @endphp

            @foreach ($historico_reservatorio as $hist_reserv)
                @if ($volume_anterior !== null && $tempo_anterior !== null)
                    @php
                        $tempo_atual = strtotime($hist_reserv->data);
                        $tempo_diferenca = ($tempo_atual - $tempo_anterior) / 3600;
                        $vazao = $hist_reserv->volume - $volume_anterior;
                        $velocidade_vazao = $vazao / $tempo_diferenca;
                        if ($vazao < 0) {
                            $retencao = abs($vazao);
                            $velocidade_retencao = $retencao / $tempo_diferenca;
                        }
                    @endphp
                @endif

                @php
                    $volume_anterior = $hist_reserv->volume;
                    $tempo_anterior = strtotime($hist_reserv->data);
                @endphp
            @endforeach

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Vazão
                                <i style="color: red"><</i></th>
                            <th scope="col">Retenção <i style="color: green"></i></th>
                            <th scope="col">Velocidade da Vazão</th>
                            <th scope="col">Velocidade da Retenção</th>
                            <th scope="col">Taxa de atualização</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ number_format($vazao, 2, ',', '.') }}</td>
                            <td>{{ number_format($retencao, 2, ',', '.') }}</td>
                            <td>{{ number_format($velocidade_vazao, 2, ',', '.') }} l/h</td>
                            <td>{{ number_format($velocidade_retencao, 2, ',', '.') }} l/h</td>
                            @php
                                $tempo_atualizacao = 'N/A';

                                if (count($historico_reservatorio) >= 2) {
                                    // Ordenar o histórico por data em ordem decrescente, se necessário
                                    $historico_ordenado = $historico_reservatorio->sortByDesc('data')->values();

                                    $ultimo = strtotime($historico_ordenado[0]->data); // Última medição
                                    $penultimo = strtotime($historico_ordenado[1]->data); // Penúltima medição
                                    $diferenca = $ultimo - $penultimo; // Diferença em segundos

                                    if ($diferenca >= 0) {
                                        // Converter diferença para minutos
                                        $tempo_atualizacao = round($diferenca / 60, 2) . ' min';
                                    } else {
                                        $tempo_atualizacao = 'Erro: Datas inválidas';
                                    }
                                }
                            @endphp

                            <td>{{ $tempo_atualizacao }}</td>
                        </tr>
                </tbody>
                </table>
            </div>

            <br>
            <br><br><br>

        </div>
    </div>

@endsection
