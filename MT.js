document.addEventListener('DOMContentLoaded', () => {
    hideRecordSection();
    hidePaymentSection();
    hideDoneSection();
    showStartButton();
});

function hideRecordSection() {
    document.getElementById('record-section').style.display = 'none';
}

function hidePaymentSection() {
    document.getElementById('payment-section').style.display = 'none';
}

function hideDoneSection() {
    document.getElementById('done-section').style.display = 'none';
}

function showRecordSection() {
    document.getElementById('record-section').style.display = 'block';
}

function showPaymentSection() {
    document.getElementById('payment-section').style.display = 'block';
}

function showDoneSection() {
    document.getElementById('done-section').style.display = 'block';
}

function showStartButton() {
    document.getElementById('start').style.display = 'block';
}

function hideStartButton() {
    document.getElementById('start').style.display = 'none';
}

function hideDetailsSection() {
    document.getElementById('details').style.display = 'none';
}

function startMaintenance() {
    showRecordSection();
    hideStartButton();
    hideDetailsSection();
    detailsProgressToTick();
}

function handleSubmit(event) {
    event.preventDefault();
    hideRecordSection();
    showPaymentSection();
    detailsProgressToTick();
    inProgressToTick();
    populateInvoice();
}

function completePayment() {
    populateInvoice(); 
    hidePaymentSection();
    showDoneSection();
    paymentProgressToTick();
    const date = new Date().toLocaleString();
    document.getElementById('payment-date').textContent = date;
    document.getElementById('invoice-form').submit();
}

function doneBooking() {
    // Add logic for what happens when booking is done
}

function detailsProgressToTick() {
    document.getElementById('progress-one').classList.add('active');
}

function inProgressToTick() {
    document.getElementById('progress-two').classList.add('active');
}

function paymentProgressToTick() {
    document.getElementById('progress-three').classList.add('active');
}

function populateInvoice() {
    const bookingId = document.querySelector('input[name="booking_id"]').value;
    const carIssue = document.querySelector('select[name="car-issue"]').value;
    const carPlate = document.getElementById('carPlate').value;

    // Set the values of hidden input fields
    document.getElementById('hidden-bookingId').value = bookingId;
    document.getElementById('hidden-car-issue').value = carIssue;
    document.getElementById('hidden-carPlate').value = carPlate;

    // Optionally, you can populate other hidden fields if needed
}


function backProgress() {
    document.getElementById('progress-one').classList.remove('active');
}

function backProgressTwo() {
    document.getElementById('progress-two').classList.remove('active');
}

function backToDetails() {
    hideRecordSection();
    showDetailsSection();
    backProgress();
}

function backToRecord() {
    hidePaymentSection();
    showRecordSection();
    backProgressTwo();
}

function showDetailsSection() {
    document.getElementById('details').style.display = 'block';
    document.getElementById('start').style.display = 'block';
}
