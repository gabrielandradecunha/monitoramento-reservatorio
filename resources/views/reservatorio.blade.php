@extends('layouts.main')

@section('title', $reservatorio->nome)

@section('content')

    {{-- Incluindo css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/reservatorio.css') }} ">

    {{-- Incluindo sidebar --}}
    @include('includes.sidebar')

    <div class="reservatorios-container">
        <div class="reservatorios-box">

            <div style="display: flex; justify-content: space-between; align-items: center;">
                <!-- Link para o Dashboard -->
                <a href="/dashboard" style="text-decoration: none; color: #5E69FF;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
                    </svg>
                </a>
            
                <!-- Botão de Excluir -->
                <form action="/deletarreservatorio/{{ $reservatorio->id }}" method="POST" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer; color: red;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path
                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                            <path
                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                        </svg>
                    </button>
                </form>
            </div>
            <br>
            <h1>{{ $reservatorio->nome }}<a type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModal" style="background-color: rgb(0, 0, 0, 0 ); border: none;"><svg
                        xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                        class="bi bi-pen" viewBox="0 0 16 16">
                        <path
                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                    </svg></a></h1>
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
                    <i style="color: red"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                            fill="currentColor" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                        </svg></i>
                @else
                    <i style="color: green"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                            fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z" />
                        </svg></i>
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
                                <i style="color: red"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                        fill="currentColor" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                                    </svg></i></th>
                            <th scope="col">Retenção <i style="color: green"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z" />
                            </svg></i></th>
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

            {{-- Importando biblioteca de graficos --}}
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <div style="width: 100%; display: flex; justify-content: center; align-items: center;">
                <center><canvas id="graficoLinha" style="width: 300%"></canvas></center>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                const data = {
                    labels: [
                        @foreach ($historico_reservatorio as $hist_reserv)
                            '{{ $hist_reserv->data }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Historico de volume',
                        data: [
                            @foreach ($historico_reservatorio as $hist_reserv)
                                {{ $hist_reserv->volume }},
                            @endforeach
                        ],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.1,
                        fill: true,
                    }]
                };

                const config = {
                    type: 'line',
                    data: data,
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                beginAtZero: true
                            },
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                        },
                    },
                };

                const graficoLinha = new Chart(
                    document.getElementById('graficoLinha'),
                    config
                );
            </script>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar reservatorio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/updatereservatorio/{{ $reservatorio->id }}" method="post">
                                @csrf
                                <label for="nome">Nome do Reservatório:</label>
                                <input type="text" name="nome" id="nome" class="input-text"
                                    value="{{ $reservatorio->nome }}">
                                @if ($errors->has('nome'))
                                    <div class="text-danger">{{ $errors->first('nome') }}</div>
                                @endif
                                <br><br>

                                <label for="volume_maximo">Volume Máximo (Litros):</label>
                                <input type="number" name="volume_maximo" id="volume_maximo" class="input-text"
                                    value="{{ $reservatorio->volume_maximo }}">
                                @if ($errors->has('volume_maximo'))
                                    <div class="text-danger">{{ $errors->first('volume_maximo') }}</div>
                                @endif
                                <br><br>

                                <label for="volume_atual">Volume Atual (Litros):</label>
                                <input type="number" name="volume_atual" id="volume_atual" class="input-text"
                                    value="{{ $reservatorio->volume_atual }}">
                                @if ($errors->has('volume_atual'))
                                    <div class="text-danger">{{ $errors->first('volume_atual') }}</div>
                                @endif
                                <br><br>

                                <label for="descricao">Descrição:</label>
                                <textarea name="descricao" id="descricao" class="input-text">{{ $reservatorio->descricao }}</textarea>
                                @if ($errors->has('descricao'))
                                    <div class="text-danger">{{ $errors->first('descricao') }}</div>
                                @endif
                                <br><br>

                                <hr>
                                <input type="submit" class="btn btn-primary" value="Salvar">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br>
            <center><a href="/gerarpdf{{ $reservatorio->id }}" style="color: white; text-decoration: none;"><button class="btn btn-danger">Gerar PDF <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16"><path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/><path d="M4.603 14.087a.8.8 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.7 7.7 0 0 1 1.482-.645 20 20 0 0 0 1.062-2.227 7.3 7.3 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a11 11 0 0 0 .98 1.686 5.8 5.8 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.86.86 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.7 5.7 0 0 1-.911-.95 11.7 11.7 0 0 0-1.997.406 11.3 11.3 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.8.8 0 0 1-.58.029m1.379-1.901q-.25.115-.459.238c-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361q.016.032.026.044l.035-.012c.137-.056.355-.235.635-.572a8 8 0 0 0 .45-.606m1.64-1.33a13 13 0 0 1 1.01-.193 12 12 0 0 1-.51-.858 21 21 0 0 1-.5 1.05zm2.446.45q.226.245.435.41c.24.19.407.253.498.256a.1.1 0 0 0 .07-.015.3.3 0 0 0 .094-.125.44.44 0 0 0 .059-.2.1.1 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a4 4 0 0 0-.612-.053zM8.078 7.8a7 7 0 0 0 .2-.828q.046-.282.038-.465a.6.6 0 0 0-.032-.198.5.5 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822q.036.167.09.346z"/></svg></button></a></center>

        </div>
    </div>

@endsection
