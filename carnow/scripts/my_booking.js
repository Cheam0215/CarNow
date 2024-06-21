const tabs = document.querySelectorAll('.tabs li');
const contents = document.querySelectorAll('.content');

tabs.forEach((tab,index) => {
  tab.addEventListener('click', () => {

    tabs.forEach(item => item.classList.remove('active'));

    tab.classList.add('active');

    contents.forEach(item => item.classList.remove('active'));

    contents[index].classList.add('active');
  });
});

tabs[0].click();

function openModal(maintenanceId) {
  var modal = document.getElementById('myModal');
  modal.classList.add('show');
  document.getElementById('maintenance_id').value = maintenanceId;
}

function closeModal() {
  var modal = document.getElementById('myModal');
  modal.classList.remove('show');
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName('close')[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  closeModal();
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  var modal = document.getElementById('myModal');
  if (event.target == modal) {
      closeModal();
  }
}


   