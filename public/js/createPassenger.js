document.addEventListener('DOMContentLoaded', function () {
    const dateInputs = document.querySelectorAll('input[type="date"]');

    dateInputs.forEach(input => {
        input.addEventListener('change', function(event) {
            const birthDate = event.target.value;
            
            if (birthDate) {
                const birthYear = new Date(birthDate).getFullYear();

                if (birthYear > 2022) {
                    alert('El pasajero es menor de edad y por ello no paga boleto');
                }
            }
        });
    });
});
