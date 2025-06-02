function scrollAlFinal() {
    const mensajes = document.getElementById("mensajes");
    mensajes.scrollTop = mensajes.scrollHeight;
  }

  // Scroll al fondo al cargar
  window.onload = scrollAlFinal;