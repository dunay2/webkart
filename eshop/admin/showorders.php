<?php
session_start();
 
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
}

 require_once ("includes/conexion.php");

  $sql = "CALL getOrders('ES');";

  $conexion->next_result();
  
  $query = $conexion->query($sql);
?>

<div class="container">
    <h1>List of orders</h1>
    
<table class="table table-striped ">
<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Pedido</th>
      <th scope="col">Nif</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellidos</th>
      <th scope="col">Fecha pedido</th>
      <th scope="col">Total</th>
      <th scope="col">Modo pago</th>
      <th scope="col">Envío</th>
      <th scope="col">Detalle envío</th>
    </tr>
  </thead>
  <tbody>

<?php

$cont=0;
   while ($row=mysqli_fetch_array($query)) 
   {
    echo '<tr>';
    echo '<th scope="row">'.++$cont.'</th>';
    echo '<td>'.$row['id_pedido'].'</td>';
    echo '<td>'.$row['nif'].'</td>';
    echo '<td>'.$row['nombre'].'</td>';
    echo '<td>'.$row['apellidos'].'</td>';
    echo '<td>'.$row['fecha_pedido'].'</td>';
    echo '<td>'.$row['total_pedido'].'</td>';
    echo '<td>'.$row['modo_pago'].'</td>';
    echo '<td>'.$row['modo_envio'].'</td>';
    echo '<td><a href="?menu=showorderdetail&id='.$row['id_fact_env'].'"class="btn btn-outline-primary">ver detalle</a></td>';
    echo '</tr>';
        
   }

 ?>

  </tbody>
</table>
</div>