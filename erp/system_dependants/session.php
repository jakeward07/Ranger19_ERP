<?php 
// We need to use sessions, so you should always start sessions using the below code.
session_start();
error_reporting(0);
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: /login.php');
	exit();
}

include('db.php');
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $conn->prepare('SELECT us_user, us_name, us_email, us_sec, us_stkadj, us_link, us_polmt, us_site, us_bgimg, us_bgcol FROM usmf WHERE us_id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('s', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($usernm, $name, $email, $sec, $stkadj, $link, $po, $site_cd, $bgimg, $bgcol);
$stmt->fetch();
$stmt->close();


?>
