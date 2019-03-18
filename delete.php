<?php 

require_once 'connection.php';

$id = (int)trim($_GET['id']);

session_start();

//direct to the login page
if (!isset($_SESSION['id'], $_SESSION['email'], $_SESSION['role'])) {
	header('Location: login.php');
	exit();
}
//end of code

if ($_SESSION['role'] !== 'admin') {
	header('Location: dashboard.php');
	exit();
}



if ($id === 0) {
    header('Location: signin.php');
    exit();
}

$query = 'DELETE FROM users WHERE id=:id';


$stmt = $con -> prepare($query);
$stmt ->bindParam(':id', $id, PDO::PARAM_INT);
$stmt ->execute();

header('Location: userlist.php');




 ?>