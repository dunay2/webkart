<?php
   // include database configuration file
   
   require("includes/conexion.php");    
   
   // initializ shopping cart class
   include 'Cart.php';
   $cart = new Cart;
   
   // redirect to home if cart is empty
   if($cart->total_items() <= 0){
       header("Location: index.php");
   }
   
   // set customer ID in session
   $_SESSION['sessCustomerID'] =2;
   
   $customer=$_SESSION['sessCustomerID'];
   
   // get customer details by session customer ID
   
   $query = $conexion->query("CALL getClient('$customer')");
           
   $custRow = $query->fetch_assoc();
   
   ?>
<div class="container">
   <h1>Previsualización de pedido</h1>
   <table class="table">
      <thead>
         <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
         </tr>
      </thead>
      <tbody>
         <?php
            if($cart->total_items() > 0){
                //get cart items from session
                $cartItems = $cart->contents();
                foreach($cartItems as $item){
            ?>
         <tr>
            <td><?php echo $item["name"]; ?></td>
            <td><?php echo $item["price"].' €'; ?></td>
            <td><?php echo $item["qty"]; ?></td>
            <td><?php echo $item["subtotal"].' €'; ?></td>
         </tr>
         <?php } }else{ ?>
         <?php } ?>
      </tbody>
      <tfoot>
      <tr>
            <td colspan="3"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Total <?php echo $cart->total().' €'; ?></strong></td>
            <?php } ?>
         </tr>
         <tr>
            <td colspan="3">            
                  </td>
         </tr>         
         <tr>
         <td></td>
            <td colspan="3">         
            
               <div class="footBtn">
                  <a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continuar comprando</a>
                  <a href="?menu=carrito&action=placeOrder" class="btn btn-success orderBtn">Introducir datos de envío <i class="glyphicon glyphicon-menu-right"></i></a>
               </div>
            </td>
            <td class="text-center">
            </td>
         </tr>
      </tfoot>
   </table>
</div>