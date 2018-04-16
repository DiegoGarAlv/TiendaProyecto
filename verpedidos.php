<?php 
include("funciones.php");
cabecera();
session_start();
print'<table class="table table-striped">
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
				if($_SESSION['usuario']=="admin")
				{
					$select="SELECT * FROM pedidos";
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
  				</table>


			    ';

pie();
?>