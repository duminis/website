<?php

require_once "../Core/config.php";
require_once "../Core/session.php";

?>
<?php
session_start();

//$_SESSION['user']='';
$logout = '';
$login = '';
$register = '';
if (isset($_SESSION['username']) && $_SESSION['user'] == true) {
    $logout .= '<a href="logout.php">Logout</a>';
}
if (empty($_SESSION['username']) && $_SESSION['user'] == !true) {
    $_SESSION['user']='';
    $login .= '<a href="login.php">Login</a>';
}
if (empty($_SESSION['username']) && $_SESSION['user'] == !true) {
    $_SESSION['user']='';
    $register .= '<a href="register.php">Register</a>';
}

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<div class="nav">
<div class="navbar-left">
    <a class="active"><a href="index.php">Home</a>
        <a href="feedback.php">Feedback</a>
</div>
<div class="navbar-right">
    <?php echo $login ?>
    <?php echo $logout; ?>
    <?php echo $register; ?>
</div>
</div>