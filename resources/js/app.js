import './bootstrap';

document.addEventListener("DOMContentLoaded", function () {
    const dropdownButton = document.querySelector('[aria-haspopup="listbox"]');
    const optionsList = document.querySelector('ul[role="listbox"]');
    const options = document.querySelectorAll('ul[role="listbox"] li');
  
    dropdownButton.addEventListener("click", function (event) {
      optionsList.classList.toggle("hidden");
      event.stopPropagation(); // Impede que o evento de clique se propague para o documento
    });
  
    document.addEventListener("click", function (event) {
      if (!event.target.closest('ul[role="listbox"]')) {
        optionsList.classList.add("hidden");
      }
    });
  
    options.forEach((option) => {
      option.addEventListener("click", function () {
        const selectedOptionText = option.querySelector(".truncate").textContent;
        const selectedOptionSVG = option.querySelector(".selected-svg");
        const deleteIcon = option.querySelector(".delete-icon");
  
        dropdownButton.querySelector(".truncate").textContent = selectedOptionText;
  
        // Oculta todos os SVGs de correto
        document.querySelectorAll(".selected-svg").forEach(svg => {
          svg.classList.add("hidden");
        });
  
        // Exibe o SVG de correto apenas na opção selecionada
        selectedOptionSVG.classList.remove("hidden");
  
        // Oculta a lista de opções após selecionar uma categoria
        optionsList.classList.add("hidden");
      });
    });
  });