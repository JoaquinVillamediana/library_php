<?php
session_start();
include_once('properties.php');
include_once('booksDbClass.php');
require_once('LoginCheck.php');
require_once('LoginCheck_admin.php');
$author = "Anonimo";
$publishing= "-";
$publish = "-";
if($_POST)
{
    $name=$_POST['name'];
    if(!empty($_POST['author']) && $_POST['author']!="")
    {
        $author=$_POST['author'];
    }
    if(!empty($_POST['publish']) && $_POST['publish']!="")
    {
        $publish=$_POST['publish'];
    }
    if(!empty($_POST['publishing']) && $_POST['publishing']!="")
    {
        $publishing=$_POST['publishing'];
    }
    $oBooksDb = new booksDb(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if($oBooksDb->addbook($name,$author,$publish,$publishing)==true)
    {
        echo "Libro Añadido";
    }
    else
    {
        echo "Lo sentimos, se produjo un error";
    }
    
}


?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">
    <title>Añadir Libro</title>
</head>

<body>
<header>
        <nav>
            <ul class="justify-content-center nav nav-pills">
                <li class="nav-item">
                    <a href="main_admin.php" class="nav-link ">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="addbook_admin.php" class="nav-link active">Añadir Libro</a>
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
        <h1 class="text-center m-2">Añadir Libro</h1>
    <form class="form-inline flex-column " action="" method="post">
    <input type="text" class="form-control w-25 m-2" name="name" placeholder="Nombre:" id=""><br><br>
    <input type="text" class="form-control w-25 m-2" name="author" placeholder="Autor (opcional):" id=""><br><br>
    <input type="number" class="form-control w-25 m-2" min="1750" name="publish" placeholder="Publicacion (opcional):" id=""><br><br>
    <input type="text" class="form-control w-25 m-2" name="publishing" placeholder="Editorial (opcional):" id=""><br><br>
    
    <input class="btn btn-primary" type="submit" value="Añadir">

    </form>
    <script src="boostrap/js/jquery-3.4.1.min.js"></script>
        <script src="boostrap/js/popper.min.js"></script>
        <script src="boostrap/js/boostrap.min.js"></script>
        </div>
    </body>
</html>