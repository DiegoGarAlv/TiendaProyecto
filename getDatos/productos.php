<?php
$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 
header('Content-type: application/json; charset=utf-8');
$select="SELECT p.cod codigo, p.nombre nombre, p.nombre_corto corto, p.PVP precio, f.nombre familia FROM producto p, familia f WHERE f.cod = p.familia ORDER BY familia";
				
$consulta=mysqli_query($conexion,$select);

$productos=array();

while ($fila=$consulta->fetch_assoc()) 
	{
		$productos[]= $fila;
	}

$oJSON = json_encode($productos);
echo $oJSON;
?>