<?php 
include("funciones.php");
cabecera();
session_start();

$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 

$selectFamilias = "SELECT * FROM familia";
$consultaFamilias=mysqli_query($conexion,$selectFamilias)or die("Fallo en la select");
$numFilasFamilias=mysqli_num_rows($consultaFamilias);

print'
<div class="row">
    <form method="post" id="formfamilia">
        <div class="form-group">
            <label for="familia">Familia:</label>
            <select class="form-control" id="familia" name="familia">
            <option value="0">Selecciona una Familia</option>';
            for ($i = 0; $i <$numFilasFamilias ; $i++) {
                $fila=mysqli_fetch_array($consultaFamilias);
                print'<option value="'.$fila['cod'].'">'.$fila['nombre'].'</option>';
            }
            print'
            </select>		
            <div class="alert alert-danger" id="artval" style="color:Red;display:none">Debe Seleccionar una Familia</div>
        </div>	
        <button type="submit" name="btnListar" class="btn btn-primary">Listar</button>    
    </form>
</div>
';
if(isset($_POST['btnListar']))
{
    $familia=$_POST['familia'];

    if($familia == 0)
    {
        $selectproductos = "SELECT cod, nombre, descripcion, PVP FROM producto";        
    }
    else
    {
        $selectproductos = "SELECT cod, nombre, descripcion, PVP FROM producto WHERE familia = ".$familia."";
    }
print'
<table class="table table-striped">
			    <thead>
			      <tr>			        
			        <th>Código del producto</th>
			        <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>                    
			      </tr>
			    </thead>
			    <tbody>';								
				$consulta=mysqli_query($conexion,$selectproductos)or die("Fallo en la select");
				$numFilas=mysqli_num_rows($consulta);
				
				for ($i = 0; $i < $numFilas; $i++) 
				{
					$fila=mysqli_fetch_array($consulta);				
					print'<tr>			        
			        <th>'.$fila['cod'].'</th>
			        <th>'.$fila['nombre'].'</th>
                    <th>'.$fila['descripcion'].'</th>
                    <th>'.$fila['PVP'].'</th>
			      	</tr>';
				}
				print '</tbody>
  				</table>

				<button id="generarListadoProductos" name="generarListadoProductos" class="btn btn-danger">Generar PDF</button>
                ';
}                

pie();
?>