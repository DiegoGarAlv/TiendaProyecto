<?php 
include("funciones.php");
cabecera();
print'
<form method="post">
	<div class="form-group">
	    <label for="codigo">Código del producto:</label>
	    <input type="text" class="form-control" id="codigo" placeholder="Código" name="codigo">
	</div>
	<div class="form-group">
	    <label for="nombre">Nombre:</label>
	    <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
	</div>
	<div class="form-group">
	    <label for="nombreCorto">Nombre Corto:</label>
	    <input type="text" class="form-control" id="nombreCorto" placeholder="Nombre Corto" name="nombreCorto">
	</div>
	<div class="form-group">
	    <label for="descripcion">Descripción:</label>
	    <input type="text" class="form-control" id="descripcion" placeholder="Descripción" name="descripcion">
	</div>
    <div class="form-group">
      	<label for="precio">Precio:</label>
      	<input type="text" class="form-control" id="precio" placeholder="Precio" name="precio">
    </div>
    <div class="form-group">
      	<label for="familia">Familia:</label>
      	<input type="text" class="form-control" id="familia" placeholder="(1->Escritorios, 2->Sillas)" name="familia">
    </div>
    <div class="form-group">
      	<label for="stock">Stock:</label>
      	<input type="text" class="form-control" id="stock" placeholder="Stock" name="stock">
    </div>
    <div class="form-group">
      	<label for="imagen">Imagen:</label>
      	<input type="text" class="form-control" id="imagen" placeholder="NombreDeLaImagen.jpg" name="imagen">
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
	$imagen = $_POST['imagen'];


	if($cod=="")
	{
		print'<div class="alert alert-danger">
  		<strong>¡CUIDADO!</strong> Campo Código vacío.
		</div>';
	}

	else if($nombre=="")
	{
		print'<div class="alert alert-danger">
  		<strong>¡CUIDADO!</strong> Campo Nombre vacío.
		</div>';
	}
	else if($nombreCorto=="")
	{
		print'<div class="alert alert-danger">
  		<strong>¡CUIDADO!</strong> Campo Nombre Corto vacío.
		</div>';
	}
	else if($descripcion=="")
	{
		print'<div class="alert alert-danger">
  		<strong>¡CUIDADO!</strong> Campo Descripción vacío.
		</div>';
	}
	else if($precio=="")
	{
		print'<div class="alert alert-danger">
  		<strong>¡CUIDADO!</strong> Campo Precio vacío.
		</div>';
	}
	else if($familia=="")
	{
		print'<div class="alert alert-danger">
  		<strong>¡CUIDADO!</strong> Campo Familia vacío.
		</div>';
	}
	else if($stock=="")
	{
		print'<div class="alert alert-danger">
  		<strong>¡CUIDADO!</strong> Campo Stock vacío.
		</div>';
	}
	else if($imagen=="")
	{
		print'<div class="alert alert-danger">
  		<strong>¡CUIDADO!</strong> Campo Imagen vacío.
		</div>';
	}

	else
	{
		$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 
		$insertar="INSERT producto (cod,nombre,nombre_corto,descripcion,PVP,familia,stock,imagen) VALUES ('$cod','$nombre','$nombreCorto','$descripcion','$precio','$familia','$stock','$imagen')";
		$consulta=mysqli_query($conexion,$insertar)or die("No se ha insertado");
		if($consulta)
		{
			print'<div class="alert alert-success">
	  		<strong>¡LISTO!</strong> Producto registrado.
			</div>';
		}
	} 
}




pie();
 ?>