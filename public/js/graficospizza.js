function graficoPizza(volumeAtual, volumeMaximo, canvas, nome) {
    var volumeLivre = volumeMaximo - volumeAtual;
    // Configuração do gráfico de pizza
    var ctx = document.getElementById(canvas).getContext('2d');

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Usado', 'Livre'],
            datasets: [{
                data: [volumeAtual, volumeLivre],
                backgroundColor: ['#3498db', '#7f8c8d'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: nome,
                    font: {
                        size: 18
                    }
                },
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
}
