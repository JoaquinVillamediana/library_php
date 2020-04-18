<?php
    session_start();
    include_once('properties.php');
    require_once('LoginCheck.php');
    require_once('LoginCheck_admin.php');
    include_once('operationsDbClass.php');
    include_once('booksDbClass.php');
    include_once('usersDbClass.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">
    <title>Document</title>
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
                    <a href="#" class="nav-link active">Ver Registros</a>
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
    <h1 class="text-center m-3">Registro de Libros</h1>
    <?php
    echo"<table class='table table-striped border'><tr><th>ID</th><th>Fecha de Retiro</th><th>Fecha de Devolucion</th><th>Fecha Devolucion Max.</th><th>Libro</th><th>Usuario</th></tr>";
    $oOperations = new operationsDb(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $result = $oOperations->allregisters();
    while($row = $result->fetch_assoc())
    {   
        $oUsers = new usersDb(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $user = $oUsers->searchusername($row['IDUsuario']);
        $oBook = new booksDb(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $book = $oBook->searchbookname($row['IDLibro']);
        $estimateddate=date("Y-m-d H:i:s", strtotime($row['FechaRetiro']."+1 week"));
        if($estimateddate<actual_time())
        {
            echo"<tr class='text-danger'>";
        }
        else{
            echo"<tr>";
        }
        echo "<td>'".$row['IDRETIRO']."'</td><td>'".$row['FechaRetiro']."'</td><td>'".$row['FechaDevolucion']."'</td><td>'".$estimateddate."'</td><td>'".$book."'</td><td>'".$user."'</td></tr>";


    }
    echo"</table>";
?>

</div>
<script src="boostrap/js/jquery-3.4.1.min.js"></script>
        <script src="boostrap/js/popper.min.js"></script>
        <script src="boostrap/js/boostrap.min.js"></script>
</body>
</html>