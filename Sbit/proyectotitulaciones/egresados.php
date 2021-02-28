<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <link rel="shortcut icon" href="egresados.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../proyectotitulaciones/estil.css" />
    <title>Egresados</title>
</head>
<body id="body">
  <header id="header">
    		<h1>Egresados del SBIT</h1> 
	</header>
    <HR noshade size="6"/>
<?php

// Intentando la conexión con MySQL ...
$link = mysqli_connect ('localhost','root','','sbit') or die ("No se logro la conexión");

// Selecciona la base de datos
$db = mysqli_select_db ($link,"sbit");

if (!$db) print "El intento por accesar la base de datos fue fallido<br>";
else {
$consulta = "
SELECT p.nombre,p.apPat,p.apMat,e.matricula,e.actExtra,e.servSocial FROM personas p
INNER JOIN alumnos a
ON (p.idPersona = a.idpersona)
INNER JOIN egresados e  ON
(a.matricula = e.matricula);";
$resultado = mysqli_query( $link, $consulta) or die ("algo salio mal compa ");

echo "<table border='7', bordercolor='#CCFF33' , align='center', cellpadding='20px' , width='200' >";
	echo "<thead >";
	echo "<tr>";
		echo "<th >Nombre</th>";
		echo "<th >ApPat</th>";
		echo "<th >ApMat</th>";
		echo "<th > Matricula </th>";
		echo "<th > horas extracurriculares </th>";
		echo"<th >servicio social</th>";
	echo "</tr>";
 echo "</thead>";
while ($columna = mysqli_fetch_array($resultado)){
	echo "<tr>";
	echo "<td>" . $columna['nombre'] . "</td><td>" . $columna['apPat'] . "</td><td>" .  $columna['apMat'] . "</td><td>" .$columna['matricula'] . "</td><td>" .$columna['actExtra'] ."</td><td>" .$columna['servSocial'] . "</td>";
	echo "<tr>";
	}
echo "</table>";

}

 mysqli_close($link);

?>
</body>
</html>
