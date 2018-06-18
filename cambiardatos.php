<?php 
include("funciones.php");
session_start();
cabecera();
$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 
$select="SELECT * FROM clientes WHERE usuario='".$_SESSION['usuario']."'";
$consulta=mysqli_query($conexion,$select)or die("Fallo en la select");
$fila=mysqli_fetch_array($consulta);

print'
<form method="post">
	<div class="form-group">
	    <label for="nombre">Nombre:</label>
	    <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" value="'.$fila['nombre'].'">
	</div>
	<div class="form-group">
	    <label for="direccion">Dirección:</label>
	    <input type="text" class="form-control" id="direccion" placeholder="Dirección" name="direccion" value="'.$fila['direccion'].'">
	</div>
	<div class="form-group">
	    <label for="usuario">Usuario:</label>
	    <input type="text" class="form-control" id="usuario" placeholder="Usuario" name="usuario" value="'.$fila['usuario'].'">
	</div>
    <div class="form-group">
      	<label for="contraseña">Contraseña:</label>
      	<input type="password" class="form-control" id="contraseña" placeholder="Contraseña" name="contraseña" value="'.$fila['password'].'">
    </div>
    
	<button type="submit" name="btnAceptar" class="btn btn-primary">Aceptar</button>
</form>
';
if(isset($_POST['btnAceptar']))
{
	$nombre = $_POST['nombre'];
	$direccion = $_POST['direccion'];
	$usuario = $_POST['usuario'];
	$contraseña = $_POST['contraseña'];

	if($nombre=="")
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
		
		$updatear="UPDATE clientes SET `nombre`='".$nombre."', `direccion`='".$direccion."', `usuario`='".$usuario."', `password`='".$contraseña."' WHERE usuario='".$_SESSION['usuario']."'";
		$consulta2=mysqli_query($conexion,$updatear)or die("No se ha updateado");
		if($consulta2)
		{
			print'<div class="alert alert-success">
	  		<strong>¡LISTO!</strong> Datos Cambiados.
			</div>';
		}
	} 
}
pie();
 ?>