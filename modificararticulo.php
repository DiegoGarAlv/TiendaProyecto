<?php 
include("funciones.php");
session_start();
cabecera();
$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 

$selectArticulo = "SELECT cod,nombre FROM producto";
$consultaArticulo=mysqli_query($conexion,$selectArticulo)or die("Fallo en la select");
$numFilasArticulo=mysqli_num_rows($consultaArticulo);

print'
<form method="post" id="formArticulos">
    <div class="form-group">
		<label for="articulo">Artículo:</label>
		<select class="form-control" id="articulo" name="articulo">
		<option value="0">Selecciona un Artículo</option>';
		for ($i = 0; $i <$numFilasArticulo ; $i++) {
			$fila=mysqli_fetch_array($consultaArticulo);
			print'<option value="'.$fila['cod'].'">'.$fila['nombre'].'</option>';
		}
		print'
		</select>		
		<div class="alert alert-danger" id="artval" style="color:Red;display:none">Debe Seleccionar un Artículo</div>
    </div>	
    <button type="submit" name="btnModificar" class="btn btn-primary">Modificar</button>
    <button type="submit" name="btnEliminar" class="btn btn-Danger">Eliminar</button>
</form>
';
if(isset($_POST['btnEliminar']))
{
    $cod = $_POST['articulo'];
    $eliminar="UPDATE producto SET `activo`='no' WHERE `cod`='".$cod."'";
    $consultaEliminar=mysqli_query($conexion,$eliminar)or die("No se ha updateado");

    if($consultaEliminar)
    {
        print'<div class="alert alert-success">
        <strong>¡LISTO!</strong> Artículo Eliminado.
        </div>';
    } 
}

if(isset($_POST['btnModificar']))
{
	$cod = $_POST['articulo'];
    
    $select = "SELECT * FROM producto WHERE cod=".$cod."";
    $consulta=mysqli_query($conexion,$select)or die("Fallo en la select");
    $filaArticulo=mysqli_fetch_array($consulta);

    $selectfamilias="SELECT * FROM familia";
    $consultafamilias=mysqli_query($conexion,$selectfamilias)or die("Fallo en la select");
    $numFilasfamilias=mysqli_num_rows($consultafamilias);

    print'
    <form method="post" id="formModificarArticulos">        
    <input type="hidden" class="form-control" id="codigo" name="codigo" value="'.$filaArticulo['cod'].'">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="'.$filaArticulo['nombre'].'">
            <div class="alert alert-danger" id="nomval" style="color:Red;display:none">Campo Nombre Vacío</div>
            <div class="alert alert-danger" id="nomval2" style="color:Red;display:none">El nombre solo puede tener letras</div>
        </div>
        <div class="form-group">
            <label for="nombreCorto">Nombre Corto:</label>
            <input type="text" class="form-control" id="nombreCorto" name="nombreCorto" value="'.$filaArticulo['nombre_corto'].'">
            <div class="alert alert-danger" id="nomcorval" style="color:Red;display:none">Campo NombreCorto Vacío</div>
            <div class="alert alert-danger" id="nomcorval2" style="color:Red;display:none">El nombre corto debe contener 3 letras</div>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" value="'.$filaArticulo['descripcion'].'">
            <div class="alert alert-danger" id="desval" style="color:Red;display:none">Campo Descripción Vacío</div>
        </div>
        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="text" class="form-control" id="precio" name="precio" value="'.$filaArticulo['PVP'].'">
            <div class="alert alert-danger" id="preval" style="color:Red;display:none">Campo Precio Vacío</div>
            <div class="alert alert-danger" id="preval2" style="color:Red;display:none">El precio debe ser numérico</div>
        </div>
        <div class="form-group">
            <label for="familia">Familia:</label>
            <select class="form-control" id="familia" name="familia">
            <option value="0">Selecciona una familia</option>';
            for ($i = 0; $i <$numFilasfamilias ; $i++) {
                $fila1=mysqli_fetch_array($consultafamilias);
                print'<option value="'.$fila1['cod'].'">'.$fila1['nombre'].'</option>';
            }
            print'
            </select>		
            <div class="alert alert-danger" id="famval" style="color:Red;display:none">Debe Seleccionar una familia</div>
	    </div>	
        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="text" class="form-control" id="stock" name="stock" value="'.$filaArticulo['stock'].'">
            <div class="alert alert-danger" id="stoval" style="color:Red;display:none">Campo Stock Vacío</div>
            <div class="alert alert-danger" id="stoval2" style="color:Red;display:none">El precio debe ser numérico</div>		
        </div>
        <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="text" class="form-control" id="imagen" name="imagen" value="'.$filaArticulo['imagen'].'">
            <div class="alert alert-danger" id="imgval" style="color:Red;display:none">Campo Imagen Vacío</div>
        </div>
        
        <button type="submit" name="btnAceptarModificar" class="btn btn-primary">Aceptar</button>
    </form>
    ';
}
if(isset($_POST['btnAceptarModificar']))
{
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $nombrecorto = $_POST['nombreCorto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $familia = $_POST['familia'];
    $stock = $_POST['stock'];
    $imagen = $_POST['imagen'];        

    $updatear="UPDATE producto SET `nombre`='".$nombre."', `nombre_corto`='".$nombrecorto."', `descripcion`='".$descripcion."', `PVP`='".$precio."', `familia`='".$familia."', `stock`='".$stock."',`imagen`='".$imagen."' WHERE cod='".$codigo."'";
    $consulta2=mysqli_query($conexion,$updatear)or die("No se ha updateado");
    
    if($consulta2)
    {
        print'<div class="alert alert-success">
        <strong>¡LISTO!</strong> Datos Cambiados.
        </div>';
    }        
}
pie();
?>