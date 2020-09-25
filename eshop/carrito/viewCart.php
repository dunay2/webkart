<?php
// initializ shopping cart class
include 'Cart.php';

$cart = new Cart;
?>

    <script>
    function updateCartItem(obj,id){
        $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
            if(data == 'ok'){
                location.reload();
            }else{
                alert('Error al actualizar el carrito, por favor, vuelva a intentarlo.');
            }
        });
    }
    </script>


<div class="container">
    <h1>Carrito de la compra</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th> </th>
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
            <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item['rowid']; ?>')"></td>
            <td><?php echo $item["subtotal"].' €'; ?></td>
            <td>
                <a href="?menu=carrito&action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
            </td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="5"><p>Su carrito está vacío ...</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td ><a href="index.php" class="btn btn-warning btn-block">Continuar comprando<i class="glyphicon glyphicon-menu-right"></i></a></td>
            <td colspan="2"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Total <?php echo $cart->total().' €'; ?></strong></td>
            <td><a href="?menu=checkout" class="btn btn-success btn-block">Finalizar y pagar <i class="glyphicon glyphicon-menu-right"></i></a></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
</div>
