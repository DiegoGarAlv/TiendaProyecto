<?php 
session_start();

function mostrarArticulos(){
	$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 
    mysqli_set_charset($conexion,"utf8");
	$select="SELECT * FROM producto";
    $selectEscritorios="SELECT * FROM producto WHERE familia=1";
    $selectSillas="SELECT * FROM producto WHERE familia=2";
    $consulta=mysqli_query($conexion,$select)or die("Fallo en la select");
    $numFilas=mysqli_num_rows($consulta); 

   

    print'
        <link rel="stylesheet" type="text/css" href="style.css">
            <div class="row">
                <div class="jumbotron" id="banner">                 
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="btn-group col-lg-4">
                <form method="post">
                    <button type="submit" name="btnTodos" class="btn btn-primary">Todos</button>
                    <button type="submit" name="btnEscritorios" class="btn btn-primary">Escritorios</button>
                    <button type="submit" name="btnSillas" class="btn btn-primary">Sillas</button>
                </form>
                </div>
                <div class="col-lg-4"></div>
            </div>
            
            <div class="row">';

    if(isset($_POST['btnTodos']))
    {
        $consulta=mysqli_query($conexion,$select)or die("Fallo en la select");
        $numFilas=mysqli_num_rows($consulta);        
    }
    else if(isset($_POST['btnEscritorios']))
    {
        $consulta=mysqli_query($conexion,$selectEscritorios)or die("Fallo en la select");
        $numFilas=mysqli_num_rows($consulta);        
    }
    else if(isset($_POST['btnSillas']))
    {
        $consulta=mysqli_query($conexion,$selectSillas)or die("Fallo en la select");
        $numFilas=mysqli_num_rows($consulta);        
    }

	for ($i = 0; $i <$numFilas ; $i++) {
		$fila=mysqli_fetch_array($consulta);

		print'

            
    			<div class="col-lg-4">
        			<div class="thumbnail">
          				<img src="imagenes/'.$fila['imagen'].'" alt="imagen artículo">
          				<div class="caption">
            				<h3>'.$fila['nombre'].'</h3>
            					<p>'.$fila['descripcion'].'</p>
            					<p>'.$fila['PVP'].'</p>';
            				if($_SESSION['usuario']==null || $_SESSION['usuario']=="admin")	{
            					echo '<p><a href="#" class="btn btn-primary" role="button" disabled>Comprar</a></p>';	
            				}
            				else
            				{
            					echo '<p><a href="cesta.php?producto='.$fila['nombre'].'&precio='.$fila['PVP'].'&usuario='.$_SESSION['usuario'].'" class="btn btn-primary" role="button">Comprar</a></p>';
            				}
            			
            			print	'</div>
            		</div>
            	</div>';
            				
		
	}
    print '</div>';
}
?>