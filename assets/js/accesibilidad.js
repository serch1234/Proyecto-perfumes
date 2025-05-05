  // Mostrar el modal de preguntas frecuentes
  document.getElementById('faqButton').onclick = function () {
    $('#faqModal').modal('show');
};

let currentFontSize = 16; // Tamaño de fuente predeterminado en píxeles

   function increaseFontSize() {
       currentFontSize += 2; // Aumentar el tamaño de la fuente en 2 píxeles
       document.body.style.fontSize = currentFontSize + 'px';
   }

   function decreaseFontSize() {
       if (currentFontSize > 10) { // Establecer un tamaño mínimo de fuente
           currentFontSize -= 2; // Disminuir el tamaño de la fuente en 2 píxeles
           document.body.style.fontSize = currentFontSize + 'px';
       }
   }

   // Asignar funciones a los botones después de que el documento esté completamente cargado
   document.addEventListener('DOMContentLoaded', function() {
       document.getElementById('increase-font').onclick = increaseFontSize;
       document.getElementById('decrease-font').onclick = decreaseFontSize;
   });

   const brightnessSlider = document.getElementById('range');
   const brightnessBox = document.getElementById('brightnessBox');

   brightnessSlider.addEventListener('input', function() {
       const brightnessValue = brightnessSlider.value;
       document.body.style.filter = `brightness(${brightnessValue}%)`;
   });

   // Mostrar/ocultar la caja de brillo
   document.getElementById('toggle-brightness').onclick = function() {
       brightnessBox.style.display = (brightnessBox.style.display === 'none' || brightnessBox.style.display === '') ? 'block' : 'none';
   };