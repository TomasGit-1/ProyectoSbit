<?php
session_start();

if(isset($_SESSION['password']))
{
// Intentando la conexión con MySQL ...
$link = mysqli_connect ('localhost','root','','SBIT') or die ("No se logro la conexión");

// Selecciona la base de datos
$db = mysqli_select_db ($link,"SBIT");

if (!$db) print "El intento por accesar la base de datos fue fallido<br>";
else {

     $strqry="SELECT idUsuario FROM usuarios WHERE passwordd='".$_SESSION['password']."' and  usuario='".$_SESSION['usuario']."' ;";
     $qry = mysqli_query($link,$strqry);
    
     if (!$qry) print "La consulta ".$qry." fue fallida... <br>";
     else {
        $row = mysqli_fetch_row($qry);
        $a=$row[0];
//------------------------------------------------------------------//
        $strqry1="SELECT ma.idMaestro FROM maestros ma inner join 
        personas pe on  ma.idPersona=pe.idPersona inner join
        usuarios us on pe.idUsuario=us.idUsuario where us.idUsuario=' ".$a." '; ";
        $qry1 = mysqli_query($link,$strqry1); 
        $row1 = mysqli_fetch_row($qry1);
        $b=$row1[0];



        $strqry2="SELECT ma.tipo,pe.nombre,pe.apPat,pe.apMat,ma.categoria,ma.expLaboral,pe.correo,pe.domicilio FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario=pe.idUsuario INNER JOIN maestros ma ON pe.idPersona = ma.idPersona WHERE ma.idMaestro=' ".$b." '; ";
        $qry2=mysqli_query($link,$strqry2);
        $i=mysqli_num_rows($qry2);
        $r=0;
        $c=0;
        $row2=0;
        while ($r<$i) {
            mysqli_data_seek($qry2,$r);
            $row2=mysqli_fetch_object($qry2);
            $tipo1=$row2->tipo;
            $nom=$row2->nombre;
            $aP=$row2->apPat;
            $aM=$row2->apMat;
            $ca=$row2->categoria;
            $exp=$row2->expLaboral;
            $cor=$row2->correo;
            $dom=$row2->domicilio;
         $r++;   
        }
    }

}
}
?>


<html>
<head>

<title>SBIT/MENU</title>
	 <!--<link rel="stylesheet" type="text/css" href="estil.css"/>-->
	 <link rel="shortcut icon" href="SBIT.png" type="image/png">
     <script type="text/javascript" src="JavaSl.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">



</head>
<body background="fon1.png">

<div>

<nav>
<div class="bg-dark" align="center"  style="height:30px">
        <p class="text-light">SBIT/CATEDRATICO</p>
    </div>
    <div >
        <img style="height:300px"  class="w-100" src="SBIT.jpeg"/>
    </div>
    <nav class="navbar  navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
             <div class="navbar-nav">
                <a class="nav-item nav-link " href="#">                
                <img src="SBIT.png" width="30" height="30" >&ensp;&ensp;
                Inicio <span class="sr-only"></span></a>
 
                <a class="nav-item nav-link" href="MuestraM.php">Consultar Materias</a>
                <a class="nav-item nav-link" href="ConsultaA.php">Consultar Alumnos</a>
                <a class="nav-item nav-link " href="RegistrarCal.php">Registrar Calificaciones</a>
                <a class="nav-item nav-link " href="../Tutorias/inicio2.html">Tutorias</a>
                <a class="nav-item nav-link " href="MensajesA.php">Mensajes</a>
             </div>
        </div>
    </nav>



</div>   
<DIV ALIGN="center"><img src="bienvenido.png"></DIV>


<!-- 
<div> 
    <input type="button" value="MATERIAS " id="M1" onmouseout="mouseSal(this)" onmouseover="mouseM(this)" onclick="li1(this)" align="center">
    <input type="button" value="REGISTRAR CALIFICACIONES" id="M1" onmouseout="mouseSal(this)" onmouseover="mouseM(this)" onclick="li2(this)" align="center">
    <input type="button" value="TUTORIAS" id="M1" onmouseout="mouseSal(this)"onmouseover="mouseM(this)" onclick="li3(this)"align="center">
    <input type="button" value="ALUMNOS" id="M1" onmouseout="mouseSal(this)"onmouseover="mouseM(this)" onclick="li4(this)" align="center">
    <input type="button" value="MENSAJES" id="M1" onmouseout="mouseSal(this)"onmouseover="mouseM(this)" onclick="li5(this)" align="center">
</div>

-->  
    <br>
<form> 
<div  class="container-fluid"> 
  <fieldset disabled>
  <div class="row">
    <div class="col">
       <LABEL class="lead" ><strong><font face="Georgia" size="5" >Grado De Estudio:</font></strong></LABEL>
        <input type="text" class="form-control" type="text" name="grado" value="<?php echo $tipo1 ?> "/>
    </div>
    <div class="col">
      <LABEL class="lead"><strong><font face="Georgia" size="5" >Nombre:</font></strong></LABEL>
      <input type="text" class="form-control" type="text" name="nomb" value="<?php echo $nom?>" />
    </div>
    <div class="col">
        <LABEL class="lead"><strong><font face="Georgia" size="5" >Apellido Paterno:</font></strong></LABEL>
        <input class="form-control"  type="text" name="ApellidoP" value="<?php echo $aP ?>" />
    </div>
    <div class="col">
        <LABEL class="lead"><strong><font face="Georgia" size="5" >Apellido Materno :</font></strong></LABEL>
        <input class="form-control" type="text" name="ApellidoM" value="<?php echo $aM ?>" />
    </div>
    </div>
        <div class="row">
            <div class="col">
        <LABEL class="lead"><strong><font face="Georgia" size="5" >Categoria :</font></strong></label>
        <input class="form-control col-sm-6" type="text" name="Categoria" value="<?php echo $ca ?>" />
    </div>
        <div class="col">
        <LABEL class="lead"><strong><font face="Georgia" size="5" >Experencia Laboral:</font></strong></LABEL>
        <input class="form-control col-sm-6" id="M2"type="text" name="Exp" value="<?php echo $exp ?>" />   
    </div>
        <div class="col">
        <LABEL class="lead"><strong><font face="Georgia" size="5" >Correo :</font></strong></LABEL>
        <input class="form-control col-sm-6" type="text" name="corre" value="<?php echo $cor ?>" />
    </div>

       </div>

        <LABEL class="lead"><strong><font face="Georgia" size="5" >Domicilio:</font></strong></LABEL><input class="form-control col-sm-6" id="M2"type="text" name="dom" value="<?php echo $dom ?>" />  
        </fieldset> 
</div> 
<br>
<br>
<br>
<br>
</form>
    <a class="btn btn-warning btn-lg" href="Salir.php" role="button">Salir</a>
</body>
</html>