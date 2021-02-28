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
<br><br>
<?php
	if(!empty($_GET['idUsuarioMat']))	
	{
			$usuario=$_GET['idUsuarioMat'];
			$conexion=mysqli_connect('localhost','root','','Sbit')or die("No se pudo completar la conexion");
			mysqli_select_db($conexion,"Sbit");
    		$strqry="select * from infoMaestro where idUsuario='".$usuario."';";
			$qry = mysqli_query ($conexion,$strqry);
    		$i=mysqli_num_rows($qry);
			$r = 0;
			$c = 0;
			$row = 0;
			while ($r < $i)
			{
				mysqli_data_seek ($qry, $r);
     			$row = mysqli_fetch_object ($qry);
     			$nombre=$row->nombre;
     			$apPat=$row->apPat;
     			$apMat=$row->apMat;
     			$correo=$row->correo;
     			$domicilio=$row->domicilio;
     			$curp=$row->curp;
     			$Estudios=$row->tipo;
     			$Materia=$row->categoria;
     		    $experiencia=$row->expLaboral;
     		    $idPersona=$row->idPersona;

		  		$r++;
			}
			mysqli_close ($conexion);
	}
?>
<div class="container w-50 bg-light">
	<br>
	<div class="container-fluid text-center h2 bg-dark text-light">Datos del Docente</div>
	<br>
	<form action=" " method="POST">
		<div class="form-row">
			<div class="form-group col">
				<label>Nombre</label>          
				<input class="form-control"  type="text"   name="nombre"    value="<?php echo $nombre?>">
			</div>
			<div class="form-group col">
				<label>Apellido Paterno</label>
				<input class="form-control"  type="text"   name="apPat"     value="<?php echo $apPat?>">
			</div>
			<div class="form-group col">
				<label>Apellido Materno</label>
				<input class="form-control"  type="text"   name="apMat" 		value="<?php echo $apMat ?>">
			</div>
		</div>

			<div class="form-row">
			<div class="form-group col">
				<label>Email</label>     
				<input  class="form-control" type="email"  name="correo" 	value="<?php echo $correo?>">
			</div>
			<div class="form-group col">
				<label>Domicilio</label> 
				<input  class="form-control" type="text"   name="domicilio" 	value="<?php echo $domicilio ?>">
			</div>
			<div class="form-group col">
				<label>Curp</label>
	        	<input  class="form-control"t ype="text"   name="curp" 		value="<?php echo $curp?>">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col">
				<label>Estudios</label>
				<input  class="form-control" type="text"   name="tipo" value="<?php echo $Estudios?>">
			</div>
			<div class="form-group col">
				<label>Materia</label>
				<input   class="form-control" type="text"  name="categoria" value="<?php echo $Materia?>">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col">
				<label>Experiencia Laboral</label>
				<textarea  class="form-control"  name="expLaboral" value="<?php echo  $experiencia; ?>"></textarea>
				
			</div>
		</div>
		<br>
		<div class="form-row" >
			<div class="form-group col">
				<button class="form-control btn btn-info " type="submit" name="actualizarMat">Actualizar</button>
			</div>
			<div class="form-group col">
                 <a href="Docente.php" class="btn btn-danger col">Cancelar</a>
			</div>
		</div>
	
	</form>
	<br>
</div>

</body>
</html>

<?php
	session_start();

	if(isset($_POST['actualizarMat']))
	{

		$conexion=mysqli_connect('localhost','root','','Sbit')or die("No se pudo completar la conexion");
		mysqli_select_db($conexion,"Sbit");
		$strqry="Update personas set  nombre='".$_POST['nombre']."',apPat='".$_POST['apPat']."',apMat='".$_POST['apMat']."',correo='".$_POST['correo']."',domicilio='".$_POST['domicilio']."',curp='".$_POST['curp']."' where idUsuario=$usuario;";
		$qry = mysqli_query ($conexion,$strqry);
		print $strqry;
		$strqry="Update usuarios  set  usuario='".$_POST['curp']."',passwordd='".$_POST['curp']."' where idUsuario=$usuario;";
		$qry = mysqli_query ($conexion,$strqry);
		print $strqry;

		$strqry="Update Maestros set expLaboral='".$_POST['expLaboral']."',tipo='".$_POST['tipo']."' ,categoria='".$_POST['categoria']."' where idPersona=$idPersona;";
		$qry = mysqli_query ($conexion,$strqry);	
				print $strqry;
	
		if(!$qry)
		{
?>
			<script language="javascript" type="text/javascript">
			 	alertify.error('Error Intentelo de nuevo');
			 	location.href="Docente.php";
	    	</script>
<?php				
		}
		else
		{
?>
			<script language="javascript" type="text/javascript">
			 	alertify.success('Se Actualizaron los datos');	
	 			location.href="Docente.php";
	    	 </script>;
<?php
		}
			mysqli_close ($conexion);	
	}
?>

