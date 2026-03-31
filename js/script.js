const menuIcon = document.getElementById('menu-icon');
const navbar = document.querySelector('.navbar');

if(menuIcon){
    menuIcon.addEventListener('click', () => {
        navbar.classList.toggle('active');
    });
}

function confirmDelete() {
    return confirm("Are you sure you want to delete this user? This action cannot be undone.");
}