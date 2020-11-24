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
require 'config.php';
$errors = array();
$success = "";
$loginLink = "";

if (isset($_POST['submit'])) {
    $username = isset($_POST['username'])?$_POST['username']:"";
    $password = isset($_POST['password'])?$_POST['password']:"";
    $password2 = isset($_POST['password2'])?$_POST['password2']:"";
    $email = isset($_POST['email'])?$_POST['email']:"";

    if ($password != $password2) {
        $errors[] = array("input"=>"username", "msg"=>"<p>Password doesn't match!
        </p>");
    }

    if (count($errors) == 0) {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $res = mysqli_query($conn, $sql);
        $selectUsername = mysqli_num_rows($res);
        // exit();
        
        if ($selectUsername == 0) {

            $sql = "INSERT INTO users (`username`, `password`, `email`) VALUES
            ('$username', '$password', '$email')";
                
            if (mysqli_query($conn, $sql)) {
                $success = "<p>Registration successfully</p>";
                $loginLink = "<a href='login.php'>Go Login Page</a> Or wait 5
                second you will automatically redirect to your login page.    
                <script>
                    setTimeout(arjun, 5000);
                    function arjun() {
                         window.location = 'login.php';
                    }
                </script>";
                
            } else {
                $errors[] = array('input'=>'form', mysqli_error($conn));
            }
        } else {
            $errors[] = array('input'=>'form', 'msg'=>'<p>Sorry! This Username
            Is Already Exists.</p>');
        }
    }
    mysqli_close($conn);
}
require 'header.php';
?>
<div id="wrapper">
    <div class="success">
        <?php echo $success; ?>
    </div>
    <div class="error">
        <?php if (count($errors) > 0) : ?>
            <?php foreach ($errors as $value) : ?>
                <?php echo $value['msg']; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div id="signup-form">
        <h2>Sign Up</h2>
        <form action="signup.php" method="POST" autocomplete="off">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" name="password" class="form-control"
                    required>
            </div>
            <div class="form-group">
                <label for="password2">Re-Password: </label>
                <input type="password" name="password2" class="form-control"
                    required>
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Submit">
                <a href="login.php" class="back">Back</a>
            </div>
        </form>
        <div class="success">
            <?php echo $loginLink; ?>
        </div>
    </div>
</div>
<?php require 'footer.php'; ?>