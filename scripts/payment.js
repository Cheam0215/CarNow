const buttons = document.querySelector('.payment-methods');
const paypalButton = document.querySelector('.paypal-button');
const tngButton = document.querySelector('.tng-button');
const loading = document.querySelector('.loading');
const closeButton = document.querySelectorAll("i");

let loadingAnimation = false;

paypalButton.addEventListener('click', function() {
  loading.style.display = 'block';
  document.querySelector('.container').style.opacity = '0.3';
  document.querySelector('.container').style.pointerEvents = 'none';
  document.querySelector('h1').style.opacity = '0.3';
  loading.style.opacity = '1';

  setTimeout(function loadingEnd() {
    document.querySelector('.container').style.opacity = '1';
    document.querySelector('h1').style.opacity = '1';
    
    loading.style.display = 'none';
    loadingAnimation = true;
    afterLoad(); // Call afterLoad function after loading animation ends
  }, 1000);
});

tngButton.addEventListener('click', function() {
  loading.style.display = 'block';
  document.querySelector('.container').style.opacity = '0.3';
  document.querySelector('.container').style.pointerEvents = 'none';
  document.querySelector('h1').style.opacity = '0.3';
  loading.style.opacity = '1';

  setTimeout(function loadingEnd() {
    document.querySelector('.container').style.opacity = '1';
    document.querySelector('h1').style.opacity = '1';
    
    loading.style.display = 'none';
    loadingAnimation = true;
    afterLoadTNG(); 
  }, 1000);
});

function afterLoad() {
  if (loadingAnimation) {
    document.getElementById('paypal-gateway').style.visibility = 'visible';
    document.querySelector('.container').style.opacity = '0.3';
    
  }
}

function afterLoadTNG() {
  if (loadingAnimation) {
    document.getElementById('tng-gateway').style.visibility = 'visible';
    document.querySelector('.container').style.opacity = '0.3';
  }
}

closeButton.forEach(function(button) {
  button.addEventListener('click', function() {
    document.querySelector('.container').style.opacity = '1';
    document.getElementById('paypal-gateway').style.visibility = 'hidden';
    document.getElementById('tng-gateway').style.visibility = 'hidden';
    document.querySelector('.container').style.pointerEvents = 'auto';
    document.querySelector('h1').style.opacity = '1';
    loadingAnimation = false;
  });
});

