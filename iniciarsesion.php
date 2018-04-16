<?php 
include("funciones.php");
cabecera();
session_start();
print'
<form method="post">

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
	
	$usuario = $_POST['usuario'];
	$contraseña = $_POST['contraseña'];

	if($usuario=="")
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
		$select="SELECT * FROM clientes";
		$consulta=mysqli_query($conexion,$select)or die("Fallo en la select");

		$numFilas=mysqli_num_rows($consulta);
		if($numFilas != 0)
		{
			for ($i = 0; $i < $numFilas ; $i++) {
				$fila=mysqli_fetch_array($consulta);
				if($usuario==$fila['usuario'] && $contraseña==$fila['password'])
				{
					$_SESSION['usuario']=$usuario;
					header("Location:index.php");
				}
				else
				{
					print'<div class="alert alert-danger">
	  				<strong>¡CUIDADO!</strong> Usuario y/o Contraseña incorrectos.
					</div>';
				}
			}
		}
	}
	

}	
pie();
 ?>