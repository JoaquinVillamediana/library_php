<?php
include_once('properties.php');
include_once('operationsDbClass.php');
include_once('booksDbClass.php');

session_start();
require_once('LoginCheck.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Devolver Libro</title>
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">
</head>
<body>
<header>
        <nav>
            <ul class="nav justify-content-end nav-tabs">
                <li class="nav-item "><a class="nav-link" href="main.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link " href="searcher.php">Busqueda de libros</a></li>

                <li class="nav-item"><a class="nav-link " href="profile.php">Mi Perfil</a></li>

                <li class="nav-item"><a class="nav-link" href="retiro.php">Retirar Libro</a></li>

                <li class="nav-item"><a class="nav-link active" href="#">Devolver Libros</a></li>

                <li class="nav-item"><a class="nav-link" href="closeSession.php">Cerrar Sesion</a></li>
            </ul>

        </nav>
    </header>
    <div class="container">
    <h1 class="text-center m-4">Devolver un Libro</h1>
    
    
   
    <form action="" method="post">
    <table class="table table-striped border">
        <tr>
        <th>ID</th>
        <th>Fecha-Retiro</th>
        <th>Estado</th>
        <th>Nombre del libro</th>
        <th>Seleccion</th>
        </tr>
        <?php
        $oBooks = new booksDb(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $result = $oBooks->Records();

        while($row = $result->fetch_assoc())
        {
            if($row['FechaDevolucion']==null)
            {
            
            echo "<tr><td>'".$row['IDRETIRO']."'    </td>";
            echo " <td>'".$row['FechaRetiro']."'</td> ";
            if($row['FechaDevolucion']!=null)
            {
                echo" <td>Devuelto</td>";
            }
            else
            {
                echo"<td>Pendiente</td>";
            }
            // $oSearch = new searchDb(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $name = $oBooks->searchbookname($row['IDLibro']);
            echo ("<td>'".$name."' </td>");
            echo "<td><input type='radio' name='return' value='".$row['IDRETIRO']."' id=''>  </td></tr>";
            
        }
        }
        
        ?>
    </table>
    
    
    <input type="submit" class="btn btn-primary" value="Devolver">
    </form>
    <br>
    <?php
    if($_POST)
    {   
        $registerid = $_POST['return'];
        $oOperations = new operationsDb(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $result = $oOperations->returnbook($registerid);
        echo $result;
        

    }

?>
    
    <script src="boostrap/js/jquery-3.4.1.min.js"></script>
    <script src="boostrap/js/popper.min.js"></script>
    <script src="boostrap/js/boostrap.min.js"></script>
    </div>
</body>
</html>