<?php
session_start();
require 'booksDbClass.php';
require_once('operationsDbClass.php');
require_once('LoginCheck.php');
require_once("properties.php");



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Buscador</title>
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="styles/searcher.css"> -->
</head>

<body>
    <header>
        <nav>
            <ul class="nav justify-content-end nav-tabs">
                <li class="nav-item "><a class="nav-link" href="main.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link active" href="#">Busqueda de libros</a></li>

                <li class="nav-item"><a class="nav-link" href="profile.php">Mi Perfil</a></li>

                <li class="nav-item"><a class="nav-link" href="retiro.php">Retirar Libro</a></li>

                <li class="nav-item"><a class="nav-link" href="return.php">Devolver Libros</a></li>

                <li class="nav-item"><a class="nav-link" href="closeSession.php">Cerrar Sesion</a></li>
            </ul>

        </nav>
    </header>
    <div class="container">
        
    <h1 class="text-center  m-3">Buscador</h1>
        <div class="container">
        <form action="" method="post">
                <div class="form-group"><p >Buscar por:</p></div>
            <div class="form-check-inline">
                <label class="form-check-label" for="autor">
                    <input class="form-check-input " type="radio" name="tipo" value="autor" id="" checked>Autor
                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label" for="nombre">
                    <input class="form-check-input " type="radio" name="tipo" value="nombre" id="">Nombre
                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label" for="editorial">
                    <input class="form-check-input " type="radio" name="tipo" value="editorial" id="">Editorial
                </label>
            </div>
            <br><br>
            <div class="container w-25 m-0 p-0">
            <input type="text" class="form-control" name="palabra" id="">
            </div>
            <br>
            
            <input class="btn btn-primary " type="submit" value="Buscar!">
        </form>
        </div>
        <br>
        <?php
        if ($_POST) {

            $word = $_POST['palabra'];
            // $buscador = new busqueda();

            if (!$word == null && !$word == "" && ($_POST['tipo'] == "autor" || $_POST['tipo'] == "nombre" || $_POST['tipo'] == "editorial")) {
                $oBooks = new booksDb(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                if ($_POST['tipo'] == "autor") {
                    $result = $oBooks->searchauthor($word);
                }
                if ($_POST['tipo'] == "nombre") {
                    $result = $oBooks->searchname($word);
                }
                if ($_POST['tipo'] == "editorial") {
                    $result = $oBooks->searchnpublisher($word);
                }
                echo "<table class='table table-striped border'>";
                $oOperations = new operationsDb(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                while ($row = $result->fetch_assoc()) {



                    if ($oOperations->checkavailable($row['idlibros'])) {
                        echo "<tr><td> '" . $row['nombre'] . "' </td><td>de '" . $row['autor'] . "' </td><td>- Publicado en '" . $row['aniopublicacion'] . "' </td><td> Editorial '" . $row['editorial'] . "' </td><td>Disponible</td></tr>";
                    } else {
                        echo "<tr class='text-danger font-italic'><td> '" . $row['nombre'] . "' </td><td>de '" . $row['autor'] . "' </td><td>- Publicado en '" . $row['aniopublicacion'] . "' </td><td> Editorial '" . $row['editorial'] . "' </td><td>No disponible</td></tr>";
                    }
                }
                echo "</table>";
            }
        }

        ?>
        <br>
        <br>
        <script src="boostrap/js/jquery-3.4.1.min.js"></script>
        <script src="boostrap/js/popper.min.js"></script>
        <script src="boostrap/js/boostrap.min.js"></script>
        </div>
</body>

</html>