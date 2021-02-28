<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<?php
     $link = mysqli_connect ('localhost','root','','sbit') or die ("No se logro la conexion");
	 $db = mysqli_select_db ($link,"sbit");
	 //Selecciono el idMaestro
	 $elim="TRUNCATE TABLE Tutorias";
	 mysqli_query($link,$elim);
	 $id="select count(idMaestro) as idma from maestros";
	 $res= mysqli_query($link, $id);
	 $row = mysqli_fetch_assoc($res);
	 $ip= $row['idma'];
	 echo"Profesores".$ip."<br>";
	 //selecciono la Matricula
	 $matricula="select count(matricula) as mat from alumnos";
	 $res2= mysqli_query($link, $matricula);
	 $row2 = mysqli_fetch_assoc($res2);
	 $m= $row2['mat'];
	 echo"Alumnos".$m;
	 //extraer las datos de la tabla alumnos
	 $datos2="select * from Alumnos";
	 $resultado2=mysqli_query($link,$datos2);
	 $r=0;
	 for($i=$m; $i>0; $i--){
		 for($j=1; $j<=$ip; $j++){
			 if($i===0){
				 break;
				}
			 if($j==($ip+1)){
				 break;
			 }else{	
					mysqli_data_seek($resultado2,$r); //mueve el puntero a la fila especificada
					$rows = mysqli_fetch_object($resultado2);
					$dat="insert into Tutorias(idMaestro,matricula)values(".$j.",".$rows->matricula.");";
					$results=mysqli_query($link,$dat);
					$i--;
					$r++;
					if($r==$m){
						$r=0;
					}
			   }
		 }
	 }

?>
<body>
</body>
</html>