<?php
session_start();

error_reporting(0);
function cabecera(){
	print '
	<html>
	<head>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="index.php">WoodenOffice</a>
	    </div>
	    <ul class="nav navbar-nav">';
	      if($_SESSION['usuario']==null)
	      {
	      	print'
	      	<li><a href="iniciarsesion.php">Iniciar Sesión <span class="glyphicon glyphicon-off"></span></a></li>
	      	<li><a href="registrousuario.php">Registro <span class="glyphicon glyphicon-menu-hamburger"></span></a></li>';
	  	  }
	  	  if($_SESSION['usuario']=="admin")
	      {
	      	print'
	      	<li><a href="verpedidos.php">Ver Pedidos <span class="glyphicon glyphicon-folder-open"></span></a></li>
	      	<li><a href="añadirarticulo.php">Añadir Artículos <span class="glyphicon glyphicon-level-up"></span></a></li>
	      	<li><a href="cerrarsesion.php">Cerrar Sesión <span class="glyphicon glyphicon-remove"></span></a></li>';
	  	  }
	  	  if($_SESSION['usuario']!="admin"&&$_SESSION['usuario']!=null)
	      {
	      	print'
	      	<li><a href="cambiardatos.php">'.$_SESSION['usuario'].' <span class="glyphicon glyphicon-off"></span></a></li>
	      	<li><a href="cesta.php">Cesta <span class="glyphicon glyphicon-usd"></span></a></li>
	      	<li><a href="verpedidos.php">Ver Pedidos <span class="glyphicon glyphicon-folder-open"></span></a></li>
	      	<li><a href="cerrarsesion.php">Cerrar Sesión <span class="glyphicon glyphicon-remove"></span></a></li>';
	  	  }
	print' 
	    </ul>
	   		<a class="navbar-brand pull-right" href="index.php">
        		<img alt="logo" src="logo.png">
      		</a> 
	  </div>
	</nav>
	<div class="container">';
}

function pie(){
	print '</div>
	</body>
	<script type="text/javascript" src="js/codigo.js"></script>
	</html>';
}
?>
