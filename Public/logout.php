<?php include "header.php"; ?>
<?php include "nav.php"; ?>

<?php


include_once('logout1.php');
//require '../vendor/autoload.php';

//use Leave\logout;
$logout = new Leave\logout();
$logout->session_logout();


?>

<?php include "footer.php"; ?>