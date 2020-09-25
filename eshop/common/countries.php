<div class="col-md-4 mb-3 md-form">
		      
    <label for="zip">País</label>
    <select id="countrycode" name="countrycode" class="form-control" data-show-subtext="true" data-live-search="true">
<?php
    require ("includes/conexion.php");

    $sql = "CALL getCountries()";

    $query = $conexion->query($sql);

    while ($row = mysqli_fetch_assoc($query))
    {?>
    <option  value="<?php echo $row["iso"] ?>" data-subtext="<?php echo $row["iso"]; ?>"><?php echo $row["nombre"]; ?></option>
<?php
} ?>          
    </select>
</div>
