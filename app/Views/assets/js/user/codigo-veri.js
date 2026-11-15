document.addEventListener('DOMContentLoaded', function () {

// campos codigo verificacao 
    const inputs = document.querySelectorAll(".codigo input");

    inputs.forEach((input, index) => {

        // Avança para o próximo campo
        input.addEventListener("input", () => {

            if (input.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }

        });

        // Volta para o campo anterior ao apertar Backspace
        input.addEventListener("keydown", (e) => {

            if (e.key === "Backspace" && input.value === "" && index > 0) {
                inputs[index - 1].focus();
            }

        });

    });

});