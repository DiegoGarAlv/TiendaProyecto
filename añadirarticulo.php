<?php 
include("funciones.php");
cabecera();

$conexion1=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión");
$select1="SELECT * FROM familia";
$consulta1=mysqli_query($conexion1,$select1)or die("Fallo en la select");
$numFilas1=mysqli_num_rows($consulta1);

print'
<form method="post" enctype="multipart/form-data" id="formAnadirArticulos">
	<div class="form-group">
	    <label for="codigo">Código del producto:</label>
		<input type="text" class="form-control" id="codigo" placeholder="Código" name="codigo">
		<div class="alert alert-danger" id="codval" style="color:Red;display:none">Campo Código Vacío</div>
		<div class="alert alert-danger" id="codval2" style="color:Red;display:none">El código debe ser numérico</div>		
	</div>
	<div class="form-group">
	    <label for="nombre">Nombre:</label>
		<input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
		<div class="alert alert-danger" id="nomval" style="color:Red;display:none">Campo Nombre Vacío</div>
		<div class="alert alert-danger" id="nomval2" style="color:Red;display:none">El nombre solo puede tener letras</div>
	</div>
	<div class="form-group">
	    <label for="nombreCorto">Nombre Corto:</label>
		<input type="text" class="form-control" id="nombreCorto" placeholder="Nombre Corto" name="nombreCorto">
		<div class="alert alert-danger" id="nomcorval" style="color:Red;display:none">Campo NombreCorto Vacío</div>
		<div class="alert alert-danger" id="nomcorval2" style="color:Red;display:none">El nombre corto debe contener 3 letras</div>
	</div>
	<div class="form-group">
	    <label for="descripcion">Descripción:</label>
		<input type="text" class="form-control" id="descripcion" placeholder="Descripción" name="descripcion">
		<div class="alert alert-danger" id="desval" style="color:Red;display:none">Campo Descripción Vacío</div>
	</div>
    <div class="form-group">
      	<label for="precio">Precio:</label>
		<input type="text" class="form-control" id="precio" placeholder="Precio" name="precio">
		<div class="alert alert-danger" id="preval" style="color:Red;display:none">Campo Precio Vacío</div>
		<div class="alert alert-danger" id="preval2" style="color:Red;display:none">El precio debe ser numérico</div>
	</div>


    <div class="form-group">
		<label for="familia">Familia:</label>
		<select class="form-control" id="familia" name="familia">
		<option value="0">Selecciona una familia</option>';
		for ($i = 0; $i <$numFilas1 ; $i++) {
			$fila1=mysqli_fetch_array($consulta1);
			print'<option value="'.$fila1['cod'].'">'.$fila1['nombre'].'</option>';
		}
		print'
		</select>		
		<div class="alert alert-danger" id="famval" style="color:Red;display:none">Debe Seleccionar una familia</div>
	</div>	
    <div class="form-group">
      	<label for="stock">Stock:</label>
		<input type="text" class="form-control" id="stock" placeholder="Stock" name="stock">
		<div class="alert alert-danger" id="stoval" style="color:Red;display:none">Campo Stock Vacío</div>
		<div class="alert alert-danger" id="stoval2" style="color:Red;display:none">El precio debe ser numérico</div>		
    </div>
    <div class="form-group">
      	<label for="uploadfile">Imagen:</label>
		<input type="file" class="form-control" id="uploadfile" size="2097152" name="uploadfile">
		<div class="alert alert-danger" id="imgval" style="color:Red;display:none">Campo Imagen Vacío</div>
    </div>
    
	<button type="submit" name="btnAceptar" class="btn btn-primary">Aceptar</button>
</form>
';
if(isset($_POST['btnAceptar']))
{
	$cod = $_POST['codigo'];
	$nombre = $_POST['nombre'];
	$nombreCorto = $_POST['nombreCorto'];
	$descripcion = $_POST['descripcion'];
	$precio = $_POST['precio'];
	$familia = $_POST['familia'];
	$stock = $_POST['stock'];
	$imagen = $cod.'.jpg';

	//Para guardar la imagen
	
	$dir="imagenes";
	//asegurarse que la transferencia del archivo cargado se ha efectuado correctamente
	
	list($width, $height, $type, $attr) = getimagesize($_FILES['uploadfile']['tmp_name']);

	// asegurarse de que el archivo cargado es un tipo de imagen admitido
	$error = 'El archivo que vd. ha subido no es de un tipo soportado';
	switch ($type)
	{
		case IMAGETYPE_GIF:
			$image = imagecreatefromgif($_FILES['uploadfile']['tmp_name'])or die($error);
			break;
		case IMAGETYPE_JPEG:
			$image = imagecreatefromjpeg($_FILES['uploadfile']['tmp_name'])or die($error);
			break;
		case IMAGETYPE_PNG:
			$image = imagecreatefrompng($_FILES['uploadfile']['tmp_name'])or die($error);
			break;
		default:
			die($error);
	}

	imagejpeg($image, $dir . '/' . $cod  . '.jpg');
	imagedestroy($image);
	//

	$existe = false;

	$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 

	$selectConsultaExiste = "SELECT cod FROM producto";
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
		<strong>¡CUIDADO!</strong> El Producto ya existe.
		</div>';
	}
	else
	{
		$insertar="INSERT producto (cod,nombre,nombre_corto,descripcion,PVP,familia,stock,imagen) VALUES ('$cod','$nombre','$nombreCorto','$descripcion','$precio','$familia','$stock','$imagen')";
		$consulta=mysqli_query($conexion,$insertar)or die("No se ha insertado");
		print'<div class="alert alert-success">
		<strong>¡LISTO!</strong> Producto registrado.
		</div>';
	}	
}
pie();
 ?>