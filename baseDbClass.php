<?php
include_once('properties.php');
class baseDb
{
    private $dbHost ;
    private $dbName ;
    private $dbUser ;
    private $dbPass ;

    public function __construct($dbHost, $dbUser,$dbPass,$dbName)
    {
        $this->dbHost = $dbHost;
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;
        $this->dbName = $dbName;
    }

    public function Connection()
    {
        $oMysqli = new Mysqli($this->dbHost,$this->dbUser,$this->dbPass,$this->dbName);
        if($oMysqli->connect_errno)
        {
            echo "Se produjo un error con el servidor";
        }
        else
        {
           
            return $oMysqli;
        }
    }




}


?>