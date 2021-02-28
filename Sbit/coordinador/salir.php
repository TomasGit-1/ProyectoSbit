<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cerrar_Sesion</title>
	<link rel="stylesheet" type="text/css" href="Alum_Style.css"/>
	<script type="text/javascript" src="Alum_JavaScript.js"></script>
	<link href="alertas/css/alertify.min.css"  rel="stylesheet"/>
<link href="alertas/css/themes/default.min.css"  rel="stylesheet"/>
<script src="alertas/alertify.min.js"></script>
</head>

<body style="background: #663333"> <!--background:#A00;-->
<?php

		session_unset();
		session_destroy();
?>
		<script language="javascript" type="text/javascript">
            //alertify.alert('Sesion Cerrada');
            location.href="../IniciarSesion.php";
        </script>
<?php
	
?>
</body>
</html>