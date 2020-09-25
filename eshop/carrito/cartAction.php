<?php
const TARJETA = '01';
const MODO_ENVIO_WEB = '01';
const ESTADO_PAGADO = 'PA';

$estado = ESTADO_PAGADO;

////////////////////  incluir el codigo de cart action en el routing
// initialize shopping cart class
include 'Cart.php';
$cart = new Cart;
// include database configuration file
require ("includes/conexion.php");
//require_once
if (isset($myaction) && !empty($myaction))
{

    if ($myaction == 'addToCart' && !empty($productID))
    {
        // get product details
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
    elseif ($myaction == 'removeCartItem' && !empty($productID))
    {
        $deleteItem = $cart->remove($productID);
        $redirectLoc = '?menu=viewcart';

        header("Location: " . $redirectLoc);
    }
    elseif ($myaction == 'updateCartItem' && !empty($id_producto))
    {
        $itemData = array(
            'rowid' => $id_producto,
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem ? 'ok' : 'err';
        die;
    }
    elseif ($myaction == 'placeorder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID']))
    {     
     include_once('placeorder.php');     
    }
    else
    {

        $redirectLoc = '?menu=index';
        header("Location: " . $redirectLoc);

    }
}
else
{
    $redirectLoc = '?menu=index';
    header("Location: " . $redirectLoc);

}

