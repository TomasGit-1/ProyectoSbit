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
<br><br>
<?php

	if(!empty($_GET['usuNuevo']))	
	{
			$usuNuevo=$_GET['usuNuevo'];
			$conexion=mysqli_connect('localhost','root','','Sbit')or die("No se pudo completar la conexion");
			mysqli_select_db($conexion,"Sbit");
    		$strqry="select * from infoMaestro where idUsuario='".$usuNuevo."';";
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
     			$curp=$row->curp;
     			$Estudios=$row->tipo;
		  		$r++;
			}
			$strqry="select * from usuarios where nivel=1";
			$qry = mysqli_query ($conexion,$strqry);
    		$i=mysqli_num_rows($qry);
			$r = 0;
			$c = 0;
			$row = 0;
			while ($r < $i)
			{
				mysqli_data_seek ($qry, $r);
     			$row = mysqli_fetch_object ($qry);
     			$usuViejo=$row->idUsuario;
		  		$r++;
			}

			$strqry="Update Usuarios set nivel=2 where idUsuario=$usuViejo;";
			$qry = mysqli_query ($conexion,$strqry);
						print $strqry;
	
			$strqry="Update Usuarios set nivel=1 where idUsuario=$usuNuevo;";
			$qry = mysqli_query ($conexion,$strqry);	

			print $strqry;
			
			mysqli_close ($conexion);
	}
?>
<div class="container w-50 bg-light">
	<br>
		<div class="container-fluid text-center h2 bg-dark text-light">Nuevo Coordinador</div>
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
				<label>Curp</label>
	        	<input  class="form-control"t ype="text"   name="curp" 		value="<?php echo $curp?>">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col">
                 <a href="salir.php" class="btn btn-danger col">Salir</a>
			</div>
		</div>
	
	</form>
	<br>
</div>

</body>
</html>

