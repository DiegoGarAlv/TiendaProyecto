<?php 
include("funciones.php");
cabecera();
print'
<form method="post">
	<div class="form-group">
	    <label for="dni">DNI:</label>
	    <input type="text" class="form-control" id="dni" placeholder="DNI" name="dni">
	</div>
	<div class="form-group">
	    <label for="nombre">Nombre:</label>
	    <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
	</div>
	<div class="form-group">
	    <label for="direccion">Dirección:</label>
	    <input type="text" class="form-control" id="direccion" placeholder="Dirección" name="direccion">
	</div>
	<div class="form-group">
	    <label for="usuario">Usuario:</label>
	    <input type="text" class="form-control" id="usuario" placeholder="Usuario" name="usuario">
	</div>
    <div class="form-group">
      	<label for="contraseña">Contraseña:</label>
      	<input type="password" class="form-control" id="contraseña" placeholder="Contraseña" name="contraseña">
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
	$contraseña = $_POST['contraseña'];


	if($dni=="")
	{
		print'<div class="alert alert-danger">
  		<strong>¡CUIDADO!</strong> Campo DNI vacío.
		</div>';
	}

	else if($nombre=="")
	{
		print'<div class="alert alert-danger">
  		<strong>¡CUIDADO!</strong> Campo Nombre vacío.
		</div>';
	}
	else if($direccion=="")
	{
		print'<div class="alert alert-danger">
  		<strong>¡CUIDADO!</strong> Campo Dirección vacío.
		</div>';
	}
	else if($usuario=="")
	{
		print'<div class="alert alert-danger">
  		<strong>¡CUIDADO!</strong> Campo Usuario vacío.
		</div>';
	}
	else if($contraseña=="")
	{
		print'<div class="alert alert-danger">
  		<strong>¡CUIDADO!</strong> Campo Contraseña vacío.
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
		}
	} 
}




pie();
 ?>