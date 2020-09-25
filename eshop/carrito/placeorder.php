<?php

require_once('clientes/insertardatosenvio.php');

// insert order details into database
        //$_SESSION['sessCustomerID'] =2;
        $customer = $_SESSION['sessCustomerID'];
        $client_ip = $_SERVER['REMOTE_ADDR'];
        // get customer details by session customer ID
        $total = $cart->total();

        $sql = "CALL placeOrder('$customer', $total ,'$client_ip','" . TARJETA . "','" . MODO_ENVIO_WEB . "',$invoiceID)";
                
        $conexion->next_result();
        if (!$query = $conexion->query($sql))
        {
            echo "Falló la instrucción select: (" . $conexion->errno . ") " . $conexion->error;
            exit;
        }
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

            $redirectLoc = '?menu=ordersuccess&id=' . $orderID;

            header("Location: " . $redirectLoc);

        }
        else
        {
            $redirectLoc = '?menu=checkout';
            header("Location: " . $redirectLoc);
        }
    ?>