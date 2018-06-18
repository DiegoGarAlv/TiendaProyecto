<?php
$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 
header('Content-type: application/json; charset=utf-8');
$select="SELECT c.nombre nombre, p.num_pedido pedido, p.fecha fecha, p.total_pedido total FROM pedidos p, clientes c WHERE c.dni = p.dni";
				
$consulta=mysqli_query($conexion,$select);

$pedidos=array();

while ($fila=$consulta->fetch_assoc()) 
	{
		$pedidos[]= $fila;
	}

$oJSON = json_encode($pedidos);
echo $oJSON;
?>