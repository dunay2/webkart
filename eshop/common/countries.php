<div class="col-md-4 mb-3 md-form">
		      
    <label for="zip">País</label>
    <select id="countrycode" name="countrycode" class="form-control" data-show-subtext="true" data-live-search="true">
<?php
    require ("includes/conexion.php");

    $sql = "CALL getCountries()";

    $query = $conexion->query($sql);

    while ($fila = mysqli_fetch_assoc($query))
    {?>
    <option  value="<?php echo $fila["iso"] ?>" data-subtext="<?php echo $fila["iso"]; ?>"><?php echo $fila["nombre"]; ?></option>
<?php
} ?>          
    </select>
</div>
