<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="shortcut icon" href="egresados.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../proyectotitulaciones/estil.css" />
    <title>Cuestionario Egresados</title>
</head>

<body id="body">
  <header id="header">
    		<h1>Cuestionario para egresados</h1> 
	</header>
    <HR noshade size="6"/>
<center><h2>Registro de egresados</h2></center>
 <form method="POST" action="cuestioanario.php">
 <p>&nbsp;</p>
 <p class="p">Nombre: <br />
   <input type="text" name="nombre" size="50" required />
 </p>
 <p class="p">Matricula: <br />
   <input type="text" name="matricula" size="50" required />
  </p>
  <p class="p">Carrera:
 <select name="licenciatura"> 
  <option value="0">...</option>
  <option value="1">Lic.Biologia</option>
  <option value="2">Lic.Computacion</option>
  <option value="3">Ing.Innovacion Tecnologica</option>
</select>
</p>
  <p class="p">Email: <br />
 <input type="text" name="email" size="50" required />
 </p>
  <p class="p">Año de nacimiento: <input type="number" name="nacido" min="1900"></p>
  <p class="p">Sexo:
  <input type="radio" name="hm" value="h"> Hombre
    <input type="radio" name="hm" value="m"> Mujer
  </p>
 <p class="p">Ocupacion actual: <br />
 <textarea name="ocupacion" rows="5" cols="40"></textarea>
 </p>
 <p class="p">
 Dirección actual: <br />
 <textarea name="direccion" rows="5" cols="40"></textarea>
 </p>
 <P class="p">Edad actual: <br />
 <input type="text" name="edad" size="3" /> 
 </p>
 <p class="p">
   <input type="submit" name="submit" value="Enviar" />
   <input type="reset" value="Borrar" />
   </p>
</form>
</body>
</html>
