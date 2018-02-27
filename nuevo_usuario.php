 <?php 
 include 'config.php';
$cc=$_POST["cedula"];
$name=$_POST["nombre"];
$apellido=$_POST["apellido"];
$fecha_ingreso=$_POST["fecha_ingreso"];
$dto=$_POST["cargo"];
$cargo=$_POST["cargo"];
$sql="select nombre_departamento from departamento,cargo where departamento.id_departamento=cargo.id_departamento and nombre_cargo='$cargo'";
$resultado =$conexion->query($sql);
if ($resultado ->num_rows>0) {
	while ($registros = $resultado->fetch_array()) {
		$rol= $registros['codigo_rol'];
		}
}
$sql = "INSERT INTO empleado(id_empleado,nombre, apellido, fecha_ingreso, id_cargo) VALUES ('$cc','$name','$apellido','$fecha_ingreso','$cargo')"; 
$result = mysqli_query($conexion,$sql);
echo"<script type=\"text/javascript\">alert('Usuario registrado correctamente'); window.location='administrador.php';</script>";
mysqli_close($conexion);
?>