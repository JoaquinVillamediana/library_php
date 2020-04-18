<?php
    session_start();
    require_once('LoginCheck.php');
    require_once('properties.php');
    require_once('usersDbClass.php');
    if($_POST)
    {
        $old=$_POST['password'];
        $new=$_POST['password2'];
        $new2=$_POST['password3'];

        $oUser = new usersDb(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $validate = $oUser->changepass($old,$new,$new2);

        
        if($validate==false)
        {
            echo "Se produjo un error, vuelve a intentarlo";
        }

    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contraseña</title>
</head>
<body>
    <form action="" method="post">
    <input type="password" name="password" placeholder="Antigua Contraseña:" id="">
    <br><br>
    <input type="password" name="password2" placeholder="Nueva Contraseña:" id="">
    <br><br>
    <input type="password" name="password3" placeholder="Confirmacion:" id="">
    <br><br>
    <input type="submit" value="Cambiar">
    <a href="profile.php">Regresar</a>

    </form>
</body>
</html>