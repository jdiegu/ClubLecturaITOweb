const inputImagen = document.getElementById("imagen");
const vistaPrevia = document.getElementById("vista-previa");

inputImagen.addEventListener("change", function () {
  const archivo = this.files[0];
  if (archivo) {
    const lector = new FileReader();
    lector.onload = function (e) {
      vistaPrevia.src = e.target.result;
      vistaPrevia.style.display = "block";
    };
    lector.readAsDataURL(archivo);
  } else {
    vistaPrevia.src = "#";
    vistaPrevia.style.display = "none";
  }
});
