
<?php

    $cif = $_POST["nif"];
    $sendname = $_POST["sendname"];
    $sendlastname = $_POST["sendlastname"];
    $sendaddress = $_POST["sendaddress"];    
    $zip = $_POST["zip"];
    $state = $_POST["state"];
    $countrycode = $_POST["countrycode"];
    $email = $_POST["email"];
        
    $sql = "CALL createInvoice('$cif', '$sendname' ,'$sendlastname','$sendaddress','$zip','$state','$countrycode','$email');";

    $conexion->next_result();
    $query = $conexion->query($sql);
    
    $fila = mysqli_fetch_array($query);

    $invoiceID = $fila['id'];    
    
?>