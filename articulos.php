<?php 
session_start();

function mostrarArticulos(){
	$conexion=mysqli_connect("localhost","root","","tiendamuebles")or die("Fallo en la conexión"); 
    mysqli_set_charset($conexion,"utf8");
	$select="SELECT * FROM producto";   
    $consulta=mysqli_query($conexion,$select)or die("Fallo en la select");
    $numFilas=mysqli_num_rows($consulta);

    $selectFamilias = "SELECT * FROM familia";
    $consultaFamilias=mysqli_query($conexion,$selectFamilias)or die("Fallo en la select");
    $numFilasFamilias=mysqli_num_rows($consultaFamilias);

    $familias = array();
    $idFamilias = array();

    print'
        <link rel="stylesheet" type="text/css" href="style.css">
            <div class="row">
                <div class="jumbotron" id="banner">                 
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="btn-group col-lg-4">
                <form method="post" id="formFiltroArticulos">
                    <button type="submit" name="btnTodos" class="btn btn-primary">Todos</button>';
                    for ($i = 0; $i <$numFilasFamilias ; $i++) 
                    {
                        $filaFamilia=mysqli_fetch_array($consultaFamilias);
                        echo '<button type="submit" name="btn'.$filaFamilia['nombre'].'" class="btn btn-primary">'.$filaFamilia['nombre'].'</button>';                    
                        $familias[] = "btn".$filaFamilia['nombre']."";
                        $idFamilias[] = $filaFamilia['cod'];
                    }
                    print'
                </form>
                </div>
                <div class="col-lg-4"></div>
            </div>
            
            <div class="row">';
 
    if(isset($_POST['btnTodos']))
    {
        $consulta=mysqli_query($conexion,$select)or die("Fallo en la select");        
    }   

    $bValido=false;

    for($i = 0; $i < count($familias) && $bValido==false ; $i++)
    {
        if(isset($_POST[''.$familias[$i].'']))
        {
            $select="SELECT * FROM producto WHERE familia=".$idFamilias[$i]."";
            $consulta=mysqli_query($conexion,$select)or die("Fallo en la select");
            $bValido=true;
        }
    }       

    $numFilas=mysqli_num_rows($consulta);

	for ($i = 0; $i <$numFilas ; $i++) {
		$fila=mysqli_fetch_array($consulta);
        if($fila['activo']=="si")
        {
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
    }   
    print '</div>';
}
?>