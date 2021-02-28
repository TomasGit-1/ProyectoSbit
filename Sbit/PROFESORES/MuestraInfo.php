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
     $idC=$_POST['ciclos'];

     if(empty($idC))
     {
       echo 'falta un valor';
     }
     else
     {

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
       //echo "valor de ".$b1;

//------------------------------------------------------------------------//
        $strqry3="SELECT DISTINCT  mat.nombre
        from maestros ma inner join 
        materias mat on ma.idMaestro=mat.idMaestro
        inner join calificaciones cal on mat.idMateria=cal.idMateria
        inner join cicloesc cic on cal.idCiclo=cic.idCiclo 
        where cic.idCiclo=$idC and ma.idMaestro=' ".$b1." '; ";

        $qry3 = mysqli_query($link,$strqry3); 

       if($row3=mysqli_fetch_array($qry3))
       {

        ?>

<!DOCTYPE html>
<html>
<head>
  <title>SBIT/LISTA ALUMNOS</title>
   <link rel="shortcut icon" href="SBIT.png" type="image/png">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


</head>
<body background="f3.png">
  <h1><p align="center">Materias impartidas</p></h1>

<div class="container">  
<table class="table table-hover table-dark table-bordered table-sm">
  <tr>
      <th scope="col">Nombre</th>

      <?php
         do
         {
         echo "<tr><td>".$row3["nombre"]."</td></tr> \n";
         }while ($row3=mysqli_fetch_array($qry3));
         echo "</table> \n";
         ?>
       <form action="MuestraM.php">
         <input class="btn btn-warning" type="submit"  value="REGRESAR">
       </form>
  </tr>

</table>
</div>
</body>
</html>


         <?php
         }
         else{
          ?>
        <script language="javascript">
            alert('No se encontraron resultados ');
            location.href="MuestraM.php";
        </script>

        <?php  
        }
      }

}
}

       }


?>