<?php
	session_start();
	if(isset($_POST))
	{
		$usuario=$_GET['idUsuarioAlu'];

		$conexion=mysqli_connect('localhost','root','','Sbit')or die("No se pudo completar la conexion");
		mysqli_select_db($conexion,"Sbit");
		$strqry="Update personas set  nombre='".$_POST['nombre']."',apPat='".$_POST['apPat']."',apMat='".$_POST['apMat']."',correo='".$_POST['correo']."',domicilio='".$_POST['domicilio']."',curp='".$_POST['curp']."' where idUsuario=$usuario;";
		$qry = mysqli_query ($conexion,$strqry);
		$strqry="Update usuarios  set  usuario='".$_POST['curp']."',passwordd='".$_POST['curp']."' where idUsuario=$usuario;";
		$qry = mysqli_query ($conexion,$strqry);
		$strqry="Update Alumnos set EscProcedencia='".$_POST['escProcedencia']."',Statuss='".$_POST['Statuss']."'   where matricula=$matricula;";
		$qry = mysqli_query ($conexion,$strqry);		
		if(!$qry)
		{
?>
			<script language="javascript" type="text/javascript">
			 	alertify.error('Error Intentelo de nuevo');
			 	location.href="Alumno.php";
	    	</script>
<?php				
		}
		else
		{
?>
			<script language="javascript" type="text/javascript">
			 	alertify.success('Se Actualizaron los datos');	
	 			location.href="Alumno.php";
	    	 </script>;
<?php
		}
			mysqli_close ($conexion);	
	}
?>
	