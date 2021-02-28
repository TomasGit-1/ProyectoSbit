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
<html>
<head>
    <title>SBIT/REGISTRAR CALIFICACIONES</title>
    <link rel="shortcut icon" href="SBIT.png" type="image/png">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script type="text/javascript" src="JS.js"></script>
</head>
<body background="f3.png">
     <h1><p align="center">REGISTRAR CALIFICACIONES</p></h1>

<br>
<br>
<br>
<form action="InsertarCal.php" method="POST">
<div  class="container">  
 <div class="form-row">
 <div class="col">  
 <select id="materias"  class="custom-select" onchange="ShowSelected()" name="idmat">
    <?php
    while($da=mysqli_fetch_array($qry2))  //mostrar las materias segun el profesor asignado
    {
    ?>
    <option value="<?php echo $da['idMateria'] ?> ">  <?php echo $da['nombre']?> </option>
  
<?php
     }
     
?>
</select>
</div>


<! -- -------------------------------------------------------------------------------------  -->
<div class="col">
<select id="ciclo" class="custom-select" onchange="ShowSelected1()" name="idCic">
    <?php
    while($ci=mysqli_fetch_array($qry3))  //mostrar ciclos escolares
    {
    ?>
    <option value="<?php echo $ci['idCiclo'] ?> ">  <?php echo $ci['descripcion']?> </option>
  
<?php
     }
     
?>
</select>
</div>


<! -- -------------------------------------------------------------------------------------  -->
<br>
<br>
<br>

<div class="col">
<select id="tipoE"  class="custom-select" onchange="ShowSelected2()" name="idTipoE">
    <?php
    while($ti=mysqli_fetch_array($qry4))  //mostrar tipo de examenes
    {
    ?>
    <option value="<?php echo $ti['idExamen'] ?> ">  <?php echo $ti['tipoExamen']?> </option>
  
<?php
     }
     
?>
</select>
</div>

   
<br>
<br>
<br>
</div>




 <div class="form-row">
<div class="col">
<label class="lead"><font face="Georgia" size="5" >Matricula:</font></label> 
</div>
<div class="col"><input type="text" class="form-control" name="matri" onkeypress='return validaNumericos(event)' /></p> <!--validacion solo numeros y positivos--></div>
<br>
<br>
<br>
<div class="col mb-5">
<LABEL class="lead"><font face="Georgia" size="5" >Calificacion:</font> </LABEL>
</div>
<DIV class="col-0 ">
<select name="calif" class="custom-select">
  <option value="-3">N/P</option>
  <option value="-2">S/D</option>
  <option value="-1">N/C</option>
  <option value="1">1</option> 
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option> 
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option> 
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option> 

</select>
</DIV>
<br>
<br>
<br>


</div>
</div>
</div>
<div align="center">
<input type="submit" class="btn btn-warning"  value="Guardar">
</div>
</form>



       <form action="Maestro.php">
         <input class="btn btn-warning" type="submit"  value="REGRESAR">
       </form>
</body>
</html>
<?php
}

}

}
else
{
    echo"<a href='http://localhost/andy/ta/pagLogin.htm'>Volver al login</a>";

}


?>