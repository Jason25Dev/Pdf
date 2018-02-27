<?php
include('config.php');
$cedula=$_POST['cedula'];
$fecha=$_POST['fecha_reporte'];
$tipo=$_POST['variante'];
$horas=$_POST['horas'];
/******* consulta sueldo***/
$sql= "SELECT id_empleado, sueldo FROM empleado,cargo WHERE empleado.id_cargo = cargo.id_cargo AND id_empleado = '$cedula'";
$resultado =$conexion->query($sql);
if ($resultado ->num_rows>0) {
	while ($registros = $resultado->fetch_array()) {
		$sueldo= $registros['sueldo'];
		$valor_hora_ordinaria=$sueldo/192; //192 horas laboradas en el mes 
		if($tipo == '1')//dominical o festivo
		{
		$x=($valor_hora_ordinaria*1.75)*$horas;//porcentaje de la hora dominical
		$total=$x;
		}
		elseif($tipo == '2')//hora extra diurna 
            { 
            $x=($valor_hora_ordinaria*1.25);
		    $total=$x;
		    }
		elseif($tipo == '3')//hora extra nocturna 
            { 
            $x=($valor_hora_ordinaria*1.75);
		    $total=$x;
		    }
		elseif($tipo == '4')//hora extra diurna dominical o festiva 
            { 
            $x=($valor_hora_ordinaria*2);
		    $total=$x;
		    }
		elseif($tipo == '5')//hora extra nocturna dominical o festiva 
            { 
            $x=($valor_hora_ordinaria*2.5);
		    $total=$x;
		    }
		elseif($tipo == '6')//hora nocturna dominical o festiva 
            { 
            $x=($valor_hora_ordinaria*1.1);
		    $total=$x;
		    }
		}
}
$sql="INSERT INTO variantes_empleado(id_variantes_sueldo, id_empleado, fecha_reporte, horas, valor) VALUES ('$tipo','$cedula','$fecha','$horas',$total)";
if($result =$conexion->query($sql)){ 
echo"<script type=\"text/javascript\">alert('Reporte registrado correctamente'); window.location='administrador.php';</script>";
	}
else{
	echo"<script type=\"text/javascript\">alert('No se registro el reporte'); window.location='administrador.php';</script>";
}
mysqli_close($conexion);
?>