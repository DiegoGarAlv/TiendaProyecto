<?php 
include("funciones.php");
cabecera();
session_start();
if($_SESSION['usuario']=="admin")
{
print'
	<div class="row">
		<div class="col-lg-3"></div>
		<div class="col-lg-6">
			<form method="post" id="formFechas">
			<div class="form-group col-lg-6">			
				<label for="fechaDesde">Fecha desde:</label>				
				<input type="date" class="form-control" id="fechaDesde" name="fechaDesde">
			</div>
			<div class="form-group col-lg-6">					
				<label for="fechaDesde">Fecha desde:</label>				
				<input type="date" class="form-control" id="fechaHasta" name="fechaHasta">
			</div>
			<div class="col-lg-6">
				<button type="submit" name="btnFechas" class="btn btn-primary">Buscar</button>
				<button type="submit" name="btnTodos" class="btn btn-primary">Todos</button>			
			</div>
			</form>
		</div>
		<div class="col-lg-3"></div>
	</div>';
}
print'
<table class="table table-striped">
			    <thead>
			      <tr>
			        <th>Número de pedido</th>
			        <th>Nombre del cliente</th>
			        <th>Fecha</th>
			        <th>Total del pedido</th>
			      </tr>
			    </thead>
				<tbody>';

				$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 
								
				if(($_SESSION['usuario']=="admin" && !isset($_POST['btnFechas'])) || ($_SESSION['usuario']=="admin" && isset($_POST['btnTodos'])))
				{
					$select="SELECT * FROM pedidos";
				}
				else if($_SESSION['usuario']=="admin" && isset($_POST['btnFechas']))
				{
					$fechaDesde=$_POST["fechaDesde"];
					$fechaHasta=$_POST["fechaHasta"];
					$select="SELECT * FROM pedidos WHERE fecha BETWEEN '".$fechaDesde."' AND '".$fechaHasta."'";				
				}
				else
				{
					$select3="SELECT dni FROM clientes WHERE usuario='".$_SESSION['usuario']."'";
					$consulta3=mysqli_query($conexion,$select3)or die("Fallo en la select3");
					$fila3=mysqli_fetch_array($consulta3);	
					$select="SELECT * FROM pedidos WHERE dni='".$fila3['dni']."'";
				}
				$consulta=mysqli_query($conexion,$select)or die("Fallo en la select");
				$numFilas=mysqli_num_rows($consulta);
				
				for ($i = 0; $i < $numFilas; $i++) 
				{
					$fila=mysqli_fetch_array($consulta);
					$select2="SELECT nombre FROM clientes WHERE dni='".$fila['dni']."'";
					$consulta2=mysqli_query($conexion,$select2)or die("Fallo en la select2");
					$fila2=mysqli_fetch_array($consulta2);

					print'<tr>
			        <th>'.$fila['num_pedido'].'</th>
			        <th>'.$fila2['nombre'].'</th>
			        <th>'.$fila['fecha'].'</th>
			        <th>'.$fila['total_pedido'].'</th>
			      	</tr>';

				}
print '</tbody>
</table>';
if($_SESSION['usuario']=="admin")
{
	print'<button id="generarListadoPedidos" name="generarListadoPedidos" class="btn btn-danger">Generar PDF</button>';
}
else{
	print'<button id="generarListadoPedidosUser" name="generarListadoPedidosUser" class="btn btn-danger">Generar PDF</button>';
}
pie();
?>