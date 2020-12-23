<?php
namespace Leave;

class logout
{
    public function session_logout()
    {
        if ($_SESSION) {
            session_unset();
        }
        if (!$_SESSION) {
            header('location: login.php');
        }
    }
}


require_once "../Core/config.php";
require_once "../Core/session.php";
require '../vendor/autoload.php';


//if (session_destroy())
//{
//header('location: login.php');
//exit;
//}


?>
