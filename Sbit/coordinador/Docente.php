<?php  	session_start();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Documento sin título</title><meta name="viewport" content="width=device-width,inicial-scale=1"><link href="css/bootstrap.min.css" rel="stylesheet" media="screen"><link href="alertas/css/alertify.min.css"  rel="stylesheet"/><link href="alertas/css/themes/default.min.css"  rel="stylesheet"/><script src="alertas/alertify.min.js"></script><script  language="javascript" type="text/javascript">  function mensaje ()  {      alertify.success("Se Activo la Evaluacion");  }        </script></head><body style="background:#663333"> <script src="mostrarFommularios.js"> </script><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><script src="js/bootstrap.min.js"></script><div class="container">	<div class="bg-dark" align="center"  style="height:30px">		<p class="text-light">Coordinacion Academica/Docente</p>	</div>	<div >		<img style="height:300px"  class="w-100" src="Imagenes/edificio.png"  />	</div>	<nav class="navbar  navbar navbar-expand-lg navbar-dark bg-dark">  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"></button>  		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">   			 <div class="navbar-nav">      			<a class="nav-item nav-link " href="Administrador.php">         		 <img src="Imagenes/sbit.jpg" width="30" height="30" >&ensp;&ensp;         		 Inicio <span class="sr-only"></span></a>             			<a class="nav-item nav-link " href="Alumno.php">Alumno</a>      			<a class="nav-item nav-link active" href="#">Docente</a>            <a class="nav-item nav-link " href="../proyectotitulaciones/titu.html">Titulaciones</a>                           <li class="nav-item dropdown">            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">            Cuenta            </a>        <div class="dropdown-menu" aria-labelledby="navbarDropdown">            <a class="dropdown-item  " href="mensajes.php">Mensajes</a>            <a class="dropdown-item " href="configuracion.php">Cambiar Administrador</a>            <a class="dropdown-item"  onclick="<?php $conexion=mysqli_connect('localhost','root','','Sbit')or die("No se pudo completar la conexion");                           mysqli_select_db($conexion,"Sbit");                           $strqry="Update alumnos set validacion1='".true."';";                           $qry = mysqli_query ($conexion,$strqry);                            mysqli_close ($conexion);                     ?> mensaje();" >Evaluacion Docente </a>             <a class="dropdown-item"  href="salir.php">Cerrar Sesion</a>        </div>      </li>      			 </div>   		</div>	</nav>	<div class="container" style="background:#F1C40F; height:auto">    <br />		<div  class="container custom-control" >			<table class="table table-hover   " >              <thead class="thead bg-danger">					<tr>						<th scope="col">#</th>            			<th scope="col">Docente</th>            			<th scope="col">Email</th>            			<th scope="col">Curp</th>                        <th scope="col">Materia</th>                        <th scope="col" colspan="2">Accion</th>					</tr>				</thead><?php			$conexion=mysqli_connect('localhost','root','','Sbit')or die("No se pudo completar la conexion");			mysqli_select_db($conexion,"Sbit");    		$strqry="select * from infoMaestro;";			$qry = mysqli_query ($conexion,$strqry);    		$i=mysqli_num_rows($qry);//Si es 0 tabla vacia						$r = 0;			$c = 0;			$row = 0;			while ($r < $i)			{				mysqli_data_seek ($qry, $r);     			$row = mysqli_fetch_object ($qry);?>				<tr  class="bg-light" style="height:10px">					<td><?php  print $row->idUsuario; ?></td>            	    <td><?php  print $row->nombre." ".$row->apPat." ".$row->apMat; ?> </td>    				<td><?php  print $row->correo; ?></td>    				<td><?php  print $row->curp; ?></td>    				<td><?php  print $row->categoria; ?></td>                    <td >                     	<a href="Docente.php?idUsuario=<?php print $row->idUsuario; ?>" class="btn btn-danger col">Elimina</a>                    </td>                     <td >                     	<a href="actualizarDocente.php?idUsuarioMat=<?php print $row->idUsuario; ?>" class="btn btn-info col">Edita</a>                    </td>                    				</tr><?php		  		$r++;			}			mysqli_close ($conexion);?>						</table>		</div>		<br>        </div>       <div class="bg-dark" align="center"  style="height:30px">		<p class="text-light">Cordinacion Academica</p>	</div></div></body></html><?php	if(!empty($_GET['idUsuario']))	{			$idUsu=$_GET['idUsuario'];			$conexion=mysqli_connect('localhost','root','','Sbit')or die("No se pudo completar la conexion");			mysqli_select_db($conexion,"Sbit");			$strqry ="Delete from Usuarios where idusuario='".$idUsu."';";			print $strqry;			$qry = mysqli_query ($conexion,$strqry);			if(!$qry)			{?>				<script language="javascript" type="text/javascript">			 		alertify.error('Error Intentelo de nuevo');			 		// location.href="Docente.php";	    	    </script><?php							}			else			{?>				<script language="javascript" type="text/javascript">			 		alertify.error('Se elimino correctamente');		 				location.href="Docente.php";	    	 	</script>;<?php			}			 mysqli_close ($conexion);		}?>