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
			
			$conexion=mysqli_connect('localhost','root','','SBIT')or die("No es Posible Conectar Con la Base De Datos");
			mysqli_select_db($conexion,"SBIT");
			$strqry="select * from usuario where password='".$_SESSION['password']."' and  usuario='".$_SESSION['usuario']."' ;";
  			$qry=mysqli_query($conexion,$strqry);
  			$i=mysqli_num_rows($qry);
			if ($i > 0) 
	  		{
				//listar informacion
				$link = mysqli_connect ('localhost','root','','SBIT') or die ("No se logro la conexión ...");
				$db = mysqli_select_db ($link,"SBIT");
				$strqry = "SELECT Nivel,usuario FROM usuario  ORDER BY usuario;";
				$qry = mysqli_query ($link,$strqry);
				$i = mysqli_num_rows ($qry);
				$r = 0;
				$c = 0;
				$row = 0;
				while ($r < $i)
				{
    			 	mysqli_data_seek ($qry, $r);
     	 		    $row = mysqli_fetch_object ($qry);
		 			$nivel=$row->Nivel;
		 		    $usuario=$row->usuario;
         			// Elegir Nivel de Usuario 1 .... alumno   2 Docente

		  			if ($nivel==1 and $_SESSION['usuario']==$usuario)
		  			{
?>
						<script language="javascript">
						alert('Bienvenido Administrador  <?php print $_SESSION['usuario'] ?>') 
					
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
           location.href="Login.php";
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
<title>Login</title>

<link href="cssLogin/EstilosLogin.css" rel="stylesheet" type="text/css" />

</head>
<body>	

		<br />
		<div>
       	 <img id="imagen" src="Imagenes/usuario.jpeg"/>  
        </div>
<br /><br />
<div id="contPrincipal">
<form  action=" " method="post">            
    <div>
   	  <div id="usuario">
            <img src="Imagenes/UsuarioArriba.jpg"/>
      </div>
                
        <div id="usuariotex">
           	<input type="text" name="usuario" value="Usuario"><br>
        </div>       
        <div id="contra">
            <img  src="Imagenes/Images.png" />
		</div>
      <div id="contratex">
           <input type="password" name="password" value="Contraseña"><br>
	  </div>
    </div>
    
    <input id="Boton"  type="submit" value="Entrar" />

</form>


</div>
</body>

</html>
     