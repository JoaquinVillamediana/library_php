<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
//require 'usersDbClass.php';
require_once('booksDbClass.php');
require_once('operationsDbClass.php');
require_once('LoginCheck.php');


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Retiro</title>
    
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">
</head>

<body>
<header>
        <nav>
            <ul class="nav justify-content-end nav-tabs">
                <li class="nav-item "><a class="nav-link" href="main.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link " href="searcher.php">Busqueda de libros</a></li>

                <li class="nav-item"><a class="nav-link " href="profile.php">Mi Perfil</a></li>

                <li class="nav-item"><a class="nav-link active" href="#">Retirar Libro</a></li>

                <li class="nav-item"><a class="nav-link" href="return.php">Devolver Libros</a></li>

                <li class="nav-item"><a class="nav-link" href="closeSession.php">Cerrar Sesion</a></li>
            </ul>

        </nav>
    </header>
    <div class="container p-5 ">
     <h1 class="text-center mb-5">Retiro de Libros</h1> 
    <form action="" class="form-inline justify-content-center " method="post">
        <input placeholder="Nombre del Libro:" class="form-control" type="text" name="name" id="">
        <input type="submit" class="btn btn-primary" value="Buscar"> 
    </form>
   
    <br>
    <br>
    <?php
    if ($_POST) {


        if (isset($_POST['retire'])) {
            $oOperations = new operationsDb(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $book = $_POST['retire'];
            $answer = $oOperations->rentbook($book);
            echo $answer;
        } else {
            if ($_POST['name'] != null && $_POST['name'] != "") {
                $name = $_POST['name'];
                $oBooksDb = new booksDb(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $oOperations = new operationsDb(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $result = $oBooksDb->searchname($name);
                if ($result->num_rows >= 1) {
                    echo "<form action='' method='post'>";
                    echo "<table class='table table-striped border'><tr><th>ID</th><th>Nombre</th><th>Autor</th><th> Año Publicacion</th><th>Editorial</th><th>Seleccion</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        
                        if ($oOperations->checkavailable($row['idlibros'])) {
                            echo"<tr><td>'" . $row['idlibros'] . "'</td><td>'" . $row['nombre'] . "'</td><td>'" . $row['autor'] . "'</td><td>'" . $row['aniopublicacion'] . "'</td><td>'" . $row['editorial'] . "'</td><td><input type='radio' name='retire' value='" . $row['nombre'] . "' id=''></td></tr>";
                        } else {
                            echo "<tr class='text-danger font-italic'><td>'" . $row['idlibros'] . "'</td><td>'" . $row['nombre'] . "'</td><td>'" . $row['autor'] . "'</td><td>'" . $row['aniopublicacion'] . "'</td><td>'" . $row['editorial'] . "'</td><td>No Disponible</td></tr>";
                        }    

                    }
                    echo "</table>";
                    echo "<br>";
                    echo "<input class='btn btn-primary' type='submit' value='Retirar libro seleccionado'></form>";
                    // $oOperations = new operationsdB(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    // $result = $oOperations->rentbook($name);
                    // echo $result;
                } else {
                    echo "<p>Lo sentimos no encontramos el libro que estas buscando<p>";
                }
            }
        }
    }
    ?>
    <br>
    </div>
    <script src="boostrap/js/jquery-3.4.1.min.js"></script>
    <script src="boostrap/js/popper.min.js"></script>
    <script src="boostrap/js/boostrap.min.js"></script>
</body>

</html>