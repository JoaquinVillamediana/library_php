<?php
session_start();
require_once('LoginCheck.php');
require_once('LoginCheck_admin.php');
require_once('booksDbClass.php');
$i=0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">
    <title>Ver Autores</title>
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
                    <a href="viewbooks_admin.php" class="nav-link" >Ver Libros</a>
                </li>
                <li class="nav-item">
                    <a href="searcher_admin.php" class="nav-link">Buscar Libros</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link  active">Ver Autores</a>
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
        <h1 class="text-center m-3">Todos los Autores</h1>
    <?php
    $oBooks = new booksDb(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $result = $oBooks->allauthors();
    echo "<table class='table table-striped border'><tr><th>ID</th><th>Autor</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $i++;
        echo "</tr><td>".$i."</td><td>'".$row['autor']."'</td></tr>";
    }
    echo"</table>";
    ?>
    </div>
    <script src="boostrap/js/jquery-3.4.1.min.js"></script>
        <script src="boostrap/js/popper.min.js"></script>
        <script src="boostrap/js/boostrap.min.js"></script>
</body>

</html>