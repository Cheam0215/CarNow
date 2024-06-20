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