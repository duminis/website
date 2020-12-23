<?php include "header.php"; ?>
<?php include "nav.php"; ?>

<?php
require_once "../Core/config.php";
require_once "../Core/session.php";
$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] === "POST" && ISSET($_POST['submit'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $telephone=trim($_POST['telephone']);
    $address=trim($_POST['address']);
    $postcode=trim($_POST['postcode']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
        $query->bind_param('s', $email);
        $query->execute();
        $query->store_result();
        if ($query->num_rows > 0) {
            $error .='<p class="error">The email address is already registered!</p>';
        } else {
            if (strlen($password ) < 6) {
                $error .= '<p class="error"> Password must have at least 6 characters!</p>';
            }
            if (empty($confirm_password)) {
                $error .='<p class="error">Please enter confirm password.</p>';
            } else {
                if (empty($error) && ($password != $confirm_password)) {
                    $error .= '<p class="error">Password did not match.</p>';
                }
            }
            if (empty($error)) {
                $insertQuery = $db->prepare("INSERT INTO users (username, email, telephone, address, postcode, password, confirm_password, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ? );");
                $insertQuery->bind_param("ssssssss", $username, $email, $telephone, $address, $postcode, $password, $confirm_password, $password_hash);
                $result = $insertQuery->execute();
                if ($result) {
                    $success .='<p class="success">Your registration was successful!</p>';
                } else {
                    $error .='<p class="error">Something went wrong!</p>';
                }
            }
        }
    }
  $query->close();
  $insertQuery->close();
  mysqli_close($db);

}
?>
<body xmlns="http://www.w3.org/1999/html">
<div class="container">
            <form action="" method="post">
            <div class="form-input">
                <h2>Registration</h2>
                <?php echo $success; ?>
                <?php echo $error; ?>
                <label for="username">Full Name</label>
                <input type="text" name="username" class="username" id="username" required>
                </div>
                <div class="form-input">
                <label for="email">Email</label>
                <input type="text" name="email" class="email" id="email" required>
                </div>
                <div class="form-input">
                <label for="password">Password</label>
                <input type="password" name="password" class="password" id="password" required>
                </div>
                <div class="form-input">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" class="confirm_password" id="confirm_password" required>
                </div>
                    <div class="form-input">
                        <label for="telephone">Telephone Number</label>
                        <input type="number" name="telephone" class="telephone" id="telephone">
                    </div>
                    <div class="form-input">
                        <label for="address">Street Address</label>
                        <input type="text" name="address" class="address" id="address">
                    </div>
                <div class="form-input">
                    <label for="postcode">Postcode</label>
                    <input type="text" name="postcode" class="postcode" id="postcode">
                </div>
                    <div class="form-input">
                        <input type="submit" value="Submit" name="submit" id="submit">
                    </div>
            </form>
    </div>
</div>
</body>
<?php include "footer.php"; ?>
