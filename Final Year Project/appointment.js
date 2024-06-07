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
    hideDetailsSection()
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
    hidePaymentSection();
    showDoneSection();
    paymentProgressToTick();
    const date = new Date().toLocaleString();
    document.getElementById('payment-date').textContent = date;
}

function doneBooking(){
    ;
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
    const carIssue = document.getElementById('car-issue').value;
    const carPlate = document.getElementById('carPlate').value;
    const appointmentDate = document.getElementById('appointmentDate').value;
    const appointmentTime = document.getElementById('appointmentTime').value;

    document.getElementById('car-issue-done').textContent = carIssue;
    document.getElementById('car-plate').textContent = carPlate;
    document.getElementById('appointment-date').textContent = appointmentDate;
    document.getElementById('appointment-time').textContent = appointmentTime;
}

