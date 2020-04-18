<?php
session_start();
require_once('properties.php');
require_once('operationsDbClass.php');
require_once('usersDbClass.php');
require_once('booksDbClass.php');
require_once('LoginCheck.php');

if ($_SESSION['user'] == "admin@admin.com") {
    header("location: main_admin.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">
    <title>Biblioteca</title>
    
</head>

<body>
    <header>
    <nav>
    <ul class="nav justify-content-end nav-tabs">
            <li class="nav-item "><a class="nav-link  active" href="#">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="searcher.php">Busqueda de libros</a></li>
            
            <li class="nav-item"><a class="nav-link" href="profile.php">Mi Perfil</a></li>
            
            <li class="nav-item"><a class="nav-link" href="retiro.php">Retirar Libro</a></li>
            
            <li class="nav-item"><a class="nav-link" href="return.php">Devolver Libros</a></li>
            
            <li class="nav-item"><a class="nav-link" href="closeSession.php">Cerrar Sesion</a></li>
        </ul>

    </nav>


    </header>
    <div class="container">
        
        <h1 class="text-center text-primary m-5  ">Biblioteca Online</h1>
        
        <br>
        <?php
        $oUser = new usersDb(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $userID = $oUser->userID();
        $oOperations = new operationsDb(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $oBooks = new booksDb(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $registers = $oOperations->userregisters($userID);
        if ($registers->num_rows >= 1) {
            while ($rows = $registers->fetch_assoc()) {
                $retire = date("d/m/Y", strtotime($rows['FechaRetiro']));
                $devolucion = date("d/m/Y", strtotime($retire . "+ 1 week"));
                $actual = date("d/m/Y", strtotime(actual_time()));
                if ($actual > $devolucion) {
                    $bookname = $oBooks->searchbookname($rows['IDLibro']);
                    echo "<p class='text-danger'>*Se cumplio tu plazo para devolver en fecha el libro: '" . $bookname . "'</p>";
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