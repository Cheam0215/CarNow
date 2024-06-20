document.addEventListener('DOMContentLoaded', () => {
    hideRecordSection();
    hidePaymentSection();
    hideDoneSection();
    showStartButton();
});x    

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
    const bookingId = document.getElementById('bookingId').value;
    const carIssue = document.getElementById('car-issue').value;

    document.getElementById('bookingId').value = bookingId;
    document.getElementById('hidden-car-issue').value = carIssue;
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

function addIssue() {
    const container = document.getElementById('car-issues-container');
    const newIssueRow = document.createElement('div');
    newIssueRow.classList.add('car-issue-row');
    newIssueRow.innerHTML = `
        <select name="car-issue[]">
            <option value="Change of Engine Oil">Change of Engine Oil</option>
            <option value="Change of Transmission Fluid">Change of Transmission Fluid</option>
            <option value="Oil Filter Renewal">Oil Filter Renewal</option>
            <option value="Air Filter Renewal">Air Filter Renewal</option>
            <option value="Refill Coolant">Refill Coolant</option>
            <option value="Change of Spark Plugs">Change of Spark Plugs</option>
        </select>
    `;
    container.prepend(newIssueRow);
}