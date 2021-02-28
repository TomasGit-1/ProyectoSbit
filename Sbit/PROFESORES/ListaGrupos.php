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
    <title>SBIT/LISTA ALUMNOS</title>
     <link rel="shortcut icon" href="SBIT.png" type="image/png">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script type="text/javascript" src="JS.js"></script>
</head>
<body background="f3.png">
<h1><p align="center">LISTA DE GRUPOS </p></h1>
<BR>
<BR>
<BR>

<form action="Lista.php" method="POST" >    
<div  class="container">
    <div class="form-row">
       <div class="col-md-0 mb-5">


 <select id="materias" class="custom-select" onchange="ShowSelected()" name="materias">
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

<DIV class="col-md-0 mb-5">
   <select id="ciclo"  class="custom-select"  onchange="ShowSelected1()" name="ciclos">
    <?php
    while($ci=mysqli_fetch_array($qry3))  //mostrar ciclos escolares
    {
    ?>
    <option value="<?php echo $ci['idCiclo'] ?> ">  <?php echo $ci['descripcion']?> </option>
  
<?php
     }
     
?>

</select>
</DIV>

<div class="col-md-0 mb-5">
    <input class="btn btn-warning" type="submit"  value="Buscar">
</div>
</div>

</form>
</div>
       <form action="ConsultaA.php">
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