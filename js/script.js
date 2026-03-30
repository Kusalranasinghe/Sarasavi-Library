const menuIcon = document.getElementById('menu-icon');
const navbar = document.querySelector('.navbar');

if(menuIcon){
    menuIcon.addEventListener('click', () => {
        navbar.classList.toggle('active');
    });
}

