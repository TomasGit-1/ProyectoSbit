<?php   session_start();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><link href="css/bootstrap.min.css" rel="stylesheet" media="screen"><link href="alertas/css/alertify.min.css"  rel="stylesheet"/><link href="alertas/css/themes/default.min.css"  rel="stylesheet"/><script src="alertas/alertify.min.js"></script><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Documento sin título</title></head><body style="background:#663333"><br /><br /><br />	<div class="container-fluid w-75 bg-light H-50">    <br />    <div class="container-fluid w-100 text-left h2  text-dark">Email </div>	<br>	<div class="container form-group">	<a class="btn btn-secondary" href="Administrador.php">Inicio</a>    <a class="btn btn-secondary" href="mensajes.php">Todos</a>	</div>    	<form action="" method="post">        	  <div class="form-group col">              <label>Mensaje Nuevo </label>                <select  class="custom-select" name="opcionCorreo" required>               <option value=" ">Correo</option>                     <?php              $conexion=mysqli_connect('localhost','root','','Sbit')or die("No se pudo completar la conexion");              mysqli_select_db($conexion,"Sbit");                $strqry="select * from infoAlumno;";              $qry = mysqli_query ($conexion,$strqry);                $i=mysqli_num_rows($qry);                $r = 0;                $c = 0;                $row = 0;                while ($r < $i)                {                    mysqli_data_seek ($qry, $r);                    $row = mysqli_fetch_object ($qry);            ?>                <option ><?php print $row->correo;?></option>                <?php                $r++;                }              mysqli_close ($conexion);            ?>           </select>            <textarea class="form-control"  name="msgTexto" rows="5" cols="60" maxlength="500"></textarea><br />          <input class="form-control"  name="msgArchivo" type="file"><br />          		<input  class="btn btn-dark" name="submit" type="submit" value="Enviar mensaje">         </div>             </form>        <br />    </div></body></html><?php	 if($_POST)	 {		   $msgText=$_POST['msgTexto'];		   $msgArchivo=$_POST['msgArchivo'];		    $correo=$_POST['opcionCorreo'];		 	$conexion=mysqli_connect('localhost','root','','Sbit')or die("No se pudo completar la conexion");			mysqli_select_db($conexion,"Sbit");    		$strqry="select * from infoAlumno where correo='$correo';";					print $strqry;			$qry = mysqli_query ($conexion,$strqry);    		$i=mysqli_num_rows($qry);			$r = 0;			$c = 0;			$row = 0;			while ($r < $i)			{				mysqli_data_seek ($qry, $r);     			$row = mysqli_fetch_object ($qry);     			$matricula=$row->matricula;		  		$r++;			}						$strqry="Insert into mensajes (idMaestro,matricula,tipo,enviado,msgTexto,msgArchivo,fecha) values('13',$matricula,'2','E1','$msgText','$msgArchivo','0000-00-00');";			print $strqry;			$qry = mysqli_query ($conexion,$strqry);			 if(!$qry)			 {?>                      <script  language="javascript" type="text/javascript">                            alertify.error("La operacion Registro Fallo ");                            alertify.error("Intentelo de Nuevo");                      </script><?php            }              else              {                                     ?>                        <script language="javascript" type="text/javascript">                          alertify.success("La operacion fue un exito");						//  location.href="mensajes.php";                        </script><?php                              }	 }?>