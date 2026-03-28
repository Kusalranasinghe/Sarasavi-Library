function initializeChart(canvasId, labels, data){
    const ctx = document.getElementById(canvasId).getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Books Borrowed',
                data: data,
                backgroundColor: 'rgba(59,130,246,0.2)',
                borderColor: 'rgba(59,130,246,1)',
                borderWidth: 3,
                tension: 0.3,
                fill: true,
                pointBackgroundColor: 'rgba(59,130,246,1)',
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
}