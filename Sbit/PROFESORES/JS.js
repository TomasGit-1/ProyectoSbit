function ShowSelected()
{
/* Para obtener el valor */
var cod = document.getElementById("materias").value;
document.getElementById("valor").innerHTML = "Id Materia";
document.getElementById("valor").value=cod;
return cod; /* MODIFIQUE AQUI*/
 
/* Para obtener el texto 
var combo = document.getElementById("materias");
var selected = combo.options[combo.selectedIndex].text;
alert(selected);
*/
}


function ShowSelected1()
{
/* Para obtener el valor */
var cod1 = document.getElementById("ciclo").value;
document.getElementById("valor1").innerHTML = "Id ciclo";
document.getElementById("valor1").value=cod1;
 
/* Para obtener el texto 
var combo = document.getElementById("materias");
var selected = combo.options[combo.selectedIndex].text;
alert(selected);
*/
}


function ShowSelected2()
{
/* Para obtener el valor */
var cod2 = document.getElementById("tipoE").value;
document.getElementById("valor2").innerHTML = "Id TipoExm";
document.getElementById("valor2").value=cod2;
 
/* Para obtener el texto 
var combo = document.getElementById("materias");
var selected = combo.options[combo.selectedIndex].text;
alert(selected);
*/
}


function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}


function validaNumericosFecha(event) {
    if(event.charCode >= 45 && event.charCode <= 57 ){
      return true;
     }
     return false;        
}