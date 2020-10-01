<?php
require_once ("includes/conexion.php");
session_start();

if (isset($_POST['login']))
{

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "CALL getUser('$username');";

    $conexion->next_result();

    $query = $conexion->query($sql);

    $row = mysqli_fetch_array($query);

    if (!$row)
    {
        echo '<p class="error">Username password combination is wrong!</p>';
    }
    else
    {
        if (password_verify($password, $row['password']))
        {
            $_SESSION['user_id'] = $row['id'];
            echo '<p class="success">Congratulations, you are logged in!</p>';

            $redirectLoc = '?menu=adminmenu';
            header("Location: " . $redirectLoc);

        }
        else
        {
            echo '<p class="error">Username password combination is wrong!</p>';
        }
    }
}
require_once ("login.html");
?>
