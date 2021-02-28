/*var elem=document.getElementById("color");
document.write('Esto es una prueba '+elem.innerHTML);
document.getElementById("color").style.backgroundColor = "blue";*/
function mouseMove1() {
	document.getElementById("Reinscripcion").style.backgroundColor = "#F60";
	document.getElementById("Reinscripcion").style.color = "#930";
}
function mouseMove2() {
    document.getElementById("Materias").style.backgroundColor = "#930";
	document.getElementById("Materias").style.color = "#F60";
}
function mouseMove3() {
	document.getElementById("Tramites").style.backgroundColor = "#F60";
	document.getElementById("Tramites").style.color = "#930";
}
function mouseMove4() {
    document.getElementById("Tutorias").style.backgroundColor = "#930";
	document.getElementById("Tutorias").style.color = "#F60";
}
function mouseMove5() {
	document.getElementById("Mensajes").style.backgroundColor = "#F60";
	document.getElementById("Mensajes").style.color = "#930";
}
function mouseMove6() {
    document.getElementById("Calificaciones").style.backgroundColor = "#930";
	document.getElementById("Calificaciones").style.color = "#F60";
}
function mouseMove7() {
	document.getElementById("Kardex").style.backgroundColor = "#F60";
	document.getElementById("Kardex").style.color = "#930";
}
function mouseMove8() {
    document.getElementById("Evaluacion").style.backgroundColor = "#930";
	document.getElementById("Evaluacion").style.color = "#F60";
}
function mouseUp1() {
	document.getElementById("Reinscripcion").style.backgroundColor = "red";
	location.href = "Alum_Reinscripcion.php";
}
function mouseUp2() {
	document.getElementById("Materias").style.backgroundColor = "red";
	location.href = "Alum_Materias.php";
}
function mouseUp3() {
	document.getElementById("Tramites").style.backgroundColor = "red";
	location.href = "Alum_Tramites.php";
}
function mouseUp4() {
	document.getElementById("Tutorias").style.backgroundColor = "red";
	location.href = "Alum_Tutorias.php";
}
function mouseUp5() {
	document.getElementById("Mensajes").style.backgroundColor = "red";
	location.href = "Alum_Mensajes.php";
}
function mouseUp6() {
	document.getElementById("Calificaciones").style.backgroundColor = "red";
	location.href = "Alum_Calificaciones.php";
}
function mouseUp7() {
	document.getElementById("Kardex").style.backgroundColor = "red";
	location.href = "Alum_Kardex.php";
}
function mouseUp8() {
	document.getElementById("Evaluacion").style.backgroundColor = "red";
	location.href = "Alum_Evaluacion.php";
}
function mouseOut() {
	document.getElementById("Reinscripcion").style.backgroundColor = "#F90";
	document.getElementById("Reinscripcion").style.color = "#900";
	document.getElementById("Materias").style.backgroundColor = "#900";
	document.getElementById("Materias").style.color = "#F90";
	document.getElementById("Tramites").style.backgroundColor = "#F90";
	document.getElementById("Tramites").style.color = "#900";
	document.getElementById("Tutorias").style.backgroundColor = "#900";
	document.getElementById("Tutorias").style.color = "#F90";
	document.getElementById("Mensajes").style.backgroundColor = "#F90";
	document.getElementById("Mensajes").style.color = "#900";
	document.getElementById("Calificaciones").style.backgroundColor = "#900";
	document.getElementById("Calificaciones").style.color = "#F90";
	document.getElementById("Kardex").style.backgroundColor = "#F90";
	document.getElementById("Kardex").style.color = "#900";
	document.getElementById("Evaluacion").style.backgroundColor = "#900";
	document.getElementById("Evaluacion").style.color = "#F90";
}