<?php

session_start();        

const TARJETA = '01';
const MODO_ENVIO_WEB = '01';
const ESTADO_PAGADO = 'PA';

$estado = ESTADO_PAGADO;

////////////////////  incluir el codigo de cart action en el routing
// initialize shopping cart class
include 'Cart.php';
$cart = new Cart;


// include database configuration file
if (!empty($_GET['id'] && $_GET['myaction']=='updateCartItem'))

    {
        require_once("./../includes/conexion.php");
        $myaction = $_GET['myaction'];
        $id = $_GET['id'];
    }
else
{
    require_once ("includes/conexion.php");
}


if (isset($myaction) &&  $myaction == 'updateCartItem')
{

    $itemData = array(
        'rowid' => $id,
        'qty' => $_REQUEST['qty']
    );
    $updateItem = $cart->update($itemData);
    echo $updateItem ? 'ok' : 'err';
    die;
}

if (isset($myaction) && !empty($myaction))
{

    switch  ($myaction)
    {
    case 'addToCart':
        if (!empty($productID))
        {
        $query = $conexion->query("CALL getProduct('ES','$productID')");
        $row = $query->fetch_assoc();
        $itemData = array(
            'id' => $row['id_producto'],
            'name' => $row['descripcion_corta'],
            'price' => $row['precio_oferta'],
            'qty' => $quantity
        );

        $insertItem = $cart->insert($itemData);

        $redirectLoc = '?menu=viewcart';
        ob_end_clean();
        header("Location: " . $redirectLoc);
        exit;
        }
    break;
    case 'removeCartItem';
        if(!empty($productID))
        {
            $deleteItem = $cart->remove($productID);
            $redirectLoc = '?menu=viewcart';
            header("Location: " . $redirectLoc);
        }
    break;
    case 'placeorder':
        
        if($cart->total_items() > 0 && !empty($_SESSION['sessCustomerID']))
        {
            include_once('placeorder.php');     
        }

    break;

    default:
    $redirectLoc = '?menu=index';
    header("Location: " . $redirectLoc);

    }    
}

else{
    $redirectLoc = '?menu=index';
    header("Location: " . $redirectLoc);

}