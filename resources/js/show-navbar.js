document.addEventListener("DOMContentLoaded", function () {
 
    const openMenuButton = document.getElementById('open-menu');
    const closeMenuButton = document.getElementById('close-menu');
    const menu = document.getElementById('menu');


    openMenuButton.addEventListener('click', function () {
        menu.classList.remove('hidden');
    });

    closeMenuButton.addEventListener('click', function () {
        menu.classList.add('hidden');
    });
});