const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

console.log("hola");

document.addEventListener("DOMContentLoaded", function () {

    const bottiz = document.getElementById("head").children[0];
    const bottder = document.getElementById("head").children[2];

    const odate = new Date();
    const copifecha = new Date(odate);

    llenarCal(copifecha, odate);
    bottiz.addEventListener("click", function () {
        copifecha.setMonth(copifecha.getMonth() - 1);
        llenarCal(copifecha, odate);
    });
    bottder.addEventListener("click", function () {
        copifecha.setMonth(copifecha.getMonth() + 1);
        llenarCal(copifecha, odate);
    });


});

function llenarCal(fechamesdestino = new Date(), fechaactual) {
    const copidestino = new Date(fechamesdestino.getFullYear(), fechamesdestino.getMonth(), 1, fechamesdestino.getHours(), fechamesdestino.getMinutes(), fechamesdestino.getSeconds());
    const yearmonth = document.getElementById("head").children[1];
    yearmonth.children[0].textContent = meses[copidestino.getMonth()];
    yearmonth.children[1].textContent = copidestino.getFullYear();


    for (let i = copidestino.getDay(); i > 0; i--) {
        copidestino.setDate((copidestino.getDate() - 1));
    }

    for (let i = 1; i < 7; i++) {
        arrdia = document.getElementById("semana-"+i).children;
        for (const element of arrdia) {
            element.children[0].textContent = copidestino.getDate();
            if (copidestino.getMonth() != fechamesdestino.getMonth()) {
                element.children[1].className = "";
                element.children[1].textContent = "";
                element.className = "no-mes";
            } else {
                if (copidestino.getMonth() == fechaactual.getMonth() &&
                    copidestino.getDate() == fechaactual.getDate() &&
                    copidestino.getFullYear() == fechaactual.getFullYear()) {
                    element.className = "hoy";
                } else {
                    element.className = "";
                    element.children[1].textContent = "";
                }
            }

            for (let evento of fechas) {
                if (copidestino.getMonth() == evento[0].getMonth() &&
                    copidestino.getDate() == evento[0].getDate() &&
                    copidestino.getFullYear() == evento[0].getFullYear()) {
                    const aEvento = document.createElement("a");
                    aEvento.textContent = evento[1];
                    aEvento.href = "anuncios.php#" + evento[2];
                    element.children[1].className = "evento";
                    const ele = element.children[1];
                    ele.appendChild(aEvento);
                    evento = null;
                }

            }

            copidestino.setDate(copidestino.getDate() + 1);
        }

    }


}