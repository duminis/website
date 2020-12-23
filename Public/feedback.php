<?php include "header.php"; ?>
<?php include "nav.php"; ?>

<?php
require_once "../Core/config.php";
require_once "../Core/session.php";
//session_start();

$loginrequired='';
$blankcomment='';
$submit='';
$comment='';
//$_SESSION['username']='';
//$_SESSION['user']='';
//var_dump($_SESSION['username']);
//var_dump($_SESSION['user']);

if (!isset($_SESSION['username']) && $_SESSION['user'] == !true) {
   $_SESSION['username']='';
   $_SESSION['user']='';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_SESSION['username'];
    $comment = $_POST['comment'];
    $submit = $_POST['submit'];
    $date = date("Y-m-d H:i:s");
    if ($name && $comment) {
        $insertQuery = $db->prepare("INSERT INTO comments (name, comment, date) VALUES (?, ?, ?)");
        $insertQuery->bind_param("sss", $name, $comment, $date);
        $result = $insertQuery->execute();
    } else {
        if (empty($comment)) {
            $blankcomment .= '<a>Error: Please leave a comment.</a> <br>';
        }
        if (empty($_SESSION['username'])) {
            $loginrequired .= '<a>Error: Login Required</a>';
        }
    }
}

?>

<?php

?>
<?php
$getquery=mysqli_query($db,"SELECT * FROM comments ORDER by id DESC limit 4");
echo '<h2>What people think about us</h2>' . '<br />' . '<br />';
while($rows=mysqli_fetch_assoc(($getquery)))
{
    $id=$rows['id'];
    $name= $rows['name'];
    $comment=$rows['comment'];
    $date=$rows['date'];
    //echo 'Recent Comments: <br /><style font-family: Arial/>';
    echo '<div class="feedback">';
    echo "$name $date - $comment<br><br>";

    //echo $name . ' ' . $date . '<br />' . $comment . '<br />' . '<hr width="500px" />';
}

?>
<body>
    <div class="block">
        <form action="" method="POST">
            <table>
                <p>Leave a Comment </p>
                <p><?php echo $blankcomment; echo $loginrequired ?></p>
                <p><?php echo $_SESSION['username']; ?>:</p>
                <tr><td><textarea type="text" name="comment" rows="5" cols="50"></textarea></td></tr>
                <tr><td><input type="submit" name="submit" value="Send Comment"/></td></tr>
            </table>
        </form>
    </div>
</div>
</body>

<?php include "footer.php"; ?>