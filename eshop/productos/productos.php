<div class="container">

<br>  
    <p class="text-center">

<?php 
        require("includes/conexion.php");

        if  (!isset($mycategory))
        {
            echo '<h2>Los mejores productos hoy</h2>';
            $sql="CALL getProducts('ES')";            
        }
        else{
            echo '<h2>Productos por Categoría</h2>';
            $sql="call getProductByCategory ('$mycategory','ES')";        
        }

        $query=mysqli_query($conexion, $sql); 
     ?> 

    </p>

<div class="row">

<?php

while ($fila=mysqli_fetch_array($query)) 
{ 
        ?>
<div class="col-md-4">
	<figure class="card card-product">
        <div class="img-wrap">         
        </div>
		<figcaption class="info-wrap">
				<h4 class="title"><?php echo $fila['descripcion_corta'] ?></h4>
				<p class="desc"><?php  echo $fila['descripcion_larga'] ?>...</p>
				<div class="rating-wrap">
					<div class="label-rating">132 opiniones</div>
					<div class="label-rating">154 pedidos</div>
				</div> <!-- rating-wrap.// -->
		</figcaption>
		<div class="bottom-wrap">
			<a href="?menu=producto&producto=<?php echo $fila['id_producto'] ?>" class="btn btn-sm btn-primary float-right">ver este producto</a>	
			<div class="price-wrap h5">
				<span class="price-new"><?php echo $fila['precio_oferta'] ?>€ </span> <del class="price-old"><?php echo $fila['precio_actual'] ?>€</del>
			</div> <!-- price-wrap.// -->
		</div> <!-- bottom-wrap.// -->
	</figure>
</div> <!-- col // -->
    <?php        
}
?>
</div> <!-- row.// -->

</div> 






