<?php
session_start();
include_once('booksDbClass.php');
require_once('LoginCheck.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">
    <title>Mi Perfil</title>
</head>
<body>
<header>
        <nav>
            <ul class="nav justify-content-end nav-tabs">
                <li class="nav-item "><a class="nav-link" href="main.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link " href="searcher.php">Busqueda de libros</a></li>

                <li class="nav-item"><a class="nav-link active" href="#">Mi Perfil</a></li>

                <li class="nav-item"><a class="nav-link" href="retiro.php">Retirar Libro</a></li>

                <li class="nav-item"><a class="nav-link" href="return.php">Devolver Libros</a></li>

                <li class="nav-item"><a class="nav-link" href="closeSession.php">Cerrar Sesion</a></li>
            </ul>

        </nav>
    </header>
    <div class="container p-2">
    <h1 class="text-center"><?php 
 
    
    echo $_SESSION['user'];
    ?></h1>
    </div>
    <hr>
    <div class="container">
    <h3>Mis Retiros</h3>
    
    <table class="table table-striped border">
        <tr>
            <th> <u> ID</u></th>
            <th><u>Fecha-Retiro</u></th>
            <th><u>Estado</u></th>
            <th><u>Nombre</u></th>
        </tr>
        <?php
        $oBooks = new booksDb(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $result = $oBooks->Records();
        while($row = $result->fetch_assoc())
        {
            echo "<tr><td>'".$row['IDRETIRO']."'</td>";
            echo " <td>'".$row['FechaRetiro']."'</td> ";
            if($row['FechaDevolucion']!=null)
            {
                echo" <td>Devuelto</td>";
            }
            else
            {
                $estimateddate=date("Y-m-d H:i:s", strtotime($row['FechaRetiro']."+1 week"));
                echo"<td class='text-warning font-italic'>Pendiente";
                if($estimateddate<actual_time())
                {
                    echo "<span class='text-danger'> (Tarde)</span>";
                }
                echo'</td>';
            }
            // $oSearch = new searchDb(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $name = $oBooks->searchbookname($row['IDLibro']);
            echo ("<td>'".$name."' </td> </tr>");
        }
        
        ?>
    </table>
    </div>
    <hr>
    <div class="container">
    
<a class="text-center" href="changepass.php">Cambiar Contraseña</a>
        <br><br>
    </div>
    <script src="boostrap/js/jquery-3.4.1.min.js"></script>
    <script src="boostrap/js/popper.min.js"></script>
    <script src="boostrap/js/boostrap.min.js"></script>
</body>
</html>