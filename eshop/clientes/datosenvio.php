<div class="container">
		  <h2>Detalles de envío</h2>
		  <form action='?menu=carrito&action=placeOrder' method='post'>
              
          <div class="form-row">         

            <div class="col-md-4 mb-3 md-form">
              <label for="Nif">nif</label>
              <input type="text" class="form-control" id="nif"  name="nif" required="true"  placeholder="Introduzca su nif" value="45646">
            </div>

            <div class="col-md-4 mb-3 md-form">
              <label for="name">Nombre</label>
              <input type="text" class="form-control" id="sendname" name="sendname"  required="true"  placeholder="Introduzca su nombre" value="nombre">
            </div>

            <div class="col-md-4 mb-3 md-form">
		          <label for="lastname">Apellidos</label>
		          <input type="lastname" class="form-control" id="sendlastname" name="sendlastname" required="true"  placeholder="Introduzca sus apellidos" value="apellidos">
		       </div>
        </div>

        <div class="form-row">         		    
            
            <div class="col-md-4 mb-3 md-form">
		          <label for="email">Email</label>
		          <input type="email" class="form-control" id="email" name="email" required="true" placeholder="Introduzca su email" value="email@mail.com">
            </div>

            <div class="col-md-4 mb-3 md-form">
		          <label for="direccion">Dirección</label>
		          <input type="sendaddress" class="form-control" id="sendaddress" name="sendaddress" required="true" placeholder="Introduzca sus dirección" value="direccion">
            </div>
            
            <div class="col-md-4 mb-3 md-form">
		          <label for="poblacion">Población:</label>
		          <input type="state" class="form-control" id="state" name="state" required="true" placeholder="Introduzca su población" value="poblacion">
            </div>

         </div>

        <div class="form-row">         		    
            <div class="col-md-4 mb-3 md-form">
  		        <label for="zip">Código Postal</label>
	  	        <input type="zip" class="form-control" id="zip" name="zip" require placeholder="Introduzca su código postal" value="35300">
            </div>

            <?php
            require ("common/countries.php");
            ?>
        </div>
                              
        <div class="row">
            <div class="col-md-12 bg-light text-right">                
              <a href="?menu=checkout" class="btn btn-warning">Volver <i class="glyphicon glyphicon-menu-right"></i></a>
              <button type="submit" class="btn btn-success orderBtn">Guardar</button>                
            </div>
        </div>
      </form>
</div>
