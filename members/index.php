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
if ($_SESSION['username'] == "") {
    header("LOCATION:../login.php");
}
?>
<div class="container" style="margin:0px 20px;">
    <h3 style="display:inline;">Welcome <?php echo 
    ucfirst($_SESSION['username']); ?></h3>
    <a href="../logout.php" style="float:right;">Logout</a>
</div>