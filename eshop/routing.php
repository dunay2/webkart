<?php 
	
	$page='home/index.php';

	if (!empty($_GET)) {

		$menu=$_GET['menu'];
		
		switch ($menu) {
			case 'registroclientes':
				$page='clients/register.php';			
				break;
			case 'categoria':
				$page='products/products.php';						
				$mycategory=$_GET['categoria'];				
				break;
			case 'producto':
				$myproduct=$_GET['producto'];
				$page='products/product.php';
				break;
			case 'allproducts':
				$page='products/products.php';
				break;
			case 'carrito':
				$myaction=$_GET['action'];
				if (isset($_GET['id'])) 
				$productID=$_GET['id'];		
				if (isset($_GET['quantity'])) 
				$quantity=$_GET['quantity'];					
				$page='carrito/cartaction.php';
				break;
			case 'viewcart':				
				$page='carrito/viewcart.php';				
				break;
			case 'datosenvio':				
				$page='clients/datosenvio.php';				
				break;
			case 'checkout':				
				$page='carrito/checkout.php';
				break;
			case 'ordersuccess':									
				if (isset($_GET['id'])) 
				$id=$_GET['id'];
				$page='carrito/ordersuccess.php';
				break;

			case 'contact':									
				$page='common/contact.html';
				break;

			//admin menu
			case 'showorders':					
				$page='admin/showorders.php';
				break;
			case 'showorderdetail':					
					$id=$_GET['id'];
					$page='admin/showorderdetail.php';
					break;
			case 'login':								
					$page='admin/login.php';
			break;
			case 'adminregister':								
				$page='admin/register.php';
			break;
			case 'adminmenu':								
				$page='admin/adminmenu.php';
			break;

		}				
	}

	require_once($page);
	
 ?>