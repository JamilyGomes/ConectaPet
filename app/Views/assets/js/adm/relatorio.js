document.addEventListener("DOMContentLoaded", function () {

    // ABRIR MODAL
    window.abrirModal = function () {
        document.getElementById("modalExport").style.display = "flex";
    };

    // FECHAR MODAL
    window.fecharModal = function () {
        document.getElementById("modalExport").style.display = "none";
    };

    // EXPORTAR RELATÓRIO
    window.exportarRelatorio = function () {
        const csv = document.getElementById("csvCheck").checked;

        if (csv) {
            alert("Exportando relatório em CSV...");
            // Aqui depois ligar no backend PHP
        } else {
            alert("Selecione um formato de exportação!");
        }

        fecharModal();
    };

});