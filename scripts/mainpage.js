const aboutCards = document.querySelectorAll('.about-item');
const hiddenElements = document.querySelectorAll('.service-card');
const observer = new IntersectionObserver((entries) => { 
  
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        }
        else {
            entry.target.classList.remove('show');
        }
    });
});


aboutCards.forEach((card) => {
    observer.observe(card);
});

hiddenElements.forEach((element) => {
    observer.observe(element);
});
