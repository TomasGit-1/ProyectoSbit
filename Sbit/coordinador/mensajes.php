<?   session_start();?><!DOCTYPE html><html><head><link href="css/bootstrap.min.css" rel="stylesheet" media="screen"><link href="alertas/css/alertify.min.css"  rel="stylesheet"/><link href="alertas/css/themes/default.min.css"  rel="stylesheet"/><script src="alertas/alertify.min.js"></script>	<title></title></head><body style="background:#663333"><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><script src="js/bootstrap.min.js"></script><br><br><div class="container-fluid w-75 bg-light H-50">	<br>   <div class="container-fluid w-100 text-left h2  text-dark">Email </div>	<br>	<div class="container form-group">	<a class="btn btn-secondary" href="Administrador.php">Inicio</a>    <a class="btn btn-secondary" href="NuevoMensaje.php">Nuevo</a>	</div><br><br><div class="form-row container ">            <a class="btn btn-outline-dark">Enviados</a>&ensp;&ensp;         <table class="table table-hover">               <thead class="thead bg-primary">                  <tr>                     <th>Mensaje</th>                     <th>Matricula</th>                  </tr>               </thead>				  <?php                     $conexion=mysqli_connect('localhost','root','','Sbit')or die("No se pudo completar la conexion");                     mysqli_select_db($conexion,"Sbit");                     $strqry="select * from admin;";                     $qry = mysqli_query ($conexion,$strqry);                     $i=mysqli_num_rows($qry);                     $r = 0;                     $c = 0;                     $row = 0;                     while ($r < $i)                     {                        mysqli_data_seek ($qry, $r);                        $row = mysqli_fetch_object ($qry);                        $idmaestro=$row->idmaestro;                        $r++;                     }                     //Recatamos el mensaje                     $strqry="select * from mensajes where idMaestro=13 and enviado='E1';";                     $qry = mysqli_query ($conexion,$strqry);                     $i=mysqli_num_rows($qry);                     $r = 0;                     $c = 0;                     $row = 0;                     if ($i>0)                     {                        while ($r < $i)                        {                           mysqli_data_seek ($qry, $r);                           $row = mysqli_fetch_object ($qry);               ?>                           <tr >                              <td><?php echo $row->msgTexto;?></td>                              <td><?php echo $row->matricula;?></td>                           </tr>               <?php                           $r++;                        }                     }                     else                      {               ?>                           <script type="text/javascript">                              alertify.error("No hay mensajes enviados");                           </script>               <?php                     }                                       mysqli_close ($conexion); 			               ?>            </table>   </div><br><div class="container form-row">           <a class="btn btn-outline-dark">Recibidos</a>&ensp;&ensp;   			<table class="table table-hover ">               <thead class="thead bg-primary">                  <tr>                     <th>Mensaje11</th>                     <th>Matricula</th>                  </tr>               </thead>              <?php                     $conexion=mysqli_connect('localhost','root','','Sbit')or die("No se pudo completar la conexion");                     mysqli_select_db($conexion,"Sbit");                     $strqry="select * from admin;";                     $qry = mysqli_query ($conexion,$strqry);                     $i=mysqli_num_rows($qry);                     $r = 0;                     $c = 0;                     $row = 0;                     while ($r < $i)                     {                        mysqli_data_seek ($qry, $r);                        $row = mysqli_fetch_object ($qry);                        $idmaestro=$row->idmaestro;                        $r++;                     }                     //Recatamos el mensaje                     $strqry="select * from mensajes where idMaestro=13 and enviado='R1';";                     $qry = mysqli_query ($conexion,$strqry);                     $i=mysqli_num_rows($qry);                     $r = 0;                     $c = 0;                     $row = 0;                     if ($i>0)                     {                        while ($r < $i)                        {                           mysqli_data_seek ($qry, $r);                           $row = mysqli_fetch_object ($qry);               ?>                           <tr class="bg-light">                              <td><?php echo $row->msgTexto;?></td>                              <td><?php echo $row->matricula;?></td>                           </tr>               <?php                           $r++;                        }                     }                     else                      {               ?>                           <script type="text/javascript">                              alertify.error("No hay mensajes Recibidos");                           </script>               <?php                     }                                       mysqli_close ($conexion);                       ?>            </table></div><br></div>    </div></div></body></html>