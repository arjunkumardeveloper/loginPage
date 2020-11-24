<?php
/**
 * The file doc comment
 * php version 7.2.10
 * 
 * @category Class
 * @package  Package
 * @author   Original Author <author@example.com>
 * @license  https://www.cedcoss.com cedcoss 
 * @link     link
 */
session_start();
if (!empty($_SESSION['username'])) {   
    if ($_SESSION['username'] != "") {
        header('location:members/index.php');
    }
}
require 'config.php';

$error = '';
if (isset($_POST['submit'])) {
    $username = isset($_POST['username'])?$_POST['username']:"";
    $password = isset($_POST['password'])?$_POST['password']:"";

    $sql = "SELECT * FROM users WHERE `username` = '$username' AND 
	`password` = '$password'";
    $res = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($res);

    if ($username == $data['username'] && $password == $data['password']) {
        $_SESSION['username'] = $username;
        header('location: members/index.php');
    } else {
        $error = "<p>Invalid Username Or Password !</p>";
    }
}
require 'header.php';
?>

<div id="wrapper">
    <div class="msg">
        <?php echo $error; ?>
    </div>
    <div id="login-form">
        <h2>Login</h2>
            <form action="" method="POST" autocomplete="off">
                <div class="form-group">
                    <label for="username">Username: </label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="password" 
                    class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Login">
                    <a href="signup.php" class="back">Signup</a>
                </div>
            </form>
    </div>
</div>
<?php require 'footer.php'; ?>