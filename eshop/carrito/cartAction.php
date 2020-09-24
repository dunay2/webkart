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
    elseif ($myaction == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID']))
    {
        echo "estamo dentros";

        // insert order details into database
        //$_SESSION['sessCustomerID'] =2;
        $customer = $_SESSION['sessCustomerID'];
        $client_ip = $_SERVER['REMOTE_ADDR'];
        // get customer details by session customer ID
        $total = $cart->total();
        $sql = "CALL placeOrder('$customer', $total ,'$client_ip','" . TARJETA . "','" . MODO_ENVIO_WEB . "')";
        
        
       // try
       // if (!$query = $conexion->query($sql))
        //{
         //   echo '<br>'.$sql.'</br>';
          //  echo "Falló la instrucción select error es : (" . $conexion->errno . ") " . $conexion->error;
           // mysql_free_result($query);
           // mysql_close($conexion);
           // unset($query,$conexion);
            //exit;
        //}

        $query = $conexion->query($sql);        
        
        $fila = mysqli_fetch_array($query);
        
        
        $orderID = $fila['id'];

        if ($orderID)
        {
            // get cart items
            $cartItems = $cart->contents();
            $cont = 0;
            $sql = "";
            
            foreach ($cartItems as $item)
            {
                $sql = "CALL placeOrderDetail(" . ++$cont . "," . $orderID . ",'" . $item['id'] . "'," . $item['qty'] . "," . $item['price'] . ");";
                $query = $conexion->query($sql);        
            }

            $conexion->next_result();

            $sql = "CALL changeOrderStatus(" . $orderID . ",'" . $estado . "')";

                if (!$query = $conexion->query($sql))
                {                    
                    echo "Falló la instrucción select: (" . $conexion->errno . ") " . $conexion->error;
                    exit;
                }

                $cart->destroy();

                $redirectLoc = '?menu=orderSuccess&id=' . $orderID;

                header("Location: " . $redirectLoc);                    
                
        }
        else
        {            
                $redirectLoc = '?menu=checkout';
                header("Location: " . $redirectLoc);      
        }
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
