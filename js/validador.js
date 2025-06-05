function validaPsw() {
  const psw = document.getElementsByName("txtContrasena")[0];
  const psw2 = document.getElementsByName("txtConfirmar")[0];
  const mensajeDiv = document.getElementById("mensaje");

  while (mensajeDiv.firstChild) {
    mensajeDiv.removeChild(mensajeDiv.firstChild);
  }

  if (psw.value !== psw2.value) {
    const p = document.createElement("p");
    p.textContent = "Las contraseñas no coinciden.";
    p.style.color = "red";
    mensajeDiv.appendChild(p);

    psw.value = "";
    psw2.value = "";

    psw.focus();

    return false;
  }

  return true;
}

function validarAvance() {
  const paginasLeidas = document.getElementById("paginas_leidas");
  const paginasTotales = document.getElementById("paginas_totales");
  const mensajeDiv = document.getElementById("mensaje");

  while (mensajeDiv.firstChild) {
    mensajeDiv.removeChild(mensajeDiv.firstChild);
  }

  const leidas = parseInt(paginasLeidas.value, 10);
  const totales = parseInt(paginasTotales.value, 10);

  if (isNaN(leidas) || isNaN(totales)) {
    const p = document.createElement("p");
    p.textContent = "Ambos campos deben contener números válidos.";
    p.style.color = "red";
    mensajeDiv.appendChild(p);
    return false;
  }

  if (leidas > totales) {
    const p = document.createElement("p");
    p.textContent = "Las páginas leídas no pueden ser mayores que las totales.";
    p.style.color = "red";
    mensajeDiv.appendChild(p);


    paginasLeidas.focus();

    return false;
  }

  return true;
}
