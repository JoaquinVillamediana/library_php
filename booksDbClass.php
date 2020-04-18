<?php
require_once('properties.php');
//require_once('baseDbClass.php');
require_once('usersDbClass.php');

class booksDb extends baseDb
{




    public function searchauthor($author) 
    {
        $oMysqli = $this->Connection();
        $sql = "SELECT * FROM libros where autor LIKE '%" . $author . "%' ";
        $result = $oMysqli->query($sql);
        return $result;
    }



    public function searchname($book)
    {

        $oMysqli = $this->Connection();
        $sql = "SELECT * FROM libros where nombre LIKE '%" . $book . "%' ";
        $result = $oMysqli->query($sql); 
        return $result;
    }


    public function searchnpublisher($publisher)
    {

        $oMysqli = $this->Connection();
        $sql = "SELECT * FROM libros where editorial LIKE '%" . $publisher . "%' ";
        $result = $oMysqli->query($sql); 
        return $result;
    }

    public function searchbookname($ID)
    {
        $oMysqli = $this->Connection();
        $sql = "SELECT nombre FROM libros where idlibros ='" . $ID . "' ";
        $resultado = $oMysqli->query($sql);

        while ($fila = $resultado->fetch_assoc()) {
            $name = $fila['nombre'];
        }
        return $name;
    }

    function searchbookID($name)
    {
        $oMysqli = $this->Connection();
        $sql = "SELECT idlibros FROM libros where nombre = '" . $name . "'";
        $result = $oMysqli->query($sql);
        while ($row = $result->fetch_assoc()) {
            $idbook = $row['idlibros'];
        }
        return $idbook;
    }




    public function allbooks()
    {
        $oMysqli = $this->Connection();
        $sql = "SELECT * FROM libros";
        $result = $oMysqli->query($sql);
        return $result;
    }

    public function allauthors()
    {
        $oMysqli = $this->Connection();
        $sql = "SELECT autor FROM libros GROUP BY autor";
        $result = $oMysqli->query($sql);
        return $result;
    }


    public function checknameexist($book)
    {
        $oMysqli = $this->Connection();
        $sql = "SELECT * FROM libros where nombre ='" . $book . "' ";
        $resultado = $oMysqli->query($sql);
        $validate = 0;
        while ($fila = $resultado->fetch_assoc()) {
            $validate = 1;
        }
        return $validate;
    }

    public function Records()
    {
        $oUserDb = new usersDb(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $UserID = $oUserDb->userID();
        $oMysqli = $this->Connection();
        $sql = "SELECT * FROM historial_retiros where IDUsuario = '" . $UserID . "'";
        $result = $oMysqli->query($sql);
        return $result;
    }

    public function addbook($name , $author="Anonimo",$publish="-", $publishing="-")
    {
        
        $oMysqli = $this->Connection();
        $sql = "INSERT INTO libros (nombre,autor,aniopublicacion,editorial) values ('".$name."','".$author."','".$publish."','".$publishing."')";
        $oMysqli->query($sql);
        if($oMysqli->affected_rows >=1)
        {
            $validate = true;
        }
        else
        {
            $validate = false;
        }

        return $validate;

    }

}
