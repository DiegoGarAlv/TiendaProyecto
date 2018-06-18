<?php
$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 
header('Content-type: application/json; charset=utf-8');
$select="SELECT * FROM clientes";
				
$consulta=mysqli_query($conexion,$select);

$clientes=array();

while ($fila=$consulta->fetch_assoc()) 
	{
		$clientes[]= $fila;
	}

$oJSON = json_encode($clientes);
echo $oJSON;
?>