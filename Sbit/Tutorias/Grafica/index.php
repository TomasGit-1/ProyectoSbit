<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Grafica</title>
<link rel="stylesheet" type="text/css" href="librerias/bootstrap-3.3.7-dist/css/bootstrap.css" />
<script src="librerias/jquery-3.3.1.min.js"></script>
<script src="librerias/plotly-latest.min.js"></script>

</head>

<body>
	<div class="container">
    	<div class="row">
        	<div class="col-sm-12">
            	<div class="panel panel-primary">
                	<div class="panel panel-heading">
                   		<p align="center">Grafica</p>
                    </div>
                    <div class="panel panel-body">
                    	<div class="row">
                        	<div class="col-sm-6">
                            	<center><h5>Grafica de alumnos reprobados por materia</h5>
                            	<div id="carga1"></div>
                            </div>
                            <div class="col-sm-6">
                            	<center><h5>Grafica de alumnos aprobados por materia</h5>
                            	<div id="carga2"></div>
                            </div>
                        </div>
                        <div class="row" align="center">
                            <div class="col-sm-6">
                            	<center><h5>Grafica de los creditos por alumno</h5>
                            	<div id="carga3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function() {
        $('#carga1').load('lineal.php');
		$('#carga2').load('aprobados.php');
		$('#carga3').load('barras.php');
    });
</script>