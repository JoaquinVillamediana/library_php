<?php
session_start();
require_once('LoginCheck.php');
require_once('LoginCheck_admin.php');
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">
    <title>Admin</title>
</head>

<body>
    <header>
        <nav>
            <ul class="justify-content-center nav nav-pills">
                <li class="nav-item">
                    <a href="#" class="nav-link active">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="addbook_admin.php" class="nav-link">Añadir Libro</a>
                </li>
                <li class="nav-item">
                    <a href="viewbooks_admin.php" class="nav-link">Ver Libros</a>
                </li>
                <li class="nav-item">
                    <a href="searcher_admin.php" class="nav-link">Buscar Libros</a>
                </li>
                <li class="nav-item">
                    <a href="viewauthors_admin.php" class="nav-link">Ver Autores</a>
                </li>
                <li class="nav-item">
                    <a href="viewregister_admin.php" class="nav-link">Ver Registros</a>
                </li>
                <li class="nav-item">
                    <a href="viewusers_admin.php" class="nav-link">Ver Usuarios</a>
                </li>
                <li class="nav-item">
                    <a href="Registro.php" class="nav-link">Registrar Usuarios</a>
                </li>
                <li class="nav-item">
                    <a href="closeSession.php" class="nav-link">Cerrar Sesion</a>
                </li>
            </ul>
        </nav>

    </header>
    <div class="container">
        <h1 class="text-center m-3">Biblioteca Online - Administrador</h1>


        <script src="boostrap/js/jquery-3.4.1.min.js"></script>
        <script src="boostrap/js/popper.min.js"></script>
        <script src="boostrap/js/boostrap.min.js"></script>
    </div>
</body>

</html>