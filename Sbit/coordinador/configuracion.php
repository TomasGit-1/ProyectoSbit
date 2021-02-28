<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="alertas/css/alertify.min.css"  rel="stylesheet"/>
<link href="alertas/css/themes/default.min.css"  rel="stylesheet"/>
<script src="alertas/alertify.min.js"></script>
<title></title>
</head>
<body style="background:#663333">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<div class="container"> 
  <div class="bg-dark" align="center"  style="height:30px">
    <p class="text-light">Coordinacion Academica/Cambiar Administrador</p>
  </div>
  <div >
    <img style="height:300px"  class="w-100" src="Imagenes/edificio.png"  />
  </div>
  <nav class="navbar  navbar navbar-expand-lg navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"></button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
         <div class="navbar-nav">
            <a class="nav-item nav-link " href="Administrador.php">
             <img src="Imagenes/sbit.jpg" width="30" height="30" >&ensp;&ensp;
             Inicio <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link " href="Alumno.php">Alumno</a>
            <a class="nav-item nav-link " href="Docente.php">Docente</a>
            <a class="nav-item nav-link " href="../proyectotitulaciones/titu.html">Titulaciones</a>            
            <a class="nav-item nav-link active" href="">Cambiar Administrador</a>
         </div>
      </div>
  </nav>
	 <div style="background:#F1C40F;height:auto "> 
    <br>
<div  class="container custom-control" >
      <table class="table table-hover   " >
              <thead class="thead bg-danger">
          <tr>
                  <th scope="col">#</th>
                  <th scope="col">Docente</th>
                  <th scope="col">Curp</th>

          </tr>
        </thead>
<?php
      $conexion=mysqli_connect('localhost','root','','Sbit')or die("No se pudo completar la conexion");
      mysqli_select_db($conexion,"Sbit");
      $strqry="select * from infoMaestro;";
      $qry = mysqli_query ($conexion,$strqry);
      $i=mysqli_num_rows($qry);//Si es 0 tabla vacia
      
      $r = 0;
      $c = 0;
      $row = 0;
      while ($r < $i)
      {
        mysqli_data_seek ($qry, $r);
          $row = mysqli_fetch_object ($qry);
?>
        <tr  class="bg-light" style="height:10px">
            <td><?php  print $row->idUsuario; ?></td>
            <td><?php  print $row->nombre." ".$row->apPat." ".$row->apMat; ?> </td>
             <td> 
                <a href="eleAdministrador.php?usuNuevo=<?php print $row->idUsuario; ?>" class="btn btn-info col">Administrador</a>
            </td>         
        </tr>
<?php

          $r++;
      }
      mysqli_close ($conexion);
?>      
      </table>
    </div>   
<br>
    </div>
 	<div class="bg-dark" align="center"  style="height:30px">
   	 	<p class="text-light">Cordinacion Academica</p>
 	</div>
</div>

</body>
</html>