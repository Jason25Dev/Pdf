<?php
require_once('lib/pdf/mpdf.php');
include('config.php');
$cc=$_POST['cc'];
$fecha_inicio=$_POST['fecha_inicio'];
$fecha_final=$_POST['fecha_fin'];
$html=' 
<html>
<head>
	</head>
<body>
<h1> Desprendible de Pago Nomina </h1>
	<section>
 <div>
		<table name="informacion personal">
		<tr> 	
		<th> Cedula </th>	
		<th> Empleado </th>	
		<th> Cargo </th>
		<th> Salario Basico</th>
		<th> Fecha Reporte</th>
	
		</tr>';
             $sql="SELECT empleado.id_empleado,nombre,apellido,nombre_cargo,sueldo FROM empleado,cargo WHERE empleado.id_cargo=cargo.id_cargo AND id_empleado='$cc'";
               if ($resultado = mysqli_query($conexion, $sql)) {
		while ($row = mysqli_fetch_assoc($resultado)) {
		
	    $html .='echo <tr>
	    <td>'.$row['id_empleado'].'</td>
	    <td>'.$row['nombre']."  ".$row['apellido'].'</td>
	    <td>'.$row['nombre_cargo'].'</td>
		<td>'.$row['sueldo'].'</td>
		<td>'.$fecha_inicio."  al  ".$fecha_final.'</td>
		</tr>';
			$sueldo=$row['sueldo'];
			   }
			   }
     $html .='</table>
		</div>
		<br>
		<div id="deducciones">
		<h3>Devengado</h3>	
		<table>
		<tr class="titulos"> 	
		<th> Concepto </th>	
		<th> Horas </th>	
		<th> Valor </th>
		<th> Total </th>
		</tr>';
		 
			$total_devengado=0;
			for($i=1;$i<=6;$i++){ 
             $sql="SELECT nombre_variable, SUM(horas),valor,SUM(horas*valor)As total FROM variantes_sueldo,variantes_empleado,empleado WHERE variantes_empleado.id_variantes_sueldo=variantes_sueldo.id_variantes_sueldo AND variantes_empleado.id_empleado=empleado.id_empleado AND variantes_empleado.id_empleado='$cc' AND variantes_empleado.id_variantes_sueldo='$i' and fecha_reporte BETWEEN '$fecha_inicio' AND '$fecha_final'";
               if ($resultado = mysqli_query($conexion, $sql)) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$acomulado=$row['total'];
			$total_devengado=$total_devengado+$acomulado;
			$html .='echo <tr>
		<td>'.$row['nombre_variable'].'</td>
	    <td>'.$row['SUM(horas)'].'</td>
		<td>'.$row['valor'].'</td>
		<td>'.$row['total'].'</td>
		</tr>';
			   }
			   }
				}
       $html .= ' </table>
			<h2> Total Devengado:  $'.$total_devengado.' </h2>
		</div>
		<br>
		<br>
		<div id="descuentos">
		<h3>Descuentos</h3>	
		<table name="devengado">
		<tr class="titulos"> 	
		<th> Concepto </th>	
		<th> Valor </th>	
		</tr>';
             $salud=$sueldo*0.04;
			 $pension=$sueldo*0.04;
             $fondo=$sueldo*0.1;
				$total_descuento=$salud+$pension+$fondo;
		$html .= 'echo <tr>
		<td> Aporte a Salud </td>
		<td>'.$salud.'</td>
		</tr>
		<tr>
		<td> Aporte a Pension </td>
		<td>'.$pension.'</td>
		</tr>
		<tr>
		<td> Fondo Empleados </td>
		<td>'.$fondo.'</td>
		</tr> 
		</table>
		<h2> Total Descuento:  $'.$total_descuento.' </h2>
		</div>
		<div id="result">';
	        $sueldo=($sueldo-$total_descuento)+$total_devengado;
		$html .=' <h2> Neto Pagado: $'.$sueldo.'  </h2>
		</div>
	 </section>
	</body>';
$mpdf= new mPDF('c', 'A4');
$css=file_get_contents('estilo_reporte.css');
$mpdf->writeHTML($css,1);
$mpdf->writeHTML($html);
$mpdf->Output('reporte.pdf', 'I');
?>
