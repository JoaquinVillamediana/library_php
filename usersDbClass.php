<?php
require_once('baseDbClass.php');

class usersDb extends baseDb
{
    public function Iniciar($user, $password)
    {
        $oMysqli = $this->Connection();

        $sql = "Select * from users";
        $result = $oMysqli->query($sql);
        while ($row = $result->fetch_assoc()) {
            if ($row['mail'] == $user) {
                if ($row['password'] == md5($password)) {
                    session_start();
                    $_SESSION['user'] = $user;
                    header("location: main.php");
                    $error = "<p>Logueado Correctamente!<p>";
                } else {
                    $error = "<br> <p class='error'>Usuario o Contraseña incorrecta<p>";
                }
            } else {
                $error = "<br><p class='error'> Usuario o Contraseña incorrecta<p>";
            }
        }

        return $error;
    }

    public function Register($mail,$phone, $password)
    {
        $oMysqli = $this->Connection();
        $encpass = md5($password);
        $sql = "INSERT INTO users (mail,phone,password) values ('" . $mail . "','".$phone."','" . $encpass . "')";
        $oMysqli->query($sql);
        if ($oMysqli->affected_rows >= 1) {
            $error = "Usuario añadido!";
        } else {
            $error = "Se ha producido un error, por favor vuelva a intentarlo";
        }




        return $error;
    }

    public function userID()
    {
        $oMysqli = $this->Connection();
        $sql = "SELECT idusers FROM users where mail = '" . $_SESSION['user'] . "'";
        
        $result = $oMysqli->query($sql);
        while ($row = $result->fetch_assoc()) {
            $id = $row['idusers'];
        }
        return $id;
    }

    public function changepass($old, $new, $new2)
    {
        $oMysqli = $this->Connection();
        $sql = "SELECT password FROM usuarios where Usuarios ='" . $_SESSION['user'] . "' ";
        $result = $oMysqli->query($sql);
        while ($row = $result->fetch_assoc()) {
            $resul = $row['password'];
        }
        if ($resul == md5($old)) {

            if ($new == $new2) {
                $encpass = md5($new);
                $validate=false;
                $sql = "UPDATE usuarios SET password = '" . $encpass . "' where Usuarios = '" . $_SESSION['user'] . "'";
                $oMysqli->query($sql);
                if ($oMysqli->affected_rows >= 1) {
                    header("location: profile.php");
                    $validate = true;
                } else {
                    $validate = false;
                }
            }
        }



        return $validate;
    }



    function allusers()
    {
        $oMysqli = $this->Connection();
        $sql = "SELECT * FROM users";
        $result = $oMysqli->query($sql);
        return $result;
    }


    function searchusername($ID)
    {
        
        $oMysqli = $this->Connection();
        $sql = "SELECT mail FROM users where idusers = '".$ID."'";
        $result = $oMysqli->query($sql);
        while ($row = $result->fetch_assoc()) {
            $resul = $row['mail'];
        }
        return $resul;
    }
}
