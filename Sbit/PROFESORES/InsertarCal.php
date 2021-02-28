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



    $idC=$_POST['idCic'];
    $idE=$_POST['idTipoE'];
    $Mat=$_POST['matri'];
    $idM=$_POST['idmat'];
    $cal=$_POST['calif'];
    $strqry1 = "SELECT ca.calificacion
    FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
    INNER JOIN Alumnos al ON pe.idPersona = al.idPersona
    INNER JOIN Calificaciones ca ON al.matricula = ca.matricula
    INNER JOIN Examenes ex ON ca.idExamen = ex.idExamen
    INNER JOIN Carrera car ON ex.idCarrera = car.idCarrera
    INNER JOIN CicloEsc ce ON ca.idCiclo = ce.idCiclo
    INNER JOIN Materias ma ON ma.idMateria = ca.idMateria
    INNER JOIN Maestros mtr ON ma.idMaestro = mtr.idMaestro WHERE ma.idMateria=$idM and ce.idCiclo=$idC and al.matricula=$Mat "; //CAMBIAR 
    $qry1 = mysqli_query($link,$strqry1);
    $i = mysqli_num_rows ($qry1);
    //$strqry = "INSERT INTO calificaciones VALUES('$idC','$idE','$Mat','$idM','$cal',(SELECT CURDATE()))";
   // $qry = mysqli_query($link,$strqry);
    if ($i<=0){
      ?>
                <script language="javascript">
            alert('El alumno no esta tomando la materia ');
            location.href="RegistrarCal.php";
        </script>
        <?php
      }
         else {
          $row = mysqli_fetch_row($qry1);
          $a=$row[0];
          if($a==0)
           {
               
                $strqry = "UPDATE calificaciones SET idExamen=$idE, calificacion=$cal ,fecha=(SELECT CURDATE()) where matricula=$Mat and idCiclo=$idC and idMateria=$idM ";
                $qry = mysqli_query($link,$strqry);
                  if (!$qry) print "ERROR AL GUARDAR LOS DATOS  ".$qry." fue fallida... <br>";
                       else {
                            ?>
                            <script language="javascript">
                            alert('Datos Guardados De Manera Correcta ');
                            location.href="RegistrarCal.php";
                            </script>
                            <?php
                          }
             
           }
           else
           {

            ?>
            <script language="javascript">
            alert('El alumno ya tiene asignada la calificacion');
            location.href="RegistrarCal.php";
            </script>
            <?php
           }
        }
    }


}

else
{
    echo"Eror de acceso";

}









?>