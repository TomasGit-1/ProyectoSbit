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


?>
<!DOCTYPE html>
<html>
<head>
    <title>SBIT/CONSULTAS</title>
    <script type="text/javascript" src="JS.js"></script>
    <link rel="shortcut icon" href="SBIT.png" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body background="fon1.png">
    <div>

<nav>
<div class="bg-dark" align="center"  style="height:30px">
        <p class="text-light">SBIT/CATEDRATICO/CONSULTAS</p>
    </div>
    <div >
        <img style="height:300px"  class="w-100" src="SBIT.jpeg"  />
    </div>
    <nav class="navbar  navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
             <div class="navbar-nav">
                <a class="nav-item nav-link " href="Maestro.php">                
                <img src="SBIT.png" width="30" height="30" >&ensp;&ensp;
                Inicio <span class="sr-only"></span></a>
 
                <a class="nav-item nav-link" href="MuestraM.php">Consultar Materias</a>
                <a class="nav-item nav-link" href="ConsultaA.php">Consultar Alumnos</a>
                <a class="nav-item nav-link " href="RegistrarCal.php">Registrar Calificaciones</a>
                <a class="nav-item nav-link " href="Tutorias.php">Tutorias</a>
                <a class="nav-item nav-link " href="MensajesA.php">Mensajes</a>
             </div>
        </div>
    </nav>



</div> 

     <h1><p align="center">Materias impartidas en cada semestre</p></h1>

<DIV ALIGN="center"><img src="MAESTROS4.png"></DIV>

    <form action="MuestraInfo.php" method="POST">
    <div  class="container">
    <div class="form-row">
       <div class="col-md-0 mb-5">
        <label class="lead"> <font face="Georgia" size="5" >CICLO ESCOLAR:</font></label> 
        </div>
       <div class="col-sm-2">  
      <select id="ciclo" class="custom-select" onchange="ShowSelected1()" name="ciclos">
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
<div class="col-sm-2">

<input class="btn btn-warning" type="submit"  value="Buscar">
</div>
</div>
</div>
 
</form>



























</body>
</html>
<?php
}

}

}
else
{
    echo"<a href=IniciarSesion.php>PRESIONE AQUI</a>";

}


?>
