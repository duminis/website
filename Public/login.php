<?php include "header.php"; ?>
<?php include "nav.php"; ?>

<?php

require_once "../Core/config.php";
require_once "../Core/session.php";
//session_start();

if (isset($_SESSION['username']) && $_SESSION['user'] == true) {
  header('location: welcome.php');
}

$error = '';
$email = $password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    if (empty($email)) {
        $error .= '<p class="error">Please enter your email/</p>';
    }
    if (empty($password)) {
        $error .='<p class="error">Please enter your password.</p>';
    }
    if(empty($error)) {
        $sql = "SELECT email, password_hash, username FROM users WHERE email = ?";

        if ($query = mysqli_prepare($db, $sql)) {

            mysqli_stmt_bind_param($query, "s", $email);

            if (mysqli_stmt_execute($query)) {

                mysqli_stmt_store_result($query);

                if (mysqli_stmt_num_rows($query) == 1) {

                    mysqli_stmt_bind_result($query, $email, $password_hash, $username);
                    if (mysqli_stmt_fetch($query)) {
                        if (password_verify($password, $password_hash)) {
                            $_SESSION['username'] = $username;
                            $_SESSION['user'] = true;
                            header('location: welcome.php');
                            exit;
                        } else {
                            $error .= '<p class="error">The password is not valid.</p>';
                        }
                    }
                } else {
                    $error .= '<p class="error"> No user exists with that email address.</p>';
                }
            }
            mysqli_stmt_close($query);
        }
    }
        mysqli_close($db);
    }
?>
<body>
<div class="container">
    <form action="" method="POST">
    <div class="form-input">
        <h2>Login</h2>
        <?php echo $error; ?>
        <p>Please enter your email and password.</p>
        <label for="email">Email</label>
        <input type="email" name="email" class="email" id="email" required>
    </div>
    <div class="form-input">
        <label for="password">Password</label>
        <input type="password" name="password" class="password" id="password" required>
    </div>
    <input type="submit" name="submit" value="Login">
    </form>
</div>
</body>

<?php include "footer.php"; ?>