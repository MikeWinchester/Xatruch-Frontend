/*function chooseSeat(seatId){

    const confirmBt = document.getElementById('confirm-bt');
    document.getElementById(seatId).style.backgroundColor = 'red';
    confirmBt.setAttribute('form', seatId);
    confirmBt.disabled = false;

}*/

function selectSeat(seatId) {
    // Desactivar todos los asientos
    var allSeats = document.querySelectorAll('.asiento');
    allSeats.forEach(function(seat) {
        seat.classList.remove('selected');
    });

    var selectedSeat = document.getElementById(seatId);
    selectedSeat.classList.add('selected');

    var confirmBt = document.getElementById('confirm-bt');
    confirmBt.setAttribute('form', seatId)
    confirmBt.disabled = false;
    confirmBt.style.backgroundColor = '#5144b1';
    confirmBt.style.cursor = 'pointer';
    confirmBt.classList.add('lol');
}