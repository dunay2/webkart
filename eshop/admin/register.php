<?php

require_once ("includes/conexion.php");
session_start();

if (!isset($_SESSION['user_id']))
{
    header('Location: login.php');
    exit;
}

if (isset($_POST['register']))
{

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $sql = "CALL getUserByEmail('$email');";

    $conexion->next_result();

    $query = $conexion->query($sql);

    $row_cnt = $query->num_rows;

    if ($query->num_rows > 0)
    {
        echo '<p class="error">The email address is already registered!</p>';
    }

    if ($query->num_rows == 0)
    {

        $sql = "CALL createUser('$username','$password_hash','$email');";

        $conexion->next_result();

        $query = $conexion->query($sql);

        if ($query)
        {
            echo '<p class="success">Your registration was successful!</p>';
        }
        else
        {
            echo '<p class="error">Something went wrong!</p>';
        }
    }
}
require_once ("register.html");
?>
