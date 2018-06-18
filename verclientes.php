<?php 
include("funciones.php");
cabecera();
session_start();
print'<table class="table table-striped">
			    <thead>
			      <tr>			        
			        <th>Nombre del cliente</th>
			        <th>Dirección</th>
			        <th>DNI</th>
			      </tr>
			    </thead>
			    <tbody>';
				$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 
				if($_SESSION['usuario']=="admin")
				{
					$select="SELECT * FROM clientes";
				}				
				$consulta=mysqli_query($conexion,$select)or die("Fallo en la select");
				$numFilas=mysqli_num_rows($consulta);
				
				for ($i = 0; $i < $numFilas; $i++) 
				{
					$fila=mysqli_fetch_array($consulta);				
					print'<tr>			        
			        <th>'.$fila['nombre'].'</th>
			        <th>'.$fila['direccion'].'</th>
			        <th>'.$fila['dni'].'</th>
			      	</tr>';
				}
				print '</tbody>
  				</table>

					<button id="generarListadoClientes" name="generarListadoClientes" class="btn btn-danger">Generar PDF</button>
			    ';

pie();
?>