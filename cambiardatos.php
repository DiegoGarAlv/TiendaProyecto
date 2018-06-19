<?php 
include("funciones.php");
session_start();
cabecera();
$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 
$select="SELECT * FROM clientes WHERE usuario='".$_SESSION['usuario']."'";
$consulta=mysqli_query($conexion,$select)or die("Fallo en la select");
$fila=mysqli_fetch_array($consulta);

print'
<form method="post" id="formDatos">
	<div class="form-group">
	    <label for="nombre">Nombre:</label>
		<input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" value="'.$fila['nombre'].'">
		<div class="alert alert-danger" id="nomval" style="color:Red;display:none">Campo Nombre Vacío</div>
        <div class="alert alert-danger" id="nomval2" style="color:Red;display:none">El nombre solo puede tener letras</div>
	</div>
	<div class="form-group">
	    <label for="direccion">Dirección:</label>
	    <input type="text" class="form-control" id="direccion" placeholder="Dirección" name="direccion" value="'.$fila['direccion'].'">
		<div class="alert alert-danger" id="dirval" style="color:Red;display:none">Campo Dirección Vacío</div>        
	</div>
	<div class="form-group">
	    <label for="usuario">Usuario:</label>
	    <input type="text" class="form-control" id="usuario" placeholder="Usuario" name="usuario" value="'.$fila['usuario'].'" disabled>
	</div>
    <div class="form-group">
      	<label for="contraseña">Contraseña:</label>
		<input type="password" class="form-control" id="contrasena" placeholder="Contraseña" name="contrasena" value="'.$fila['password'].'">
		<div class="alert alert-danger" id="pasval" style="color:Red;display:none">Campo Contraseña Vacío</div>
		<div class="alert alert-danger" id="pasval2" style="color:Red;display:none">La contraseña debe tener entre 4 y 8 caracteres y al menos un número</div>  
    </div>
    
	<button type="submit" name="btnAceptar" class="btn btn-primary">Aceptar</button>
</form>
';
if(isset($_POST['btnAceptar']))
{
	$nombre = $_POST['nombre'];
	$direccion = $_POST['direccion'];
	$usuario = $_POST['usuario'];
	$contraseña = $_POST['contrasena'];

	
	$updatear="UPDATE clientes SET `nombre`='".$nombre."', `direccion`='".$direccion."', `password`='".$contraseña."' WHERE usuario='".$_SESSION['usuario']."'";
	$consulta2=mysqli_query($conexion,$updatear)or die("No se ha updateado");
	if($consulta2)
	{
		print'<div class="alert alert-success">
		<strong>¡LISTO!</strong> Datos Cambiados.
		</div>';
	}

	header("refresh:2; url=principal.php", true, 303);	
}
pie();
 ?>