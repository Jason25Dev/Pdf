<?php
include ('config.php');
	  ?>
<html lang="es">
<head>
<title>MI PERFIL</title>
	<meta charset="UTF-8">	
	<link href="style.css" type="text/css" rel="stylesheet"/>
<script href="jquery-3.2.1.min.js"></script>
</head>
<body>
  <h1>Administrador</h1>
 <header>
  <nav class="menu">
  <ul>
  <li class="submenu"><a href="administrador.php"> Inicio</a>
  </li>
  </ul>
	 </nav>
 </header>
	<br>
<section class="Registro">
	 <label for="inicio">Registrar Empleado</label>
		 <br>
		 <br>
   <form action="nuevo_usuario.php" method="post" autocomplete="off" name="form_registro">
	   	 <label for="cedula">Cedula Empleado:</label>
	   <input type="number" name="cedula" id="cedula" required/>
	   <br>
	   <br>
	   	 <label for="nombre">Nombre Empleado:</label>
	   <input type="text" name="nombre" id="nombre" required/>
	   <br>
	   <br>
	   <label for="apellido">Apellido Empleado:</label>
		<input type="text"  name="apellido"  id="apellido"required/ >
	   <br>
	   <br>
	   <label for="fecha">Fecha Ingreso:</label>
	   <input type="date" name="fecha_ingreso" id="fecha">
	   <br>
	   <br>
	   <label for="cargos">Cargo:</label>
		   <?php
		   $sql="select * from cargo";
		   ?>
	   <select name="cargo">
		   <?php if ($result = mysqli_query($conexion, $sql)) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<option value=".$row['id_cargo'].">".$row['nombre_cargo']."</option>";
				mysqli_free_result($resultado); }
			}?>
	   </select>
	   <br>
	   <br>
	   <input type="submit" name="register" id="submit" value="Registrar">
	   </form>
       </section>
    </body>
 </html>