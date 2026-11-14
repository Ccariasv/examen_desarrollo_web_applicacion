const formReserva = document.getElementById('formReserva');

if (formReserva) {
    formReserva.addEventListener('submit', function (evento) {
        const inicio = document.querySelector('[name="hora_inicio"]').value;
        const fin = document.querySelector('[name="hora_fin"]').value;

        if (fin <= inicio) {
            evento.preventDefault();
            alert('La hora de fin debe ser mayor que la hora de inicio.');
        }
    });
}
