<?php 
include("funciones.php");
cabecera();
print'
<form method="post" id="formRegistro">
	<div class="form-group">
	    <label for="dni">DNI:</label>
		<input type="text" class="form-control" id="dni" placeholder="DNI" name="dni">
		<div class="alert alert-danger" id="dnival" style="color:Red;display:none">Campo DNI Vacío</div>
		<div class="alert alert-danger" id="dnival2" style="color:Red;display:none">El DNI debe ser válido</div>
	</div>
	<div class="form-group">
	    <label for="nombre">Nombre:</label>
		<input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
		<div class="alert alert-danger" id="nomval" style="color:Red;display:none">Campo Nombre Vacío</div>
		<div class="alert alert-danger" id="nomval2" style="color:Red;display:none">El nombre sólo puede contener letras.</div>
	</div>
	<div class="form-group">
	    <label for="direccion">Dirección:</label>
		<input type="text" class="form-control" id="direccion" placeholder="Dirección" name="direccion">
		<div class="alert alert-danger" id="dirval" style="color:Red;display:none">Campo Dirección Vacío</div>
	</div>
	<div class="form-group">
	    <label for="usuario">Usuario:</label>
		<input type="text" class="form-control" id="usuario" placeholder="Usuario" name="usuario">
		<div class="alert alert-danger" id="usuval" style="color:Red;display:none">Campo Precio Vacío</div>
		<div class="alert alert-danger" id="usuval2" style="color:Red;display:none">El nombre de usuario sólo puede contener letras.</div>
	</div>
    <div class="form-group">
      	<label for="contrasena">Contraseña:</label>
		<input type="password" class="form-control" id="contrasena" placeholder="Contraseña" name="contrasena">
		<div class="alert alert-danger" id="pasval" style="color:Red;display:none">Campo Contraseña Vacío</div>
		<div class="alert alert-danger" id="pasval2" style="color:Red;display:none">La contraseña debe tener entre 4 y 8 caracteres y al menos un número</div>  
    </div>
    
	<button type="submit" name="btnAceptar" class="btn btn-primary">Aceptar</button>
</form>
';
if(isset($_POST['btnAceptar']))
{
	$dni = $_POST['dni'];
	$nombre = $_POST['nombre'];
	$direccion = $_POST['direccion'];
	$usuario = $_POST['usuario'];
	$contraseña = $_POST['contrasena'];
	
	$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 
	$selectConsultaExiste = "SELECT dni, usuario FROM clientes";
	$consultaExiste=mysqli_query($conexion,$selectConsultaExiste)or die("No se ha hecho la select");
	$numFilasExiste=mysqli_num_rows($consultaExiste);

	for ($i = 0; $i <$numFilasExiste ; $i++) {
		$filaExiste=mysqli_fetch_array($consultaExiste);
		if($filaExiste['dni'] == $dni||$filaExiste['usuario'] == $usuario)
		{
			$existe = true;
		}
	}
	
	if($existe)
	{
		print'<div class="alert alert-danger">
		<strong>¡CUIDADO!</strong> El Usuario ya existe.
		</div>';
	}
	else
	{
		$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 
		$insertar="INSERT clientes (dni,nombre,direccion,usuario, password) VALUES ('$dni','$nombre','$direccion','$usuario','$contraseña')";
		$consulta=mysqli_query($conexion,$insertar)or die("No se ha insertado");
		if($consulta)
		{
			print'<div class="alert alert-success">
			<strong>¡LISTO!</strong> Usuario registrado.
			</div>';
			header("refresh:1; url=principal.php", true, 303);
		}
	}
	
}




pie();
 ?>