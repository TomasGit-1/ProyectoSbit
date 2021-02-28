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
   $idM=$_POST['matr'];
   if(empty($idM)){
    ?>
          <script language="javascript">
            alert('Falta un valor ');
            location.href="BuscarA.php";
        </script>
    <?php
   }
   else{

     $strqry="SELECT idUsuario FROM usuarios WHERE passwordd='".$_SESSION['password']."' and  usuario='".$_SESSION['usuario']."' ;";
     $qry = mysqli_query($link,$strqry);
    
     if (!$qry) print "La consulta ".$qry." fue fallida... <br>";
     else {
        $row5 = mysqli_fetch_row($qry);
        $a1=$row5[0];
        //echo "valor de ".$a1;
//------------------------------------------------------------------//
        $strqry1="SELECT ma.idMaestro FROM maestros ma inner join 
        personas pe on  ma.idPersona=pe.idPersona inner join
        usuarios us on pe.idUsuario=us.idUsuario where us.idUsuario=' ".$a1." '; ";
        $qry1 = mysqli_query($link,$strqry1); 
        $row1 = mysqli_fetch_row($qry1);
        $b1=$row1[0];
      // echo "valor de  b1".$b1;
      // echo "valor de  ide materias".$idM;

//------------------------------------------------------------------------//
            $strqry3="SELECT DISTINCT pe.nombre nombreA,pe.apPat,pe.apMat,ma.nombre,ca.calificacion,al.matricula,ce.descripcion 
        FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
        INNER JOIN Alumnos al ON pe.idPersona = al.idPersona
        INNER JOIN Calificaciones ca ON al.matricula = ca.matricula
        INNER JOIN Examenes ex ON ca.idExamen = ex.idExamen
        INNER JOIN Carrera car ON ex.idCarrera = car.idCarrera
        INNER JOIN CicloEsc ce ON ca.idCiclo = ce.idCiclo
        INNER JOIN Materias ma ON ma.idMateria = ca.idMateria
        INNER JOIN Maestros mtr ON ma.idMaestro = mtr.idMaestro WHERE al.matricula=$idM and  mtr.idMaestro=' ".$b1." '; ";

        $qry3 = mysqli_query($link,$strqry3); 
       if($row3=mysqli_fetch_array($qry3))
       {

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="SBIT.png" type="image/png">
  <title>Lista de alumnos</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body background="f3.png">
      <h1><p align="center"> Alumno : <?php echo "<tr><td>".$row3["nombreA"]."</td> <td>".$row3["apPat"]."</td></tr>"?></p></h1>
  <br>
  <br>
  <br>
  <div  class="container-fluid"> 
<table class="table table-hover table-dark table-bordered table-sm" >
  <tr>
      <th>Matricula</th>
      <th>Nombre</th>
      <th>Apellido Paterno</th>
      <th>Apellido Materno</th>
      <th>Materia</th>
      <th>Calificacion</th>
      <th>Ciclo</th>
      <?php

          do
         {
         echo "<tr><td>".$row3["matricula"]."</td>  <td>".$row3["nombreA"]."</td> <td>".$row3["apPat"]."</td>  <td>".$row3["apMat"]."</td> <td>".$row3["nombre"]."</td> <td>".$row3["calificacion"]."</td>  <td>".$row3["descripcion"]."</td></tr> \n";
         }while ($row3=mysqli_fetch_array($qry3));
         echo "</table> \n";
         ?>
  </tr>

</table>
</div>
<br>
<br>
<br>
<br>
       <form action="BuscarA.php">
         <input class="btn btn-warning" type="submit"  value="REGRESAR">
       </form>

</body>
</html>
         


<?php


         }
         else{
          ?>
                    <script language="javascript">
            alert('No se encontraron resultados ');
            location.href="BuscarA.php";
        </script>
       <?php
        }

}
}
}

      }
       else
       {
        echo 'no tenemos nada';
       }


?>
