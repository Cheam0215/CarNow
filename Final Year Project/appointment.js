
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
    const carPlate = document.getElementById('carPlate').value;
    const appointmentDate = document.getElementById('appointmentDate').value;
    const appointmentTime = document.getElementById('appointmentTime').value;

    if (carPlate && appointmentDate && appointmentTime) {
        showRecordSection();
        hideStartButton();
        hideDetailsSection()
        detailsProgressToTick();
    } else {
        alert("Please fill out all the fields.");
    }
   
}

function handleSubmit(event) {
    const carIssue = document.getElementById('car-issue').value;
    const carIssueDescription = document.getElementById('car-issue-description').value;

    if (carIssue && carIssueDescription) {
        event.preventDefault();
        hideRecordSection();
        showPaymentSection();
        detailsProgressToTick();
        inProgressToTick();
        populateInvoice();
    } else {
        alert("Please fill out all the fields.");
    }

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
    const description = document.getElementById('car-issue-description').value;

    // Set the values of hidden input fields
    document.getElementById('hidden-car-issue').value = carIssue;
    document.getElementById('hidden-carPlate').value = carPlate;
    document.getElementById('hidden-appointmentDate').value = appointmentDate;
    document.getElementById('hidden-appointmentTime').value = appointmentTime;
    document.getElementById('hidden-description').value = description;

    document.getElementById('car-issue-done').textContent = carIssue;
    document.getElementById('car-plate').textContent = carPlate;
    document.getElementById('appointment-date').textContent = appointmentDate;
    document.getElementById('appointment-time').textContent = appointmentTime;
    document.getElementById('description').textContent = description;
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
