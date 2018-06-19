<?php 
include("funciones.php");
session_start();
cabecera();
$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 

$selectfamilia = "SELECT cod,nombre FROM familia";
$consultafamilia=mysqli_query($conexion,$selectfamilia)or die("Fallo en la select");
$numFilasfamilia=mysqli_num_rows($consultafamilia);

print'
<form method="post" id="formModificarFamilia">
    <div class="form-group">
		<label for="familia">Familia:</label>
		<select class="form-control" id="familia" name="familia">
		<option value="0">Selecciona una familia:</option>';
		for ($i = 0; $i <$numFilasfamilia ; $i++) {
			$fila=mysqli_fetch_array($consultafamilia);
			print'<option value="'.$fila['cod'].'">'.$fila['nombre'].'</option>';
		}
		print'
		</select>		
		<div class="alert alert-danger" id="famval" style="color:Red;display:none">Debe Seleccionar una Familia</div>
	</div>
	<div class="form-group">
	    <label for="nombre">Nuevo nombre de la familia:</label>
		<input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
		<div class="alert alert-danger" id="nomval" style="color:Red;display:none">Campo Nombre Vacío</div>
		<div class="alert alert-danger" id="nomval2" style="color:Red;display:none">El nombre solo puede tener letras</div>
	</div>		
    <button type="submit" name="btnModificar" class="btn btn-primary">Modificar</button>    
</form>
';
if(isset($_POST['btnModificar']))
{
	$cod = $_POST['familia'];
	$nombre = $_POST['nombre'];

    $eliminar="UPDATE familia SET `nombre`='".$nombre."' WHERE `cod`='".$cod."'";
    $consultaEliminar=mysqli_query($conexion,$eliminar)or die("No se ha updateado");

    if($consultaEliminar)
    {
        print'<div class="alert alert-success">
        <strong>¡LISTO!</strong> Familia Modificada.
		</div>';
		header("refresh:1; url=principal.php", true, 303);
    } 
}

pie();
?>