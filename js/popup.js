function popup(msg, dato1, dato2, dato3, dato4, action, clave1, clave2, operacion, opcion1 , opcion2) {

  console.log("asdas");

  const overPopup = document.createElement("div");
  overPopup.classList.add("popup-overlay");

  const popup = document.createElement("div");
  popup.classList.add("popup");

  const formu = document.createElement("form");
  formu.action = action;
  formu.method = "POST";

  const iclave = document.createElement("input");
  iclave.type = "hidden";
  iclave.name = "txtClave";
  iclave.value = clave1;

  const iope = document.createElement("input");
  iope.type = "hidden";
  iope.name = "txtOpe";
  iope.value = clave2;

  const idLibro = document.createElement("input");
  idLibro.type = "hidden";
  idLibro.name = "idLibro";
  idLibro.value = opcion2;

  formu.appendChild(iclave);
  formu.appendChild(iope);
  formu.appendChild(idLibro);

  const title = document.createElement("h4");
  title.textContent = msg;

  const d1 = document.createElement("p");
  d1.textContent = dato1;
  const d2 = document.createElement("p");
  d2.textContent = dato2;
  const d3 = document.createElement("p");
  d3.textContent = dato3;
  const d4 = document.createElement("p");
  d4.textContent = dato4;

  formu.appendChild(title);
  formu.appendChild(d1);
  formu.appendChild(d2);
  formu.appendChild(d3);
  formu.appendChild(d4);

  const enviar = document.createElement("input");
  enviar.type = "submit";
  enviar.name = "Submit";
  enviar.value = opcion1;

  const cancel = document.createElement("button");
  cancel.type = "button";
  cancel.textContent = "Cancelar";
  cancel.addEventListener("click", function () {
    document.body.removeChild(overPopup);
  });

  formu.appendChild(enviar);
  formu.appendChild(cancel);
  popup.appendChild(formu);

  overPopup.appendChild(popup);
  document.body.appendChild(overPopup);
}


function popupMsg(msg, redireccion) {

  const overPopup = document.createElement("div");
  overPopup.classList.add("popup-overlay");

  const popup = document.createElement("div");
  popup.classList.add("popup");

  const bloque = document.createElement("div");
  bloque.classList.add("msgpop");

  const title = document.createElement("h4");
  title.textContent = msg;

  const ok = document.createElement("button");
  ok.type = "button";
  ok.textContent = "Aceptar";

  ok.addEventListener("click", function () {
    window.location.href = redireccion
  });


  bloque.appendChild(title);
  bloque.appendChild(ok);

  popup.appendChild(bloque);

  overPopup.appendChild(popup);
  document.body.appendChild(overPopup);
}
