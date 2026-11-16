
// grafico de barras 

const graficoBarras = document.getElementById("graficoBarras");

if (graficoBarras) {
    new Chart(graficoBarras, {
        type: "bar",
        data: {
            labels: ["DOM", "SEG", "TER", "QUA", "QUI", "SEX", "SAB"],
            datasets: [{
                data: [20, 65, 30, 85, 50, 15, 60],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}


// grafico circular 

const graficoPizza = document.getElementById("graficoPizza");

if (graficoPizza) {
    new Chart(graficoPizza, {
        type: "doughnut",
        data: {
            labels: ["Concluídas", "Disponíveis", "Pendentes"],
            datasets: [{
                data: [40, 30, 30],
            }]
        }
    });
}
