document.addEventListener("DOMContentLoaded", function () {
    const openMenuButton = document.getElementById('open-menu');
    const closeMenuButton = document.getElementById('close-menu');
    const menu = document.getElementById('menu');
    const openMenus = document.querySelectorAll('.test');

    function hideMenu() {
        menu.classList.add('hidden');
    }

    function showMenu() {
        menu.classList.remove('hidden');
    }

    openMenus.forEach(function (openMenu) {
        openMenu.addEventListener('click', hideMenu);
    });

    openMenuButton.addEventListener('click', showMenu);
    closeMenuButton.addEventListener('click', hideMenu);
});
