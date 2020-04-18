<?php
//require_once('properties.php');
require_once('usersDbClass.php');
require_once('booksDbClass.php');
class operationsDb extends baseDb
{

    function rentbook($book)
    {

        $oMysqli = $this->Connection();
        $time = actual_time();
        $oUsersDb = new usersDb(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $iduser = $oUsersDb->UserID();
        $oBooksDb = new booksDb(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $idbook = $oBooksDb->searchbookID($book);
        
        $sql = "INSERT INTO historial_retiros (FechaRetiro,IDLibro,IDUsuario) values ('".$time."','".$idbook."','".$iduser."')";
        $oMysqli->query($sql);
        if($oMysqli->affected_rows >=1)
        {
            // echo "Usuario añadido";
            // sleep(2);
            $result="<p class='text-warning font-weight-bold'>Libro Retirado, Tiene 1 semana para devolverlo</p>";
        }
        else
        {
            $result = "<p class='text-danger'>Se ha producido un error, por favor vuelva a intentarlo</p>";
        }
        return $result;  
    }

    function returnbook($returnid)
    {
        $oMysqli = $this->Connection();
        $time = actual_time();
        $sql = "UPDATE historial_retiros SET FechaDevolucion = '".$time."' where IDRETIRO = '".$returnid."' ";
        

        $oMysqli->query($sql);
        if($oMysqli->affected_rows >=1)
        {
            $result = "<p class='text-success'>Devolviste el Libro con exito!</p>";
        }
        else
        {
            $result = "<p class='text-danger'>Se produjo un error, por favor vuelve a devoler el Libro</p>";
        }
        return $result;


    }

    function allregisters()
    {
        $oMysqli = $this->Connection();
        $sql = "SELECT * FROM historial_retiros";
        $result = $oMysqli->query($sql);
        return $result;


    }


    function checkavailable($bookid)
    {
        
        $available=true;
        $oMysqli= $this->Connection();
        $sql = "SELECT FechaDevolucion FROM historial_retiros WHERE IDLibro = '".$bookid."' ";
        
        $result = $oMysqli->query($sql);
        while($row = $result->fetch_assoc())
        {
            if($row['FechaDevolucion']==null)
            {
                $available=false;
            }
            
        }
        return $available;
    }

    function userregisters($userid)
    {
        $oMysqli = $this->Connection();
        $sql = "SELECT * FROM historial_retiros WHERE IDUsuario = '".$userid."' AND FechaDevolucion is null" ;
        $result = $oMysqli->query($sql);
        return $result;
    }





}





?>