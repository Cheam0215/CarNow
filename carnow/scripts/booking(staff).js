function startMaintenance(bookingId, carPlate) {
    window.location.href = "MT.php?booking_id=" + bookingId + "&car_plate=" + carPlate;
}

function showSection(section) {
    const pendingSection = document.getElementById('pendingSection');
    const bookedSection = document.getElementById('bookedSection');
    const pendingButton = document.getElementById('pendingButton');
    const bookedButton = document.getElementById('bookedButton');

    if (section === 'pending') {
        pendingSection.style.display = 'block';
        bookedSection.style.display = 'none';
        pendingButton.classList.add('active');
        bookedButton.classList.remove('active');
    } else if (section === 'booked') {
        pendingSection.style.display = 'none';
        bookedSection.style.display = 'block';
        pendingButton.classList.remove('active');
        bookedButton.classList.add('active');
    }
}

showSection('pending');
