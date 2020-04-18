<?php

require 'usersDbClass.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/register.css">
</head>

<body>
<header>
        <nav>
            <ul class="justify-content-center nav nav-pills">
                <li class="nav-item">
                    <a href="main_admin.php" class="nav-link ">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="addbook_admin.php" class="nav-link ">Añadir Libro</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">Ver Libros</a>
                </li>
                <li class="nav-item">
                    <a href="searcher_admin.php" class="nav-link">Buscar Libros</a>
                </li>
                <li class="nav-item">
                    <a href="viewauthors_admin.php" class="nav-link">Ver Autores</a>
                </li>
                <li class="nav-item">
                    <a href="viewregister_admin.php" class="nav-link ">Ver Registros</a>
                </li>
                <li class="nav-item">
                    <a href="viewusers_admin.php" class="nav-link ">Ver Usuarios</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link active">Registrar Usuarios</a>
                </li>
                <li class="nav-item">
                    <a href="closeSession.php" class="nav-link">Cerrar Sesion</a>
                </li>
            </ul>
        </nav>

    </header>
    <div class="title">
        <h1>Registro de Usuarios</h1>
    </div>

    <div class="form">
        <form action="" method="post">
            <input type="email" name="mail" placeholder="E-Mail:" id="">
            <input type="tel" name="phone" maxlength="14" minlength="11" placeholder="Telefono:" id="">
            <input type="password" name="password" placeholder="Contraseña:" id="">
            <input type="password" name="password2" placeholder="Repetir Contraseña:" id="">
            <input type="submit" value="Registrar Usuario">
        </form>
        <?php
        if ($_POST) {
            $user = $_POST['mail'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            if ($password == $password2) {
                $objuserDb = new usersDb(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $result = $objuserDb->Register($user, $phone, $password);
                echo $result;
            } else {
                echo ("<p class='error'>*Las contraseñas deben ser iguales</p>");
            }
        }
        

        ?>
    </div>
    <script src="boostrap/js/jquery-3.4.1.min.js"></script>
        <script src="boostrap/js/popper.min.js"></script>
        <script src="boostrap/js/boostrap.min.js"></script>
</body>

</html>