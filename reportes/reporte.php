<?php 
require_once('../lib/pdf/mpdf.php');
include ('../config.php');
$fecha=$_POST['fecha_factura'];
$sql = "select cantidad,nombre_material,precio,total from factura,materiales where materiales.id_material=factura.id_material and fecha_factura='$fecha'";
$total_compra="SELECT SUM(total) FROM factura where fecha_factura ='$fecha'";
$html='
<body>
<h1> RECICLAJES SANDOVAL S.A </h1>
<img src="../imagenes/logo.png">
<h2>Reporte del dia  '.$fecha.'</h2>
<section class="resultado">
	<table >
    <tr class="titulos"> 	
		<th> Cantidad Kl/Und </th>	
		<th> Material </th>	
		<th> Precio </th>
		<th> Importe </th>	
		</tr>';
$resultado =$conexion->query($sql);
if ($resultado ->num_rows>0) {
		while ($row = $resultado->fetch_array()) {
	
$html .= 'echo <tr class="result">
		<td>'.$row['cantidad'].'</td>
	    <td>'.$row['nombre_material'].'</td>
		<td>$'.$row['precio'].'</td>
	    <td>$'.$row['total'].'</td>
		</tr>';
}
}
	$html .=' </table> 
		</section>';
$resultado =$conexion->query($total_compra);
if ($resultado ->num_rows>0) {
		while ($row = $resultado->fetch_array()) {	
         $total=$row['SUM(total)'];
		}
}
$html.= '<div class="total"><h3> Total Facturado:  $'.$total.'</h3></div>
</body>';
$mpdf= new mPDF('c', 'A4');
$css=file_get_contents('../estilo_reporte.css');
$mpdf->writeHTML($css,1);
$mpdf->writeHTML($html);
$mpdf->Output('reporte.pdf', 'I');
?>