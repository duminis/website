<?php include "header.php"; ?>
<?php include "nav.php"; ?>

<?php
session_start();
require_once "../Core/config.php";
require_once "../Core/session.php";

if (!isset($_SESSION['username']) || $_SESSION['user'] == !true) {
  header('location: login.php');
}

?>
<body>
<div class="container">
        <h2>Hello, <?php echo $_SESSION['username']; ?> You are logged in.</h2>
</div>
</body>
<?php include "footer.php"; ?>