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
				break;
			case 'carrito':
				$myaction=$_GET['action'];
				if (isset($_GET['id'])) 
				$productID=$_GET['id'];		
				if (isset($_GET['quantity'])) 
				$quantity=$_GET['quantity'];					
				$page='carrito/cartAction.php';
				break;
			case 'viewcart':				
				$page='carrito/viewcart.php';
				break;
			case 'checkout':				
				$page='carrito/checkOut.php';
				break;
	
		}

		require_once($page);
	}
	else
	{
		require_once('home/index.php');
	}

 ?>