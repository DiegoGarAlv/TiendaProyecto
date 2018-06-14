<?php 
include("funciones.php");
cabecera();
session_start();

echo '<div id="contenido">';
if (!isset($_GET["borrar"]))
{
if (isset($_GET["precio"]) && isset($_GET["producto"]))
{
if (isset($_SESSION["producto"]))
{
	$dimension=COUNT($_SESSION["producto"]);
	if (!in_array($_GET["producto"],$_SESSION["producto"]))
	{
		$_SESSION["contador"]=$_SESSION["contador"]+1;
		$_SESSION["producto"][]=$_GET["producto"];
		$_SESSION["precio"][]=$_GET["precio"];
		$_SESSION["unidades"][]=1;
		$_SESSION["total"]=$_SESSION["total"]+$_GET["precio"];
	}
	else
	{
		$indice=array_search($_GET["producto"],$_SESSION["producto"]);
		$_SESSION["unidades"][$indice]=$_SESSION["unidades"][$indice]+1;
		$_SESSION["total"]=$_SESSION["total"]+$_GET["precio"];
	}
}
else
{$_SESSION["contador"]=1;
$_SESSION["producto"][0]=$_GET["producto"];
$_SESSION["precio"][0]=$_GET["precio"];
$_SESSION["unidades"][0]=1;
$_SESSION["total"]=$_GET["precio"];}
}
echo "</div>";
}
else
{
	$borrarindice=$_GET["valor"];
	$_SESSION["total"]=$_SESSION["total"]-$_SESSION["precio"][$borrarindice]*$_SESSION["unidades"][$borrarindice];
	$_SESSION["contador"]=$_SESSION["contador"]-1;
	if ($_SESSION["contador"]==0)
	{
		unset($_SESSION["precio"]);
		unset($_SESSION["producto"]);
		unset($_SESSION["unidades"]);
		unset($_SESSION["total"]);
		unset($_SESSION["contador"]);
	}
	else
	{unset($_SESSION["precio"][$borrarindice]);
	unset($_SESSION["producto"][$borrarindice]);
	unset($_SESSION["unidades"][$borrarindice]);
	}
	

}
mostrar();

pie();


function mostrar(){

      if (isset($_SESSION["producto"]))
		{
			$productos=$_SESSION["producto"];
			$precios=$_SESSION["precio"];
			$unidades=$_SESSION["unidades"];
			$dimension=COUNT($productos);
			print'<table class="table table-striped">
			    <thead>
			      <tr>
			        <th>Nombre artículo</th>
			        <th>Unidades</th>
			        <th>Precio</th>
			        <th>Subtotal</th>
			      </tr>
			    </thead>
			    <tbody>';
			foreach ($productos as $indice=>$valor)
				{$mostrar1="<tr><th>".$valor."</td><th>".$unidades[$indice];
				 $mostrar1.="</th><th>".$precios[$indice]."</th>"."<th>".$unidades[$indice]*$precios[$indice];
				 $mostrar1.="<th width=20><a href=cesta.php?borrar=S&valor=$indice>"."<span class='glyphicon glyphicon-trash'></span></a></th></tr>";
				 echo $mostrar1;
				}	
				print'<tr>
      				<th colspan=3 align="center">TOTAL</td>
      				<th>"'.$_SESSION['total'].'"</th>
    				</tr>';
			print '</tbody>
  				</table>
  				<form action="cesta.php" method="post">
  					<button type="submit" name="btnAceptar" class="btn btn-success">Comprar</button>
  				</form>';
  			if(isset($_POST['btnAceptar']))
			{
				$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 
				$select="SELECT dni FROM clientes WHERE usuario='".$_SESSION['usuario']."'";
				$consulta=mysqli_query($conexion,$select)or die("Fallo en la select");
				$resultadoDni=mysqli_fetch_assoc($consulta);
				$dni=$resultadoDni['dni'];
				
				$fecha=@date('Y-m-d');	
				$total=$_SESSION['total'];

				$insertar="INSERT INTO pedidos (num_pedido,dni,fecha,total_pedido) VALUES ('','$dni','$fecha','$total')";
				$consulta2=mysqli_query($conexion,$insertar)or die("No se ha insertado");

				if($consulta2)
				{
					$maximo="SELECT max(num_pedido) AS maximo FROM pedidos";
					$consulta3=mysqli_query($conexion,$maximo)or die("Fallo en la select");	
					$resultadomax=mysqli_fetch_assoc($consulta3);	

					for ($i = 0; $i < count($_SESSION['producto']) ; $i++) 
					{
						$codigo="SELECT cod FROM producto WHERE nombre='".$_SESSION['producto'][$i]."'";
						$consultacodigo=mysqli_query($conexion,$codigo)or die("Fallo en el codigo");	
						$resultadocodigo=mysqli_fetch_assoc($consultacodigo);

						$insertarLineas="INSERT INTO lineas (num_pedido,num_linea,producto,unidades) VALUES (".$resultadomax['maximo'].",".($i+1).",'".$resultadocodigo['cod']."',".$_SESSION['unidades'][$i].")";
						$consulta4=mysqli_query($conexion,$insertarLineas);
						// or die("PEDIDO INSERTADO-Fallo línea")
					}

					print'<div class="alert alert-success">
			  		<strong>¡LISTO!</strong> Pedido realizado.
					</div>';

					unset($_SESSION["precio"]);
					unset($_SESSION["producto"]);
					unset($_SESSION["unidades"]);
					unset($_SESSION["total"]);
					unset($_SESSION["contador"]);

					header("refresh:2; url=index.php", true, 303);	
				}

			}
  			
		}
		else
		{
			print '<div class="alert alert-info">
  					<strong>CESTA VACÍA</strong>
				</div>';
		}
}		
   
?>
