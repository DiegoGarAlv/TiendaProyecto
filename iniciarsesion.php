<?php
ob_start();
include("funciones.php");
cabecera();
session_start();
print'
<form method="post" id="form">
	<div class="form-group">
	    <label for="usuario">Usuario:</label>
		<input type="text" class="form-control" id="usuario" placeholder="Usuario" name="usuario">
		<div class="alert alert-danger" id="usrval" style="color:Red;display:none">Campo Usuario Vacío</div>
	</div>
    <div class="form-group">
      	<label for="contrasena">Contraseña:</label>
		<input type="password" class="form-control" id="contrasena" placeholder="Contraseña" name="contrasena">
		<div class="alert alert-danger" id="pasval" style="color:Red;display:none">Campo Contraseña Vacío</div>  
    </div>    
	<button type="submit" name="btnAceptar" class="btn btn-primary">Aceptar</button>
</form>';
if(isset($_POST['btnAceptar']))
{	
	$usuario = $_POST['usuario'];
	$contrasena = $_POST['contrasena'];

	// if($usuario=="")
	// {
	// 	print'<div class="alert alert-danger">
  	// 	<strong>¡CUIDADO!</strong> Campo Usuario vacío.
	// 	</div>';
	// }
	// else if($contrasena=="")
	// {
	// 	print'<div class="alert alert-danger">
  	// 	<strong>¡CUIDADO!</strong> Campo Contraseña vacío.
	// 	</div>';
	// }
	// else
	if($usuario!="" && $usuario!="")
	{
		$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 
		$select="SELECT * FROM clientes WHERE usuario = '$usuario' AND password = '$contrasena'";
		$consulta=mysqli_query($conexion,$select)or die("Fallo en la select");
		$numFilas=mysqli_num_rows($consulta);
		if($numFilas != 0)
		{
			$_SESSION['usuario']=$usuario;
			header('Location: principal.php');							
		}
		else
		{
			print'<div class="alert alert-danger">
					<strong>¡CUIDADO!</strong> Usuario y/o Contraseña incorrectos.
					</div>';
		}
	}
}	
pie();
 ?>