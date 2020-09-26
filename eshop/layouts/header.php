

<?php 
//para poder realizar los reenvios
ob_start( );
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Vida natural</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarsExampleDefault">
            <ul class="navbar-nav m-auto">
                <li class="nav-item m-auto">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="?menu=allproducts">Productos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="?menu=registroclientes">Registro</a>
				</li>
				<li class="nav-item">
                    <a class="nav-link" href="?menu=contact">Contacto</a>
                </li>
            </ul>

            <form class="form-inline my-2 my-lg-0">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Search...">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-secondary btn-number">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <a class="btn btn-success btn-sm ml-3" href="?menu=viewcart">
                    <i class="fa fa-shopping-cart"></i> Carrito
                    <span class="badge badge-light"><?php $total_items; ?></span>
				</a>			
			</form>			
		</div>		
	</div>
	
	<li class="nav-item active">


        <a  href="?menu=login"><span class="navbar-brand mb-0 h1"> Log in</span>	  </a>
        


    </li>
<?php    
if (isset($_SESSION['user_id']))
echo "<br>Identificador de sesión: " . $_SESSION['user_id'];        
?>   

</nav>