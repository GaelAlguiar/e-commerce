/*MATRICULA: 2003135     NOMBRE: Jorge Gael Alguiar Esquivel     HORA: N4     GPO: 011*/

function calcularPotencia() {

    let base = parseInt(prompt("Ingresa la base:"));
    let exponente = parseInt(prompt("Ingresa el exponente:"));

    let resultado = Math.pow(base, exponente);

    alert(`El resultado de ${base} elevado a la ${exponente} es: ${resultado}`);
}

function calcularRaiz() {
    
    let num = parseInt(prompt("Ingresa un número:"));

    if (num >= 0) {
    
        let resultado = Math.sqrt(num);

        alert(`La raíz cuadrada de ${num} es: ${resultado}`);
    } else {

        alert("El número debe ser real para poder calcular la raíz cuadrada de este.");
    }
}

document.getElementById("potencia-btn").addEventListener("click", calcularPotencia);
document.getElementById("raizcuadrada-btn").addEventListener("click", calcularRaiz);
