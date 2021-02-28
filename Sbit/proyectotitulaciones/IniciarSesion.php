<!--Niveles
	1.....Administrador
    2.....Maestro
    3.....Alumno
-->
<?php  
	session_start();
	if($_POST)
	{
			$_SESSION['usuario']=$_POST['usuario'];
			$_SESSION['password']=$_POST['password'];
			
			$conexion=mysqli_connect('localhost','root','','sbit')or die("No es Posible Conectar Con la Base De Datos");
			mysqli_select_db($conexion,"sbit");
			$strqry="select * from usuarios where passwordd='".$_SESSION['password']."' and  usuario='".$_SESSION['usuario']."' ;";
  			$qry=mysqli_query($conexion,$strqry);
  			$i=mysqli_num_rows($qry);
			if ($i > 0) 
	  		{
				//listar informacion
				$link = mysqli_connect ('localhost','root','','sbit') or die ("No se logro la conexión ...");
				$db = mysqli_select_db ($link,"sbit");
				$strqry = "SELECT nivel,usuario FROM usuarios  ORDER BY usuario;";
				$qry = mysqli_query ($link,$strqry);
				$i = mysqli_num_rows ($qry);
				$r = 0;
				$c = 0;
				$row = 0;
				while ($r < $i)
				{
    			 	mysqli_data_seek ($qry, $r);
     	 		    $row = mysqli_fetch_object ($qry);
		 			$nivel=$row->nivel;
		 		    $usuario=$row->usuario;
         			// Elegir Nivel de Usuario 1 .... alumno   2 Docente

		  			if ($nivel==1 and $_SESSION['usuario']==$usuario)
		  			{
?>
						<script language="javascript">
						alert('Bienvenido Administrador  <?php print $_SESSION['usuario'] ?>') 
						location.href="Administrador.php";
						</script>
<?php
		  		    }
		  		    else if ($nivel==2 and $_SESSION['usuario']==$usuario)
			  		{
?>
			  		    <script language="javascript">
							alert('Bienvenido Maestr@  <?php print $_SESSION['usuario'] ?>') 
						</script>
<?php		
		            }
		  		    else if ($nivel==3 and $_SESSION['usuario']==$usuario)
					{
?>
						 <script language="javascript">
							alert('Bienvenido Alumn@  <?php print $_SESSION['usuario'] ?>') 
							 location.href="titu.html";
						</script>
<?php
					}
	  	  			    $r++;
	  	  			    print "<br>";
			    }
	  }
	  else 
	  {
?>
         <script language="javascript">
		   alert('Usuario o Contraseña Incorrecto');
           location.href="IniciarSesion.php";
         </script>
<?php 
		 	mysqli_close($conexion);
			session_unset();
			session_destroy();
		}
	  }
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body  style=" background:#900">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>


<div  class="container text-center shadow-lg p-3 mb-5  rounded rounded border border-dark w-25" style=" position:relative;top:150px; background:#F1C40F;" >
<form action=" " method="post" >
	<div>
		<img  src="Imagenes/UsuarioArriba.jpg" class="rounded-circle w-25 border border-dark "  />
	</div>
    <br />
    
  <div class="form-group ">
 
    <input   type="text"  class="form-control" aria-describedby="usuarioHelp" placeholder="Usuario" name="usuario">
    <small id="usuarioHelp" class="form-text text-muted  text-left"  >Ingrese su Usuario</small>

  </div>

  
  <div class="form-group">
    <input type="password" class="form-control" placeholder="Contraseña" name="password">
    <small id="usuarioHelp"  class="form-text text-muted text-left" >Ingrese su Contraseña</small>

  </div>  
  <button type="submit" class="btn  btn-block btn-secondary">Entrar</button>
</form>
<br />
</div>
</body>
</html>