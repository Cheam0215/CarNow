function startMaintenance(bookingId, carPlate) {
    window.location.href = "MT.php?booking_id=" + bookingId + "&car_plate=" + carPlate;
}

function showSection(section) {
    const pendingSection = document.getElementById('pendingSection');
    const bookedSection = document.getElementById('bookedSection');
    const pendingButton = document.getElementById('pendingButton');
    const bookedButton = document.getElementById('bookedButton');
    const inServiceSection = document.getElementById('inServiceSection');
    const inServiceButton = document.getElementById('inServiceButton');

    if (section === 'pending') {
        pendingSection.style.display = 'block';
        bookedSection.style.display = 'none';
        inServiceSection.style.display = 'none';
        pendingButton.classList.add('active');
        bookedButton.classList.remove('active');
        inServiceButton.classList.remove('active');
    } else if (section === 'booked') {
        pendingSection.style.display = 'none';
        bookedSection.style.display = 'block';
        inServiceSection.style.display = 'none';
        pendingButton.classList.remove('active');
        bookedButton.classList.add('active');
        inServiceButton.classList.remove('active');
    } else if(section === 'inService') {
        pendingSection.style.display = 'none';
        bookedSection.style.display = 'none';
        inServiceSection.style.display = 'block';
        pendingButton.classList.remove('active');
        bookedButton.classList.remove('active');
        inServiceButton.classList.add('active');
    }
}

showSection('pending');