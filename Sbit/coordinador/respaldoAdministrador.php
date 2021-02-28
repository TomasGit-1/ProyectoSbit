<?php
  session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,inicial-scale=1">
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen"/>
<title>Administrador</title>
<link href="alertas/css/alertify.min.css"  rel="stylesheet"/>
<link href="alertas/css/themes/default.min.css"  rel="stylesheet"/>
<script src="alertas/alertify.min.js"></script>
</head>
<body bgcolor="#010000" text="#FFFFFF" link="#00FFFF" vlink="#FFFF55" alink="#FFFF00" style="background:#663333" >
<script src="administrador.js" type="text/javascript" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<div class="container"> 
  <div class="bg-dark" align="center"  style="height:30px">
    <p class="text-light">Coordinacion Academica</p>
  </div>
  <div >
    <img style="height:300px"  class="w-100" src="Imagenes/edificio.png"  />
  </div>
  <nav class="navbar  navbar navbar-expand-lg navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"></button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
         <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#">
             <img src="Imagenes/sbit.jpg" width="30" height="30" >&ensp;&ensp;
             Inicio <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="Alumno.php">Alumno</a>
            <a class="nav-item nav-link" href="Docente.php">Docente</a>
            <a class="nav-item nav-link " href="#">Titulacion</a>
               
         </div>
      </div>
  </nav>
  
  <div style="background:#F1C40F;height:1200px; "> 
    <p class="h4" align="center">Bienvenido  <?php echo $_SESSION['usuario']?></p>
      <br />

          <div class=" container  w-75 " style=" position:relative;" >
          <form  action="" method="post" name="formPrincipal" onSubmit="return validaCampos();">

      Registrar:Docentes/Maestros
     
    <br />        
                  <div class="form-row">
                      <div class="form-group col">
                  <label>Nombre</label>
                          <input class="form-control" type="text" name="nombre"  required/> 
                    </div>  
                        <div class="form-group col">
                          <label>Apellido Paterno</label> 
                          <input class="form-control" type="text" name="apPat" required />
                    </div>
                      <div class="form-group col">
                      <label>Apellido Materno</label> 
                          <input class="form-control" type="text" name="apMat" required/>
                    </div>
                    </div>
                    
                    <div class="form-row">
                      <div  class="form-group col">
                        <label>Email</label>
                            <input  class="form-control" type="email" name="email"  required />
                    </div>
                        <div  class="form-group col">
                          <label>Domicilio</label>
                            <input  class="form-control" type="text" name="domicilio" required />
                    </div>
                        <div  class="form-group col">
                          <label>Edad</label>
                             <input  class="form-control" type="number" name="edad" min="15" max="100" required/>
                      </div>
                    </div>
                    
                    <div class="form-row">
                      <div class="form-group col">
                          <label>Curp</label>
                            <input  class="form-control" type="text"  name="curp"  required /> 
                        </div>    
                        <div class="form-group col-5 text-center " style=" position:relative;top:40px">
                            <label>Masculino</label><input type="radio" class="form-group" name="sexo" value="H" id="idH"  required />
                            <label>Femenino</label><input  type="radio" class="form-group" name="sexo" value="M"  id="idM"  required/>
                        </div>    
                    </div>
                       
                    <div class="form-row"> 
                      <div class="form-group col">  
                      <label>Estado Civil</label>
                        <select  class="custom-select"  name="estadoCivil" required >
                  <option value="">Estado Civil</option>
                    <option>Soltero</option>
                    <option>Casado</option>
                            <option>Divorciado</option>
                    <option>Viudo</option>
                </select>     
                      </div>
                      <div class="form-group col">
                      <label>Fecha de Ingreso</label>
                            <input class="form-control" type="date" name="fecha" required /> 
                        </div>
                        <div class="form-group col">
                          <label>Elije un Estado</label>
                          <select  class="custom-select" name="opcionEstado" required>
                              <option value=" ">Estado</option>
                     <?php
              $conexion=mysqli_connect('localhost','root','','Sbit')or die("No se pudo completar la conexion");
              mysqli_select_db($conexion,"Sbit");
                $strqry="select * from Estados;";
              $qry = mysqli_query ($conexion,$strqry);
                $i=mysqli_num_rows($qry);
  
                $r = 0;
                $c = 0;
                $row = 0;
                while ($r < $i)
                {
                  mysqli_data_seek ($qry, $r);
                    $row = mysqli_fetch_object ($qry);
            ?>
                <option ><?php print $row->nombre;?></option>
                <?php
                $r++;
                }
              mysqli_close ($conexion);
            ?>
                </select> 
                        </div>
                    </div>
                    
                    <div class="form-row">
                       <div class="form-group col">
                            <label>Docente</label>
                              <input type="radio" class="form-group" name="persona" value="docente" id="idDocente" onClick="mostrarCampo();"  required />
                  <label>Alumno</label>
                                <input type="radio"  class="form-group" name="persona" value="alumno"  id="idAlumno"  onclick="mostrarCampo();"  required />
                        </div>
          </div>
                    
                    <div class="form-row col-8"  id="campoDocente" style="display:none;"> 
                             <br />
                            <div>
                                  <label>Grado Academico</label>
                                  <input class="form-control" id="gradoAcademico" type="text" name="gradoAcademico" value=" "   />
                                  <div class="text-light rounded  bg-danger" id="mensaje1">
                                   <h2>  </h2>
                                  </div>
                                  <label>Area de Trabajo</label>
                                  <select class="custom-select" id="areaTrabajo" name="areaTrabajo">
                                    <option value=" ">Area</option>
                                    <option>Electronica</option>
                                    <option>Redes</option>
                                    <option>Programacion</option>
                                    <option>Matematicas</option>
                                    <option>Bases de datos</option>
                                    <option>Inglés</option>
                                    <option>Fisica</option>
                                    <option>Biologia</option>
                                  </select>
                                  <div class="text-light rounded  bg-danger" id="mensaje2">
                                   <h2></h2>
                                  </div>
                                  <label>Numero de Horas</label>
                                  <input class="form-control" id="numHoras" type="number" name="numHoras"  value="0"  />
                                  <div class="text-light rounded  bg-danger" id="mensaje3">
                                   <h2></h2>
                                  </div>  
                                  <label>Experiencia Laboral</label>
                                 <textarea class="form-control "  id="expLaboral" type="text"  maxlength="100" name="expLaboral" ></textarea>
                             <div class="text-light rounded  bg-danger" id="mensaje4">
                                  <h2></h2>
                                 </div>
                           </div> 
                     </div>
                             
                    <div class="form-row col-8" id="campoAlumno" style="display:none;"  >
                        <div>

                             <label>Matricula</label>
                             <input  class="form-control "  id="matricula" type="number"  name="matricula" value="0" />
                              <div class=" text-light rounded  bg-danger" id="mensaje5">
                                 <h2></h2>
                              </div>

                             <label>Escuela de Procedencia</label>
                             <input class="form-control"  id="escuelaProcedencia"type="text" name="escuelaProcedencia" value=" " />
                             <div class=" text-light rounded  bg-danger" id="mensaje6">
                                  <h2></h2>
                              </div>
                              <label>CicloEscolar</label>
                              <select  class="custom-select" id="opcionCiclo" name="opcionCiclo">
                                <option value="">Ciclo Escolar</option>
                                <?php
                                        $conexion=mysqli_connect('localhost','root','','Sbit')or die("No se pudo completar la conexion");
                                        mysqli_select_db($conexion,"Sbit");
                                        $strqry="select * from CicloEsc;";
                                        $qry = mysqli_query ($conexion,$strqry);
                                        $i=mysqli_num_rows($qry);
                                        $r = 0;
                                        $c = 0;
                                        $row = 0;
                                        while ($r < $i)
                                        {
                                            mysqli_data_seek ($qry, $r);
                                            $row = mysqli_fetch_object ($qry);
                                 ?>
                                     <option><?php print $row->descripcion; ?></option>
                                 <?php
                                         $r++;
                                        }
                                    mysqli_close ($conexion);
                                ?>
                                </select> 
                                     <div class="text-light rounded  bg-danger" id="mensaje7">
                                  <h2></h2>
                                </div>
                                 <label>Carrera</label>
                                <select  class="custom-select"  id="opcionCarrera" name="opcionCarrera">
                                <option value=" ">Carrera</option>
                                <?php
                                        $conexion=mysqli_connect('localhost','root','','Sbit')or die("No se pudo completar la conexion");
                                        mysqli_select_db($conexion,"Sbit");
                                        $strqry="select * from Carrera;";
                                        $qry = mysqli_query ($conexion,$strqry);
                                        $i=mysqli_num_rows($qry);
                                        $r = 0;
                                        $c = 0;
                                        $row = 0;
                                        while ($r < $i)
                                        {
                                            mysqli_data_seek ($qry, $r);
                                            $row = mysqli_fetch_object ($qry);
                                 ?>
                                 <option ><?php print $row->nombre; ?></option>
                                 <?php
                                         $r++;
                                        }
                                mysqli_close ($conexion);
                                ?>
                                </select> 
                                <div class=" text-light rounded  bg-danger" id="mensaje8">
                                    <h2></h2>
                                  </div>
                         
                             <label>Servicio Social</label>
                             <select class="custom-select"  id="opcionServico" name="opcionServico">
                              <option value=" ">Servicio</option>
                                <option value="true">Si</option>
                                <option value="false">No</option>
                             </select>
                             <div class=" text-light rounded  bg-danger" id="mensaje9">
                                  <h2></h2>
                              </div>
                             
                             <label>Status</label>
                             <select class="custom-select"  id="opcionStatus" name="opcionStatus">
                                <option value=" ">Status</option>
                              <option>Regular</option>
                                <option>Irregular</option>
                             </select>
                              <div class="text-light rounded  bg-danger" id="mensaje10">
                                <h2></h2>
                              </div> 
                         </div>       
                     </div>
                
                    <br />
                <button class="btn btn-dark" type="submit">Aceptar</button>
        </form>
        </div>

  </div>
    <div class="bg-dark" align="center"  style="height:30px">
    <p class="text-light">Cordinacion Academica</p>
  </div>
</div>
</body>
</html>
<?php  
  $nivelAdministrador=1;
  $nivelDocente=2;
  $nivelAlumno=3;
  if($_POST)
  {
    //Conectamos Con la Base de Datos
    $conexion=mysqli_connect('localhost','root','','Sbit')or die("No se pudo completar la conexion");
    mysqli_select_db($conexion,"Sbit");
    if ($_POST['persona']=="docente")
    {
      //Verificar si el usuario no esta repetido
      $strqry = "SELECT * FROM usuarios WHERE usuario='".$_POST['curp']."';";
      $qry = mysqli_query($conexion,$strqry);
          $i=mysqli_num_rows($qry);
        if ($i > 0)     
        {
        //Mostrar Mensaje 
?>
        <script language="javascript" type="text/javascript">
                alertify.error("El Usuario ya esta registrado");
        </script>
<?php       
        //Se cancela La conexion
      }
      else 
      {
         // Se intenta insertar el registro a la tabla usuario ...
              $strqry = "INSERT INTO Usuarios (usuario,passwordd,nivel) VALUES('".$_POST['curp']."','".$_POST['curp']."','".$nivelDocente."');";
              $qry = mysqli_query($conexion,$strqry);
        if (!$qry)
        {
          //Mostrar Mensaje 
?>
          <script  language="javascript" type="text/javascript">
                alertify.error("La operacion Registro Fallo");
              alertify.error("Intentelo de Nuevo");
          </script>
<?php
        }
        else
        {
          //Como se pudo insertar en la tabal usuario ahora verificmos  en la tabla Persona
          $strqry = "SELECT * FROM personas WHERE curp='".$_POST['curp']."';";
          $qry = mysqli_query($conexion,$strqry);
              $i=mysqli_num_rows($qry);
          if($i>0)
          {
            //Tendremos que borra el usuario quue se pudo Insertar
            $strqry = "Delete from Usuarios where usuario='".$_POST['curp']."';";
            $qry = mysqli_query($conexion,$strqry);

            //Mostrar Mensaje 
?>
            <script  language="javascript" type="text/javascript">
                alertify.error("El Usuario ya esta registrado");
            </script>
<?php
          }
          else 
          {
            //Hacemos la consulta para el idEstado
            $strqry="select * from  Estados where nombre='".$_POST['opcionEstado']."';";
            $qry = mysqli_query ($conexion,$strqry);
              $i=mysqli_num_rows($qry);
            $r = 0;
            $c = 0;
            $row = 0;
            while ($r < $i)
            {
              mysqli_data_seek ($qry, $r);
                $row = mysqli_fetch_object ($qry);
              //Recatamos el id 
              $idEstado=$row->idEstado;
              $r++;
            }
            //Hacemos la consulta para recatar el idUsuario
            $strqry="select * from  Usuarios where usuario='".$_POST['curp']."';";
            $qry = mysqli_query ($conexion,$strqry);
              $i=mysqli_num_rows($qry);
            $r = 0;
            $c = 0;
            $row = 0;
            while ($r < $i)
            {
              mysqli_data_seek ($qry, $r);
                $row = mysqli_fetch_object ($qry);
              //Rescatamos el valor del id
              $idUsuario=$row->idUsuario;
              $r++;
            }
            //Una vez teniedo y rescatando todos los valores que nececitemos Insertamos en La Tabla Personas
            $strqry = "INSERT INTO Personas (idUsuario,nombre,apPat,apMat,correo,domicilio,idEstado,edad,edoCivil, fechaIngreso,curp,tipo) VALUES('".(int)($idUsuario)."','".$_POST['nombre']."','".$_POST['apPat']."','".$_POST['apMat']."','".$_POST['email']."','".$_POST['domicilio']."','".(int)$idEstado."','".(int)$_POST['edad']."','".$_POST['estadoCivil']."','".$_POST['fecha']."','".$_POST['curp']."','".$_POST['sexo']."');";                                             
                  $qry = mysqli_query($conexion,$strqry);
            if (!$qry)
            {
              //sI Falla La insercion Borramos los Datos que ya insertamos de usuario para que no se repitan
                $strqry = "Delete from Usuarios where idUsuario='".$idUsuario."';";
              $qry = mysqli_query($conexion,$strqry);
              //Mostrar Mensaje 
?>
              <script  language="javascript" type="text/javascript">
                alertify.error("La operacion Registro Fallo");
              alertify.error("Intentelo de Nuevo");
            </script>
<?php
                    //print "La operación de inserción para : ".$strqry." fue fallida.<br>". mysqli_error()."<br>";
            }
            else 
            {
              //Hacemos la consulta para rescatar el idPersona
              $strqry="select * from  Personas where idUsuario='".$idUsuario."';";
              $qry = mysqli_query ($conexion,$strqry);
                $i=mysqli_num_rows($qry);
              $r = 0;
              $c = 0;
              $row = 0;
              while ($r < $i)
              {
                mysqli_data_seek ($qry, $r);
                  $row = mysqli_fetch_object ($qry);
                //Recatamos el id 
                $idPersona=$row->idPersona;
                $r++;
              }
              //Si existe en la tabal maestros
              $strqry = "SELECT * FROM Maestros WHERE idPersona='".$idPersona."';";
              $qry = mysqli_query($conexion,$strqry);
                  $i=mysqli_num_rows($qry);
              if($i>0)
              {

                //print("La persona Ya esta registrada");
                //Tendremos que borra el usuarioy la persona  quue se pudo Insertar
                  $strqry = "Delete from Usuarios where idUsuario='".$idUsuario."';";
                $qry = mysqli_query($conexion,$strqry);

                //$strqry = "Delete from Personas where idPersona='".$idPersona."';";
                //Mostrar Mensaje 

?>                  <script language="javascript" type="text/javascript">
                      alertify.error("El Usuario ya esta registrado");
                  </script>
<?php
              }
              else 
              {
                //Insertamos En la tabla Maestros
                $strqry = "INSERT INTO Maestros (idPersona,expLaboral,Tipo,Categoria,numHoras) VALUES('".$idPersona."','".$_POST['expLaboral']."','".$_POST['gradoAcademico']."','".$_POST['areaTrabajo']."','".$_POST['numHoras']."');";                                             
                      $qry = mysqli_query($conexion,$strqry);
                if (!$qry)
                {
                  //sI Falla La insercion Borramos los Datos que ya insertamos de usuario para que no se repitan
                     $strqry = "Delete from Usuarios where idUsuario='".$idUsuario."';";
                        $qry = mysqli_query($conexion,$strqry);

                   //$strqry = "Delete from Personas where idPersona='".$idPersona."';";
?>
                    <script  language="javascript" type="text/javascript">
                        alertify.error("La operacion Registro Fallo");
                      alertify.error("Intentelo de Nuevo");
                    </script>
<?php
                           //Mostrar Mensaje de error
                  // print "La operación de inserción para : ".$strqry." fue fallida.<br>". mysqli_error()."<br>";
                }
                else 
                {
                  //Mostrar Mensaje 
                  //print("Se ha Insertado Los Datos Correctamente");
?>
                    <script language="javascript" type="text/javascript">
                      alertify.success("La operacion fue un exito");
                  </script>
<?php                 
                }
              }
            }
          }
        }
      }   
     }
     //---------------------------La Persona que se desea Agregar es Un Alumno-------------------------------------------//
    else 
    {
      //Verificar si el usuario no esta repetido
      $strqry = "SELECT * FROM usuarios WHERE usuario = '".$_POST['curp']."';";
      $qry = mysqli_query($conexion,$strqry);
          $i=mysqli_num_rows($qry);
        if ($i > 0)     
        {
        //Mostrar Mensaje 
?>
        <script  language="javascript" type="text/javascript">
            alertify.error("El Usuario se encuentra registrado");
        </script>
<?php               
        //print ("El usuario ");
        //Se cancela La conexion
      }
      else 
      {
         // Se intenta insertar el registro a la tabla usuario ...
              $strqry = "INSERT INTO Usuarios (usuario,passwordd,nivel) VALUES('".$_POST['curp']."','".$_POST['curp']."','".$nivelAlumno."');";
              $qry = mysqli_query($conexion,$strqry);
        if (!$qry)
        {
          //Mostrar Mensaje 
?>
        <script  language="javascript" type="text/javascript">
                alertify.error("La operacion Registro Fallo");
              alertify.error("Intentelo de Nuevo");
        </script>   
<?php
                  //print "La operación de inserción para : ".$strqry." fue fallida.<br>". mysqli_error()."<br>";
        }
        else
        {
          //Como se pudo insertar en la tabal usuario ahora verificmos  en la tabla Persona
          $strqry = "SELECT * FROM personas WHERE curp='".$_POST['curp']."';";
          $qry = mysqli_query($conexion,$strqry);
              $i=mysqli_num_rows($qry);
          if($i>0)
          {
            //Tendremos que borra el usuario quue se pudo Insertar
            $strqry = "Delete from Usuarios where usuario='".$_POST['curp']."';";
                $qry = mysqli_query($conexion,$strqry);

            //Mostrar Mensaje 
?>
            <script  language="javascript" type="text/javascript">
                alertify.error("El Usuario se encuentra registrado");
            </script>

<?php
          }
          else 
          {
            //Hacemos la consulta para el idEstado
            $strqry="select * from  Estados where nombre='".$_POST['opcionEstado']."';";
            $qry = mysqli_query ($conexion,$strqry);
              $i=mysqli_num_rows($qry);
            $r = 0;
            $c = 0;
            $row = 0;
            while ($r < $i)
            {
              mysqli_data_seek ($qry, $r);
                $row = mysqli_fetch_object ($qry);
              //Recatamos el id 
              $idEstado=$row->idEstado;
              $r++;
            }
            //Hacemos la consulta para recatar el idUsuario
            $strqry="select * from  Usuarios where usuario='".$_POST['curp']."';";
            $qry = mysqli_query ($conexion,$strqry);
              $i=mysqli_num_rows($qry);
            $r = 0;
            $c = 0;
            $row = 0;
            while ($r < $i)
            {
              mysqli_data_seek ($qry, $r);
                $row = mysqli_fetch_object ($qry);
              //Rescatamos el valor del id
              $idUsuario=$row->idUsuario;
              $r++;
            }
            //Una vez teniedo y rescatando todos los valores que nececitemos Insertamos en La Tabla Personas
            $strqry = "INSERT INTO Personas (idUsuario,nombre,apPat,apMat,correo,domicilio,idEstado,edad,edoCivil, fechaIngreso,curp,tipo) VALUES('".(int)($idUsuario)."','".$_POST['nombre']."','".$_POST['apPat']."','".$_POST['apMat']."','".$_POST['email']."','".$_POST['domicilio']."','".(int)$idEstado."','".(int)$_POST['edad']."','".$_POST['estadoCivil']."','".$_POST['fecha']."','".$_POST['curp']."','".$_POST['sexo']."');";                                             
                  $qry = mysqli_query($conexion,$strqry);
            if (!$qry)
            {
              //sI Falla La insercion Borramos los Datos que ya insertamos de usuario para que no se repitan
                $strqry = "Delete from Usuarios where idUsuario='".$idUsuario."';";
              $qry = mysqli_query($conexion,$strqry);

              //Mostrar Mensaje 
?>
              <script  language="javascript" type="text/javascript">
                  alertify.error("La operacion Registro Fallo");
                alertify.error("Intentelo de Nuevo");
            </script>
<?php
                    //print "La operación de inserción para : ".$strqry." fue fallida.<br>". mysqli_error()."<br>";
            }
            else 
            {
              //Hacemos la consulta para rescatar el idPersona
              $strqry="select * from  Personas where idUsuario='".$idUsuario."';";
              $qry = mysqli_query ($conexion,$strqry);
                $i=mysqli_num_rows($qry);
              $r = 0;
              $c = 0;
              $row = 0;
              while ($r < $i)
              {
                mysqli_data_seek ($qry, $r);
                  $row = mysqli_fetch_object ($qry);
                //Recatamos el id 
                $idPersona=$row->idPersona;
                $r++;
              }
              //Alumnos 
              $strqry = "SELECT * FROM alumnos WHERE idPersona='".$idPersona."';";
              $qry = mysqli_query($conexion,$strqry);
                  $i=mysqli_num_rows($qry);
              if($i>0)
              {
                //print("La persona Ya esta registrada");
                //Tendremos que borra el usuarioy la persona  quue se pudo Insertar
                    $strqry = "Delete from Usuarios where idUsuario='".$idUsuario."';";
                $qry = mysqli_query($conexion,$strqry);

                //$strqry = "Delete from Personas where idPersona='".$idPersona."';";
                //Mostrar Mensaje 
?>
                  <script  language="javascript" type="text/javascript">
                          alertify.error("El Usuario se encuentra registrado");
                  </script>

<?php
              }
              else 
              {
                //Insertamos En la tabla Maestros
                $strqry = "INSERT INTO alumnos (matricula,idPersona,EscProcedencia,servSocial,statuss,validacion1,validacion2) VALUES('".$_POST['matricula']."','".$idPersona."','".$_POST['escuelaProcedencia']."','".(boolean)($_POST['opcionServico'])."','".$_POST['opcionStatus']."',".FALSE.",".FALSE.");";                                             
                      $qry = mysqli_query($conexion,$strqry);
                if (!$qry)
                {
                  //sI Falla La insercion Borramos los Datos que ya insertamos de usuario para que no se repitan
                  $strqry = "Delete from Usuarios where idUsuario='".$idUsuario."';";
                  $qry = mysqli_query($conexion,$strqry);
                   //$strqry = "Delete from Personas where idPersona='".$idPersona."';";
?>
                <script  language="javascript" type="text/javascript">
                      alertify.error("La operacion Registro Fallo");
                      alertify.error("Intentelo de Nuevo");
                </script>
<?php
                   //Mostrar Mensaje de error
                  // print "La operación de inserción para : ".$strqry." fue fallida.<br>". mysqli_error()."<br>";
                }
                else 
                {
                  //Mostrar Mensaje 
                  //print("Se ha Insertado Los Datos Correctamente");
?>
                  <script language="javascript" type="text/javascript">
                      alertify.success("La operacion fue un exito");
                  </script>
<?php                 
                }
               }
             }
            }
          }
        } 
      } 
   mysqli_close ($conexion);
  }
?>
















//Comienza la ACTUALIZACION
  
         $nuevovalor=$_POST['nuevovalor'];
         $matricula=$_POST['matriculaActualizar'];
    if(!empty($_POST['matriculaActualizar']))
    {
      $conexion=mysqli_connect('localhost','root','','Sbit')or die("No se pudo completar la conexion");
      mysqli_select_db($conexion,"Sbit");
      $strqry = "SELECT * FROM infoAlumno  where matricula='".$_POST['matriculaActualizar']."';";
      $qry = mysqli_query ($conexion,$strqry);
        $i=mysqli_num_rows($qry);
      $r = 0;
      $c = 0;
      $row = 0;
      if($i>0)
      {
          if(isset($_POST['campo']))
          {
            if($_POST['campo']=='nombre')
            {
              $strqry = "Update infoAlumno set nombre='$nuevovalor' where matricula='$matricula'";
              $qry = mysqli_query ($conexion,$strqry);
              print "Agregado";
            }
            else 
            {
              if($_POST['campo']=='apPat')
              {
                $strqry = "Update infoAlumno set apPat='$nuevovalor' where matricula='$matricula'";
                $qry = mysqli_query ($conexion,$strqry);
              }
              else 
                {
                if($_POST['campo']=='apMat')
                {
                  $strqry = "Update infoAlumno set apMat='$nuevovalor' where matricula='$matricula'";
                  $qry = mysqli_query ($conexion,$strqry);
                }
                else 
                {
                  if($_POST['campo']=='correo')
                  {
                    $strqry = "Update infoAlumno set correo='$nuevovalor' where matricula='$matricula'";
                    $qry = mysqli_query ($conexion,$strqry);
                  }
                  else 
                  {
                    if($_POST['campo']=='domicilio')
                    {
                      $strqry = "Update infoAlumno set domicilio='$nuevovalor' where matricula='$matricula'";
                      $qry = mysqli_query ($conexion,$strqry);
                    }
                    else 
                    {
                      if($_POST['campo']=='edad')
                      {
                        $strqry = "Update infoAlumno set edad='$nuevovalor' where matricula='$matricula'";
                        $qry = mysqli_query ($conexion,$strqry);
                      }
                      else 
                      {
                        if($_POST['campo']=='edoCivil')
                        {
                          $strqry = "Update infoAlumno set edoCivil='$nuevovalor' where matricula='$matricula'";
                          $qry = mysqli_query ($conexion,$strqry);
                        }
                        else 
                        {
                          if($_POST['campo']=='EscProcedencia')
                          {
                            $strqry = "Update infoAlumno set EscProcedencia='$nuevovalor' where matricula='$matricula'";
                            $qry = mysqli_query ($conexion,$strqry);
                          }
                        }

                      }
                    }
                    
                  }
                }
              }
            }

          }
        
      }
      else
      {
?>
        <script language="javascript" type="text/javascript">
           alertify.error('No se encontro la Matricula del Alumno');  
            </script>;
<?php
      }
    }
?>