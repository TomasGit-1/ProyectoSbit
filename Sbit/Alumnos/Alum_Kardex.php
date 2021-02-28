<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen"/>
<title>Alum_Kardex</title>
	<link rel="stylesheet" type="text/css" href="Alum_Style.css"/>
	<script type="text/javascript" src="Alum_JavaScript.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body> <!--background:#A00;-->
<?php
	if(isset($_POST['usuario'])&&isset($_POST['password'])) //Si llego un id y una contraseña via el formulario lo grabamos en la Sesion
	{
		$_SESSION['usuario'] = $_POST['usuario']; //id Grabado
		$_SESSION['password'] = $_POST['password']; //pass Grabado
	}
	if($_SESSION['usuario']&&$_SESSION['password']){
		$conex = mysqli_connect('localhost','root','','SBIT')or die("No se pudo conectar con la base de datos");
		$db = mysqli_select_db($conex,'SBIT');
		$strqry = "SELECT al.matricula,pe.fechaIngreso,pe.nombre nombreA,pe.apPat,pe.apMat,
		pe.correo,es.nombre nombreE,pe.domicilio,pe.edad,pe.edoCivil,pe.tipo
		FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
			INNER JOIN Alumnos al ON pe.idPersona = al.idPersona
			INNER JOIN Estados es ON pe.idEstado = es.idEstado
			WHERE us.usuario = '".$_SESSION['usuario']."';";
		$qry = mysqli_query($conex,$strqry);
		$row = mysqli_fetch_object($qry);
		$i = mysqli_num_rows($qry);
		$sum = 0;
?>
		<form action="Alumnos.php" method="POST">
			<input class="btn btn-outline-danger text-center" id="Mostaza" type="submit" value="Volver">
		</form>
<?php
        if(isset($_POST['submit'])){
        //---------------------------------------------------------------------------------------------------------------------------------------------------
            //Retorna la matricula dependiendo del usuario introducido--------------------------------------------------
            $strqryMatri = "SELECT al.matricula FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
            INNER JOIN Alumnos al ON pe.idPersona = al.idPersona WHERE us.usuario = '".$_SESSION['usuario']."';";
            $qryMatri = mysqli_query($conex,$strqryMatri);
            $rowMatri = mysqli_fetch_object($qryMatri);
            //Retorna los id de ciclos escolares dependiendo de la matricula introducida--------------------------------
            $strqryCic= "SELECT DISTINCT idCiclo FROM Calificaciones WHERE matricula = '".$rowMatri->matricula."';";
            $qryCic = mysqli_query($conex,$strqryCic);
            //$rowCic = mysqli_fetch_object($qryCic);
            $j = mysqli_num_rows($qryCic);
            $t = 0;
            while($t<$j){
            mysqli_data_seek($qryCic,$t); //mueve el puntero a la fila especificada
            $rowCic = mysqli_fetch_object($qryCic); //obtiene los datos como un objeto
            //Retorna la boleta dependiendo el ciclo introducido--------------------------------------------------------
            $strqryBA = "SELECT * FROM Boleta_Alumno WHERE usuario = '".$_SESSION['usuario']."' AND idCiclo = '".$rowCic->idCiclo."';";
            //$strqryBA= "SELECT * FROM Boleta_Alumno WHERE usuario = '".$_SESSION['usuario']."' AND idCiclo = 3;";
            $qryBA = mysqli_query($conex,$strqryBA);
            $rowBA = mysqli_fetch_object($qryBA);
            $k = mysqli_num_rows($qryBA);
            $s = 0;
            $boleta = $t+1;
?>
            <!-- -------------------------------------------------------------------------------------------------------------------------- -->
            <br/>
            <b><i id="Amarillo">Boleta <?php print"$boleta";?></i></b>
            <table border=1 class="table table-bordered table-hover">
                <!-- <caption style="color:red">Solo materias cursadas</caption> -->
                <tr id="uno">
                    <td rowspan=3 colspan=2>Sin fotografia</td><td colspan=2>NOMBRE DEL ALUMNO<br><?php print"$rowBA->nombre $rowBA->apPat $rowBA->apMat";?></td>
                    <td colspan=4>EVALUACIONES</td><td>GRADO<br><?php print"$boleta";?></td><td colspan=2>NUMERO DE MATERIAS<br><?php print"$k";?></td>
                </tr>
                <tr id="uno">
                    <td>MATRICULA<br><?php print"$rowBA->matricula";?></td><td>CURP<br><?php print"$rowBA->usuario";?></td><td rowspan=2></td><td rowspan=2></td><td rowspan=2></td><td rowspan=2></td><td rowspan=2 colspan=3>CICLO ESCOLAR<br><?php print"$rowBA->descripcion";?></td>
                </tr>
                <tr id="uno">
                    <td colspan=2>CARRERA<br><?php print"$rowBA->nombreLic";?></td>
                </tr>
                <tr id="uno">
                    <td>CRED.</td><td>CLAV.MAT.</td><td colspan=2>NOMBRE DE LA MATERIA</td><td>1a</td><td>2a</td><td>3a</td><td>4a</td><td>CALIF</td><td>FECHA EX.</td><td>TIPO EX.</td>
                </tr>
<?php
                while($s<$k){
                    mysqli_data_seek($qryBA,$s); //mueve el puntero a la fila especificada
                    $row = mysqli_fetch_object($qryBA); //obtiene los datos como un objeto
                    $val = "uno";
                    if(($s%2)==0){
                        $val = "dos";
                    }else{
                        $val = "tres";
                    }
                    $apro = 6;
                    if(($row->calificacion)>=$apro){
                        print"
                        <tr id=\"$val\">
                            <td>$row->creditos</td><td>$row->idMateria</td><td colspan=2>$row->nombreMat</td><td></td><td></td><td></td><td></td>
                            <td>$row->calificacion</td><td>$row->fecha</td><td>$row->tipoExamen</td>
                        </tr>";
                    }else{
                        print"
                        <tr id=\"$val\">
                            <td>$row->creditos</td><td>$row->idMateria</td><td colspan=2>$row->nombreMat</td><td></td><td></td><td></td><td></td>
                            <td id=\"Reprobada\">$row->calificacion</td><td>$row->fecha</td><td>$row->tipoExamen</td>
                        </tr>";
                    }
                    $s++;
                }
?>
            </table>
<?php
            $t++;
        }
        //---------------------------------------------------------------------------------------------------------------------------------------------------
        }else{
?>
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="well well-sm">
                        <form class="form-horizontal" action="Alum_Kardex.php" method="post">
                            <fieldset>
                                <legend class="text-center header">Informacion del alumno.</legend>
                                <!-- ------------------------------------------------------------------- -->
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-6 col-xs-3">
                                            	<label for="state_id" class="control-label">Matricula</label>
                                    			<!--<span class="help-block text-muted small-font" >Matricula</span>-->
                                                <input type="text" class="form-control" placeholder="<?php print"$row->matricula"; ?>" />
                                            </div>
                                            <div class="col-md-12 col-sm-6 col-xs-3">
                                            	<label for="state_id" class="control-label">Fecha de ingreso</label>
                                    			<!--<span class="help-block text-muted small-font" >Fecha de ingreso</span>-->
                                                <input type="text" class="form-control" placeholder="<?php print"$row->fechaIngreso"; ?>" />
                                            </div>
                                            
                                        </div>
                                        <!-- ------------------------------------------------------------------- -->
                                        <div class="row">
                                            <div class="col-md-12">
                                            	<label for="state_id" class="control-label">Nombres</label>
                                    			<!--<span class="help-block text-muted small-font" >Nombres</span>-->
                                                <input id="name" name="nombre" type="text" placeholder="<?php print"$row->nombreA"; ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-md-3 col-sm-18 col-xs-3">
                                            <img src="Imagenes/escudo.png" class="img-rounded" />
                                        </div>
                                </div>
                                <!-- ------------------------------------------------------------------- -->
                                <div class="row">
                                	<div class="col-md-3 col-sm-3 col-xs-3">
                                    	<label for="state_id" class="control-label">Apellido paterno</label>
                                    	<!--<span class="help-block text-muted small-font" >Apellido paterno</span>-->
                                        <input type="text" class="form-control" placeholder="<?php print"$row->apPat"; ?>" />
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                    	<label for="state_id" class="control-label">Apellido materno</label>
                                    	<!--<span class="help-block text-muted small-font" >Apellido materno</span>-->
                                        <input type="text" class="form-control" placeholder="<?php print"$row->apMat"; ?>" />
                                    </div>
                                </div>
                                <!-- ------------------------------------------------------------------- -->
                                <div class="row">
                                    <div class="col-md-6">
                                    	<label for="state_id" class="control-label">Email Address</label>
                                    	<!--<span class="help-block text-muted small-font" >Email Address</span>-->
                                        <input type="text" placeholder="<?php print"$row->correo"; ?>" class="form-control">
                                    </div>
                                </div>
                                <!-- ------------------------------------------------------------------- -->
                                <div class="row"> <!-- State Button -->
                                	<div class="col-md-3">
                                        <label for="state_id" class="control-label">Estado</label>
                                        <select class="form-control" id="state_id">
                                            <option value="AL"><?php print"$row->nombreE"; ?></option>
                                        </select>
                                	</div>
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                    	<label for="state_id" class="control-label">Dirección</label>
                                    	<!--<span class="help-block text-muted small-font" >Dirección</span>-->
                                        <input type="text" class="form-control" placeholder="<?php print"$row->domicilio"; ?>" />
                                    </div>          
                                </div>
                                <!-- ------------------------------------------------------------------- -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-3 col-xs-3">
                                        	<label for="state_id" class="control-label">Edad</label>
                                    		<!--<span class="help-block text-muted small-font" >Edad</span>-->
                                            <input type="text" class="form-control" placeholder="<?php print"$row->edad"; ?>" />
                                        </div>
                                        <div class="col-md-2 col-sm-3 col-xs-3">
                                        	<label for="state_id" class="control-label">Estado civil</label>
                                    		<!--<span class="help-block text-muted small-font" >Estado civil</span>-->
                                            <input type="text" class="form-control" placeholder="<?php print"$row->edoCivil"; ?>" />
                                        </div>
                                        <div class="col-md-2 col-sm-3 col-xs-3">
                                        	<label for="state_id" class="control-label">Sexo</label>
                                    		<!--<span class="help-block text-muted small-font" >Sexo</span>-->
                                            <input type="text" class="form-control" placeholder="<?php print"$row->tipo"; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <!-- ------------------------------------------------------------------- -->
                                <div class="form-group">
                                    <div class="col-md-6 text-center">
                                        <button id="Mostaza" type="submit" name="submit" class="btn btn-light">Ver Boletas</button>
                                    </div>
                                </div>
                                <!-- ------------------------------------------------------------------- -->
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
		}
?>
        </br>
		<form action="Alum_Cerrar_Sesion.php" method="POST">
			<input class="btn btn-outline-danger text-center" id="Mostaza" type="submit" value="Cerrar Sesion">
		</form>
<?php
	}else{
?>
		<script language="javascript">
            alert('No se pudo continuar la sesion');
            location.href="../IniciarSesion.php";
        </script>
<?php 
	}
?>
</body>
</html>