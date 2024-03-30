document.addEventListener('DOMContentLoaded', function () {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const defaultSidebar = document.getElementById('default-sidebar');

    if (sidebarToggle && defaultSidebar) {
        sidebarToggle.addEventListener('click', function () {
            defaultSidebar.classList.toggle('-translate-x-full');
        });

        document.addEventListener('click', function (event) {
            const isClickInsideSidebar = defaultSidebar.contains(event.target);
            const isClickOnToggle = sidebarToggle.contains(event.target);

            if (!isClickInsideSidebar && !isClickOnToggle) {
                defaultSidebar.classList.add('-translate-x-full');
            }
        });
    }
});