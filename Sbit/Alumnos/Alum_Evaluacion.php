<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen"/>
    <link rel="stylesheet" type="text/css" href="Alum_Style.css"/>
    <script type="text/javascript" src="Alum_JavaScript.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
<title>Alum_Evaluacion</title>
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
		$strqryP = "SELECT * FROM Plan_Alumno WHERE usuario = '".$_SESSION['usuario']."';";
		$qryP = mysqli_query($conex,$strqryP);
		$rowP = mysqli_fetch_object($qryP);
		$i = mysqli_num_rows($qryP);
		$sum = 0;
?>
		<form action="Alumnos.php" method="POST">
			<input class="btn btn-outline-danger text-center" id="Mostaza" type="submit" value="Volver">
		</form>
<?php
        if(isset($_POST['idMaestro'])){
?>
            <form action="Alum_Evaluacion.php" name="datos" method="POST">
            	<b><i id="Amarillo">Por favor, indica tu grado de acuerdo/desacuerdo con las siguientes afirmaciones, donde 5 es completamente de acuerdo y 1 es completamente en desacuerdo.</i></b>
                <div id="Fondo">
                <div id="Fondo" class="btn btn-outline-warning" style="width:95%; height:70px">
                <p id="Crema">Respeta a todos sus alumnos: </p>
                    <label >Opciones :</label>
                    <input name="radio1" type="radio" value="1">1
                    <input name="radio1" type="radio" value="2">2
                    <input name="radio1" type="radio" value="3">3
                    <input name="radio1" type="radio" value="4">4
                    <input name="radio1" type="radio" value="5">5<br/>
				</div>
                <div id="Fondo" class="btn btn-outline-warning" style="width:95%; height:70px">
                <p id="Crema">Es receptivo y está abierto a nuevas ideas: </p>
                    <label>Opciones :</label>
                    <input name="radio2" type="radio" value="1">1
                    <input name="radio2" type="radio" value="2">2
                    <input name="radio2" type="radio" value="3">3
                    <input name="radio2" type="radio" value="4">4
                    <input name="radio2" type="radio" value="5">5<br/>
				</div>
                <div id="Fondo" class="btn btn-outline-warning" style="width:95%; height:70px">
                <p id="Crema">Utiliza ejemplos útiles para explicar su asignatura: </p>
                    <label>Opciones :</label>
                    <input name="radio3" type="radio" value="1">1
                    <input name="radio3" type="radio" value="2">2
                    <input name="radio3" type="radio" value="3">3
                    <input name="radio3" type="radio" value="4">4
                    <input name="radio3" type="radio" value="5">5<br/>
				</div>
                <div id="Fondo" class="btn btn-outline-warning" style="width:95%; height:70px">
                <p id="Crema">Está al día de los avances en la asignatura que imparte: </p>
                    <label>Opciones :</label>
                    <input name="radio4" type="radio" value="1">1
                    <input name="radio4" type="radio" value="2">2
                    <input name="radio4" type="radio" value="3">3
                    <input name="radio4" type="radio" value="4">4
                    <input name="radio4" type="radio" value="5">5<br/>
				</div>
                <div id="Fondo" class="btn btn-outline-warning" style="width:95%; height:70px">
                <p id="Crema">Integra teoría y práctica: </p>
                    <label>Opciones :</label>
                    <input name="radio5" type="radio" value="1">1
                    <input name="radio5" type="radio" value="2">2
                    <input name="radio5" type="radio" value="3">3
                    <input name="radio5" type="radio" value="4">4
                    <input name="radio5" type="radio" value="5">5<br/>
				</div>
                <div id="Fondo" class="btn btn-outline-warning" style="width:95%; height:70px">
                <p id="Crema">Muestra entusiasmo por su asignatura: </p>
                    <label>Opciones :</label>
                    <input name="radio6" type="radio" value="1">1
                    <input name="radio6" type="radio" value="2">2
                    <input name="radio6" type="radio" value="3">3
                    <input name="radio6" type="radio" value="4">4
                    <input name="radio6" type="radio" value="5">5<br/>
				</div>
                <div id="Fondo" class="btn btn-outline-warning" style="width:95%; height:70px">
                <p id="Crema">Posee un concocimiento avanzado de su asignatura: </p>
                    <label>Opciones :</label>
                    <input name="radio7" type="radio" value="1">1
                    <input name="radio7" type="radio" value="2">2
                    <input name="radio7" type="radio" value="3">3
                    <input name="radio7" type="radio" value="4">4
                    <input name="radio7" type="radio" value="5">5<br/>
				</div>
                <div id="Fondo" class="btn btn-outline-warning" style="width:95%; height:70px">
                <p id="Crema">Explica los objetivos del curso de forma clara: </p>
                    <label>Opciones :</label>
                    <input name="radio8" type="radio" value="1">1
                    <input name="radio8" type="radio" value="2">2
                    <input name="radio8" type="radio" value="3">3
                    <input name="radio8" type="radio" value="4">4
                    <input name="radio8" type="radio" value="5">5<br/>
				</div>
                <div id="Fondo" class="btn btn-outline-warning" style="width:95%; height:70px">
                <p id="Crema">Promueve la participación de los alumnos: </p>
                    <label>Opciones :</label>
                    <input name="radio9" type="radio" value="1">1
                    <input name="radio9" type="radio" value="2">2
                    <input name="radio9" type="radio" value="3">3
                    <input name="radio9" type="radio" value="4">4
                    <input name="radio9" type="radio" value="5">5<br/>
				</div>
                <div id="Fondo" class="btn btn-outline-warning" style="width:95%; height:70px">
                <p id="Crema">Crea un buen ambiente en su clase: </p>
                    <label>Opciones :</label>
                    <input name="radio10" type="radio" value="1">1
                    <input name="radio10" type="radio" value="2">2
                    <input name="radio10" type="radio" value="3">3
                    <input name="radio10" type="radio" value="4">4
                    <input name="radio10" type="radio" value="5">5<br/>
				</div>
                <div id="Fondo" class="btn btn-outline-warning" style="width:95%; height:70px">
                <p id="Crema">Es un experto en la asignatura que imparte: </p>
                    <label>Opciones :</label>
                    <input name="radio11" type="radio" value="1">1
                    <input name="radio11" type="radio" value="2">2
                    <input name="radio11" type="radio" value="3">3
                    <input name="radio11" type="radio" value="4">4
                    <input name="radio11" type="radio" value="5">5<br/>
				</div>
                <div id="Fondo" class="btn btn-outline-warning" style="width:95%; height:70px">
				<p id="Crema">Prepara las clases: </p>
                    <label>Opciones :</label>
                    <input name="radio12" type="radio" value="1">1
                    <input name="radio12" type="radio" value="2">2
                    <input name="radio12" type="radio" value="3">3
                    <input name="radio12" type="radio" value="4">4
                    <input name="radio12" type="radio" value="5">5<br/>
                </div>
                </div>
                <br>
                <?php
                if(!empty($_POST['sum'])){
					$sum = $_POST['sum'];
					$sum += 1;
					print"<input name=\"sum\" type=\"hidden\" value=\"$sum\">";
				}else{
					print"<input name=\"sum\" type=\"hidden\" value=\"1\">";
				}
				?>
                <input class="btn btn-outline-danger text-center" name="submit" id="Mostaza" type="submit" value="continuar">
			</form>
<?php
        }else{
			if(!empty($_POST['sum'])){
?>
                <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Has evaluado:</h4>
                <p><?php print $_POST['sum']." catedraticos";?></p>
                </div>
<?php
				//print"<b><i id=\"Crema\">Has evaluado ".$_POST['sum']." catedraticos</i></b><br/>";
				$a = $i;
				$suma = 0; //Suma de creditos
				$catedraticos = 0; //Numero de catedraticos a evaluar
				while($suma<=50){
					mysqli_data_seek($qryP,(($a)-1)); //mueve el puntero a la fila especificada
					$rowN = mysqli_fetch_object($qryP); //obtiene los datos como un objeto
					$a--;
					$suma+=$rowN->creditos;
					$catedraticos++;
				}
				if(($_POST['sum'])==$catedraticos){  //Suma de evaluaciones == numero de catedraticos
					//Actualiza validacion2 para poder entrar a "Reinscripcion"
					$strqry = "UPDATE Alumnos set validacion2 = TRUE WHERE matricula = ".$rowP->matricula.";";
					$qry = mysqli_query($conex,$strqry);
					if($qry){
						?>
							<script language="javascript">
                                alert('Ha terminado de evaluar, ya puede comenzar con su reinscripcion');
                                location.href="Alumnos.php";
                            </script>
                        <?php 
					}else{
						?>
							<script language="javascript">
                                alert('Ocurrio un error, intente de nuevo!');
                                location.href="Alumnos.php";
                            </script>
                        <?php 
					}
				}
			}
?>
            <form action="Alum_Evaluacion.php" name="datos" method="POST">
            	<b><i id="Amarillo">Catedratico a evaluar:</i></b>
                <div class="input-group" style="background:#663333;">
                    <select class="custom-select col-md-4" name="idMaestro">
<?php
                    while(($sum<=50)){
                        mysqli_data_seek($qryP,(($i)-1)); //mueve el puntero a la fila especificada
                        $row = mysqli_fetch_object($qryP); //obtiene los datos como un objeto
                        print"<option value=\"$row->idMtr\">".$row->nombreMat."</option>";
                        $i--;
                        $sum+=$row->creditos;
                    }
?>
                    </select>
                    <?php
                    if(!empty($_POST['sum'])){
                        $sum = $_POST['sum'];
                        print"<input name=\"sum\" type=\"hidden\" value=\"$sum\">";
                    }
                    ?>
                    <div class="input-group-append" style="background:#663333;">
                        <input class="btn btn-outline-danger text-center" id="Mostaza" name="submit" type="submit" value="Evaluar">
                    </div>
                </div>
		</form>
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