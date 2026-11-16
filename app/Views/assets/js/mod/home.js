document.addEventListener("DOMContentLoaded", function () {

    // GRÁFICO DE BARRAS
    new Chart(document.getElementById("graficoBarras"), {
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

    // GRÁFICO CIRCULAR
    new Chart(document.getElementById("graficoPizza"), {
        type: "doughnut",
        data: {
            labels: ["Concluídas", "Disponíveis", "Pendentes"],
            datasets: [{
                data: [40, 30, 30],
            }]
        }
    });

});