<?php

session_start();

if (!isset($_SESSION['id'], $_SESSION['email'], $_SESSION['role'])) {
	header('Location: login.php');
	exit();
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>dashboard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet"  href="//getbootstrap.com/docs/4.3/examples/sign-in/signin.css">


</head>
<body class="text-center">

<?php if (isset($message)): ?>

<div class="alert alert-success">

	<?php echo $message; ?>
	
</div>
<?php endif; ?>


<div class="container">
	<div class="alert alert-info">

		you have been logged in as, <?php echo $_SESSION['email']; ?>
		
	</div>

<p>

	<a href="update_profile.php">Update Profile</a>
</p>

<?php if ($_SESSION['role'] == 'admin'): ?>

<p><a href="userlist.php">Users List</a></p>


 <?php endif; ?>


<p>

	<a href="logout.php">Logout</a>
</p>


		
</body>
</html>
