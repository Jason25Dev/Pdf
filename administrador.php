<?php
include ("config.php");
?>
<!DOCTYPE html>
 <html lang="es">
<head>
<title>MI PERFIL</title>
<meta charset="UTF-8">	
	<script src="../js/jquery-3.2.1.min.js"></script>
	<link href="style.css" type="text/css" rel="stylesheet"/>
	</head>
<body>
   <h1>Administrador</h1>
 <header>
  <nav class="menu">
  <ul>
	  <li class="submenu"><a href="registro.php"> Registrar Empleado </a>
  <ul>
  <li><a href="inicio.php" id="letra" > Salir </a></li>
  </ul>
  </li>
  </ul>
	 </nav>
 </header>
	<br>
	<!-- reportes --------------------------------------------------------------------> 
	<section class="Reportes">
        <label for="inicio">Generar Reporte </label>	
		<form action="generar_reporte.php" method="post" autocomplete="on">
			<label for="fecha">Ingrese la fecha del reporte:</label>
			<input type="date" name="fecha_reporte" class="fecha">
			<br>
			<br>
		        <label for="cedula">Ingrese la cedula del empleado:</label>	
		<input type="number" id="cedula" name="cedula" value="Ingrese la cedula del empleado">
			<br>
			<br>
         <label for="variable">Seleccione Tipo Reporte:</label>
		   <?php
		   $sql="select * from variantes_sueldo ORDER BY nombre_variable ";
		   ?>
	   <select name="variante">
		   <?php if ($result = mysqli_query($conexion, $sql)) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<option value=".$row['id_variantes_sueldo'].">".$row['nombre_variable']."</option>";
				mysqli_free_result($resultado); }
			}?>
</select>
			<br>
			<br>
			<label for="horas">Ingrese la Cantidad de Horas </label>	
			<input type="number" id="horas" name="horas" value="Ingrese Horas">
			<br>
			<br>
			<input type="submit" value="Reportar" id="submit">
		</form>
	</section>
	<!--fin reportes -----------------------------------------------------------------> 
	<br>
	<!-- desprendible -----------------------------------------------------------------> 
	<section class="Desprendible">
		<label for="inicio">Desprendible Nomina </label>	
		<form action="generar_desprendible.php" method="post">
			<label for="fecha_inicial">Ingrese la fecha inicial </label>	
			<input type="date" name="fecha_inicio" class="fecha">
			<label for="fecha_fin">Ingrese la fecha final </label>	
			<input type="date" name="fecha_fin"  class="fecha">
			<br>
			<br>
			<label for="inicio">Ingrese la Cedula del Empleado </label>	
	   		<input type="number" name="cc" id="cedula">
			<br>
			<br>
			<input type="submit" value="Generar Desprendible" id="submit">
		</form>
	</section>
	<script src="../js/jquery-1.12.4.min.js"></script>
 <script src="/js/menu.js"> </script>
 </body>
 </html>