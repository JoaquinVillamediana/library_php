<?php
require_once ('usersDbClass.php');
require_once ("properties.php");

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ingreso</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <div class="title">
    <h1>INGRESO</h1>
    </div>
    <form class="form" action="" method="post">
    <input type="email" name="user" id="" placeholder="Usuario:">
    <input type="password" name="password" placeholder="Contraseña:" id="">
    <input type="submit" value="Entrar">
    <?php
    if($_POST)
    {
        $user=$_POST['user'];
        $password=$_POST['password'];
        $objDb = new usersDb(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $error = $objDb->Iniciar($user,$password);
        echo $error;

    }

    ?>
    </form>
</body>
</html>