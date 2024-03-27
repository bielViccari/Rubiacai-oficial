import './bootstrap';


let defaultTransform = 0;
const nextBtn = document.getElementById("next");
const prevBtn = document.getElementById("prev");
const slider = document.getElementById("slider");
const itemWidth = slider.firstElementChild.offsetWidth + parseFloat(getComputedStyle(slider.firstElementChild).marginRight);
const itemsToShow = 2; // Definindo quantas categorias serão mostradas de cada vez

// Calculando o deslocamento máximo permitido
const maxTransform = -(slider.scrollWidth - slider.offsetWidth);

function goNext() {
    // Avança de duas em duas categorias
    defaultTransform -= itemWidth * itemsToShow;
    // Verifica se o deslocamento é maior que o máximo permitido
    if (defaultTransform < maxTransform) defaultTransform = maxTransform;
    slider.style.transform = `translateX(${defaultTransform}px)`;
}

function goPrev() {
    // Retrocede de duas em duas categorias
    defaultTransform += itemWidth * itemsToShow;
    // Verifica se o deslocamento é menor que 0
    if (defaultTransform > 0) defaultTransform = 0;
    slider.style.transform = `translateX(${defaultTransform}px)`;
}

nextBtn.addEventListener("click", goNext);
prevBtn.addEventListener("click", goPrev);