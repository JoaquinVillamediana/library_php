<?php
session_start();
require_once('LoginCheck.php');
require_once('LoginCheck_admin.php');
require_once('booksDbClass.php');
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">
    <title>Ver todos los Libros</title>
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
                    <a href="#" class="nav-link active">Ver Libros</a>
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
        <h1 class="text-center m-3">Todos los Libros</h1>
        <?php
        $oBooks = new booksDb(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $result = $oBooks->allbooks();
        echo "<table class='table table-striped border'><tr><th>ID</th><th>Libro</th><th>Editorial</th><th>Autor</th><th>Publicacion</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "</tr><td>" . $row['idlibros'] . "</td><td>'" . $row['nombre'] . "'</td><td>'" . $row['editorial'] . "'</td><td>'" . $row['autor'] . "'</td><td>'" . $row['aniopublicacion'] . "'</td></tr>";
        }
        echo "</table>";
        ?>
        <script src="boostrap/js/jquery-3.4.1.min.js"></script>
        <script src="boostrap/js/popper.min.js"></script>
        <script src="boostrap/js/boostrap.min.js"></script>
    </div>
</body>

</html>