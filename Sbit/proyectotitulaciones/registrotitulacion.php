<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="egresados.png">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../proyectotitulaciones/estil.css" />
<title>Registro de Titulacion</title>
</head>

<body id="body">
  <header id="header">
    		<h1>Registro de titulacion</h1> 
	</header>
    <HR noshade size="6"/>
<form method="POST" action="registrotitu.php">
<fieldset >
  <legend>Registro Titulacion</legend>
  <p class="p">Nombre: <input type="text" name="nombre" size="30"></p>
  <p class="p">Apellido paterno: <input type="text" name="paterno" size="30"></p>
  <p class="p">Apellido materno: <input type="text" name="materno" size="30"></p>
  <p class="p">Curp: <input type="text" name="curp" size="30"></p>
  <p class="p">Edad: <input type="number" name="edad"></p>
  <p class="p">Sexo:
  <p class="p">
  <input type="radio" name="hm" value="h" required> Hombre
  <input type="radio" name="hm" value="m"> Mujer
</p>
<p class="p">Seleccione un asesor: <select name="asesor">
  <option value="0">...</option>
  <option value="1">JOSE LUIS CANO PEREZ</option>
  <option value="2">ANA LAURA JIMENEZ ARTHUR</option>
  <option value="3">MARIA DEL PILAR BERISTAIN COLORADO</option>
  <option value="4">NOE TRINIDAD TAPIA BONILLA</option>
  <option value="5">JORGE FERNANDO AMBROS ANTEMATE</option>
  <option value="6">FACUNDO SANTIAGO CANSECO RAMOS</option>
  <option value="7">OMAR AUGUSTO HERNANDEZ FLORES</option>
  <option value="8">PATRICIA BATRES MENDOZA</option>
  <option value="9">ERICK ISRAEL GUERRA HERNANDEZ</option>
  <option value="10">MARIA DE JESUS ESTUDILLO AYALA</option>
  <option value="11">MIRIAM GARCIA GARCIA</option>
  <option value="12">JAIME GUTIERREZ GUTIERREZ</option>
</select></p>

<p class="p">Indique un asesor externo:<input type="text" name="externo" size="30"></p>

<p class="p">Seleccione un tipo de titulacion: <select name="tipo">
  <option value="0">...</option>
  <option value="1">Titulación automática por trayectoria excelente</option>
  <option value="2">Titulacion por promedio de 9 y ensayo</option>
  <option value="3">Titulacion por examen ceneval</option>
  <option value="4">Titulacion por medio de una tesis</option>
  <option value="5">Titulacion por medio de una tesina</option>
  <option value="6">Titulacion por estancias de investigacion</option>
  <option value="7">Titulacion por practica profesional comunitaria</option>
</select></p>

 <p class="p"> Fecha de titulacion: <input type="datetime-local" name="fecha" size="20"></p>
 <p class="p"><input type="submit" value="Enviar">
 <input type="reset" value="Borrar">
 </p>
</fieldset>
</form>
</body>
</html>
