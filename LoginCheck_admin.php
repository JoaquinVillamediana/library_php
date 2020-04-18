<?php
    if($_SESSION['user']!="admin@admin.com")
    {
        header('location: main.php');
    }

?>