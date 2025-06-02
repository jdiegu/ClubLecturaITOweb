function eventos(datosFechas) {
  let fechas = [];
  for (let i = 0; i < datosFechas.length; i++) {
    let fechaObj = new Date(datosFechas[i].fecha);
    fechaObj.setDate(fechaObj.getDate() + 1);
    fechas.push([fechaObj, datosFechas[i].mensaje , datosFechas[i].id ]);
  }
  return fechas;
}
