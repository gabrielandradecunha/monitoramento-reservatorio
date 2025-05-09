function initChartLine(reserv_data, reserv_vol) {

    const data = {
        labels: reserv_data,
        datasets: [{
            label: 'Histórico de volume',
            data: reserv_vol,
            borderColor: 'rgba(94, 105, 255, 0.2)',
            backgroundColor: 'rgba(94, 105, 255, 0.2)',
            tension: 0.1,
            fill: true,
        }]
    };

    const config = {
        type: 'bar',
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
}
