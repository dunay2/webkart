<?php

////////////////////  incluir el codigo de cart action en el routing

// initialize shopping cart class
include 'Cart.php';
$cart = new Cart;

// include database configuration file

require("includes/conexion.php");    

if(isset($myaction) && !empty($myaction)){

    echo 'cartAction tiene una accion '. $myaction .'<br>';

    if($myaction == 'addToCart' && !empty($productID)){        
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

        $redirectLoc = $insertItem?'viewCart.php':'index.php';

        $redirectLoc='?menu=viewcart';
        ob_end_clean( );
        header("Location: ".$redirectLoc);
        exit;
       

    }elseif($myaction == 'removeCartItem' && !empty($productID)){

        
        $deleteItem = $cart->remove($productID);
        $redirectLoc='?menu=viewcart';
        header("Location: ".$redirectLoc);


    }elseif($myaction == 'updateCartItem' && !empty($id_producto)){
        $itemData = array(
            'rowid' => $id_producto,
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;


        
    }elseif($myaction == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID'])){

        echo '<br>vamos a insertar';

        // insert order details into database
        $insertOrder = $db->query("INSERT INTO orders (customer_id, total_price, created, modified) VALUES ('".$_SESSION['sessCustomerID']."', '".$cart->total()."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
        
        if($insertOrder){
            $orderID = $db->insert_id;
            $sql = '';
            // get cart items
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO order_items (order_id, product_id, quantity) VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."');";
            }
            // insert order items into database
            $insertOrderItems = $db->multi_query($sql);
            
            if($insertOrderItems){
                $cart->destroy();
                header("Location: orderSuccess.php?id=$orderID");
            }else{
                header("Location: checkout.php");
            }
        }else{
            header("Location: checkout.php");
        }
    }else{
        echo 'cartAction quiere ir a index.php';
        //header("Location: index.php");
    }
}else{
    echo 'cartAction quiere ir a index.php';
 //   header("Location: index.php");
}