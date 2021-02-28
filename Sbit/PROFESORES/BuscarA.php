<?php
session_start();

if(isset($_SESSION['password']))
{
// Intentando la conexión con MySQL ...
$link = mysqli_connect ('localhost','root','','SBIT') or die ("No se logro la conexión");

// Selecciona la base de datos
$db = mysqli_select_db ($link,"SBIT");

if (!$db) print "El intento por accesar la base de datos fue fallido<br>";
else {

     $strqry="SELECT idUsuario FROM usuarios WHERE passwordd='".$_SESSION['password']."' and  usuario='".$_SESSION['usuario']."' ;";
     $qry = mysqli_query($link,$strqry);
    
     if (!$qry) print "La consulta ".$qry." fue fallida... <br>";
     else {
        $row = mysqli_fetch_row($qry);
        $a=$row[0];
//------------------------------------------------------------------//
        $strqry1="SELECT ma.idMaestro FROM maestros ma inner join 
        personas pe on  ma.idPersona=pe.idPersona inner join
        usuarios us on pe.idUsuario=us.idUsuario where us.idUsuario=' ".$a." '; ";
        $qry1 = mysqli_query($link,$strqry1); 
        $row1 = mysqli_fetch_row($qry1);
        $b=$row1[0];
//------------------------------------------------------------------//
        $strqry2="SELECT nombre,idMateria FROM materias where idMaestro=' ".$b." ';" ;
        $qry2 = mysqli_query($link,$strqry2);

//------------------------------------------------------------------------//
        $strqry3="SELECT idCiclo,descripcion FROM cicloesc;";
        $qry3 = mysqli_query($link,$strqry3);

//------------------------------------------------------------------------//
        $strqry4="SELECT idExamen,tipoExamen from examenes;";
        $qry4 = mysqli_query($link,$strqry4);



?>
<HTML>
<HEAD>
    <title>SBIT/MENU</title>
     <!--<link rel="stylesheet" type="text/css" href="estil.css"/>-->
     <link rel="shortcut icon" href="SBIT.png" type="image/png">
     <script type="text/javascript" src="JavaSl.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</HEAD>
<BODY background="f3.png">
    <br>
    <br>
    <br>
     <h1><p align="center">Consultar Alumno</p></h1>
<form action="busquedaA.php" method="POST" align="center"> 
    <div  class="container">
    <div class="form-row">
       <div class="col-md-0 mb-3">
        <LABEL class="lead"><font face="Georgia" size="5" >Matricula:</font></LABEL> 
        </div>
       <div class="col-sm-2">  
        <input class="form-control"  id="valor1" type="text" value="" name="matr" onkeypress='return validaNumericos(event)' ></p>
</div>
<div class="col-sm-2">

<input class="btn btn-warning" type="submit"  value="Buscar">
</div>
</div>
</div>

</form>
       <form action="ConsultaA.php">
         <input class="btn btn-warning" type="submit"  value="REGRESAR">
       </form>


</BODY>

</HTML>








<?php
}

}

}


else
{
    echo"<a href='ConsultaA.php'>Volver al login</a>";

}


?>