<?php 
	
	if (!empty($_GET)) {

		$menu=$_GET['menu'];
		$page='';
		switch ($menu) {
			case 'registroclientes':
				$page='clientes/registrar.php';
				break;
			case 'categoria':
				$page='productos/productos.php';						
				$mycategory=$_GET['categoria'];				
				break;
			case 'producto':
				$myproduct=$_GET['producto'];
				$page='productos/producto.php';
				break;
			case 'allproducts':
				$page='productos/productos.php';
		}

		require_once($page);
	}
	else
	{
		require_once('home/index.php');
	}

 ?>