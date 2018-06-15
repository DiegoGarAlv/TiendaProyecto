<?php 
include("funciones.php");
cabecera();
print'
<form method="post" id="formAnadirFamilia">
	<div class="form-group">
	    <label for="codigo">Código de la familia:</label>
		<input type="text" class="form-control" id="codigo" placeholder="Código" name="codigo">
		<div class="alert alert-danger" id="codval" style="color:Red;display:none">Campo Código Vacío</div>
		<div class="alert alert-danger" id="codval2" style="color:Red;display:none">El código debe ser numérico</div>		
	</div>
	<div class="form-group">
	    <label for="nombre">Nombre de la familia:</label>
		<input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
		<div class="alert alert-danger" id="nomval" style="color:Red;display:none">Campo Nombre Vacío</div>
		<div class="alert alert-danger" id="nomval2" style="color:Red;display:none">El nombre solo puede tener letras</div>
	</div>	
	<button type="submit" name="btnAceptar" class="btn btn-primary">Aceptar</button>
</form>
';
if(isset($_POST['btnAceptar']))
{
	$cod = $_POST['codigo'];
	$nombre = $_POST['nombre'];
	$existe = false;

	$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 

	$selectConsultaExiste = "SELECT cod FROM familia";
	$consultaExiste=mysqli_query($conexion,$selectConsultaExiste)or die("No se ha hecho la select");
	$numFilasExiste=mysqli_num_rows($consultaExiste);

	for ($i = 0; $i <$numFilasExiste ; $i++) {
		$filaExiste=mysqli_fetch_array($consultaExiste);
		if($filaExiste['cod'] == $cod)
		{
			$existe = true;
		}
	}
	
	if($existe)
	{
		print'<div class="alert alert-danger">
		<strong>¡CUIDADO!</strong>La familia ya existe.
		</div>';
	}
	else
	{
		$insertar="INSERT familia (cod,nombre) VALUES ('$cod','$nombre')";
		$consulta=mysqli_query($conexion,$insertar)or die("No se ha insertado");
		print'<div class="alert alert-success">
		<strong>¡LISTO!</strong> Familia registrada.
		</div>';
	}	
}
pie();
 ?>