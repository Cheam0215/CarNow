const myCar = document.getElementById("cars");
const myAccount = document.getElementById("account");
const carsInfo = document.querySelector(".cars-info");
const formGroups = document.querySelectorAll(".form-group");
const accountHeader = document.getElementById("account-header");
const carsHeader = document.getElementById("cars-header");
const buttons = document.getElementById("buttons-form");

$(document).ready(function() {
  // Handle click event for edit buttons
  $(document).on("click", ".close-button i", function() {
    document.querySelector('.add-car').style.visibility = 'hidden';
    document.querySelector('.edit-car').style.visibility = 'hidden';
  });
    // Handle click event for edit buttons
    $(document).on("click", ".edit-btn", function(event) {
        event.preventDefault();

        var $form = $(this).closest('.edit_form');
        
        $.ajax({
            url: "get_car.php",
            type: "POST",
            data: $form.serialize(),
            success: function(response) {
                $("#form-result").html(response).css('visibility', 'visible');
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });
});

function togglePasswordVisibility() {
  var passwordInput = document.getElementById("password");
  var showPasswordCheckbox = document.getElementById("show_password");
  
  if (showPasswordCheckbox.checked) {
      passwordInput.type = "text";
  } else {
      passwordInput.type = "password";
  }
}

function showCars() {
  myCar.classList.add("active");
  myAccount.classList.remove("active");
  formGroups.forEach(function(formGroup) {
    formGroup.classList.add("hide");
  });
  buttons.classList.add("hide");
  accountHeader.classList.add("hide");
  carsInfo.classList.remove("hide");

}

function showAccount() {
  myAccount.classList.add("active");
  myCar.classList.remove("active");
  formGroups.forEach(function(formGroup) {
    formGroup.classList.remove("hide");
  });
  buttons.classList.remove("hide");
  carsInfo.classList.add("hide");
  accountHeader.classList.remove("hide");
}

const addButton = document.getElementById('car-button-add');
const closeButton = document.querySelectorAll(".close-button i");
const editItems = document.querySelectorAll('.edit-btn');

// Ensure addButton exists before adding an event listener
if (addButton) {
  addButton.addEventListener('click', () => {
    document.querySelector('.add-car').style.visibility = 'visible';
  });
}

// Ensure editItems exist and add event listeners
editItems.forEach((editItem) => {
  editItem.addEventListener('click', () => {
    document.getElementById('form-result').style.visibility = 'visible';
  });
});

// Ensure closeButton elements exist and add event listeners
closeButton.forEach(function(button) {
  button.addEventListener('click', function() {
    document.querySelector('.add-car').style.visibility = 'hidden';
    document.querySelector('.edit-car').style.visibility = 'hidden';
  });
});
