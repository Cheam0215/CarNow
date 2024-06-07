const addButton = document.querySelector('.add-button');
const closeButton = document.querySelectorAll("i");

addButton.addEventListener('click', () => {
  document.querySelector('.add-item').style.visibility = 'visible';
  document.querySelector('.container').style.opacity = '0.3';
  document.querySelector('.container').style.pointerEvents = 'none';

});

closeButton.forEach(function(button) {
  button.addEventListener('click', function() {
    document.querySelector('.container').style.opacity = '1';
    document.querySelector('.add-item').style.visibility = 'hidden';
    document.querySelector('.container').style.pointerEvents = 'auto';
  });
});