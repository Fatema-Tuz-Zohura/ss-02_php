<?php 

session_start();

//direct to the login page
if (isset($_SESSION['id'], $_SESSION['email'], $_SESSION['role'])) {
	header('Location: dashboard.php');
	exit();
}
//end of code




if (isset($_POST['register'])) {

if (!empty($_FILES['photo']['name'])) {

	$file = $_FILES['photo']['tmp_name'];
	$file_parts = explode('.', $_FILES['photo']['name']);
	$extension = end($file_parts);
	$filename = uniqid('photo_', true) .time() . '.' . $extension;
	$destination = '../uploads/photo/' .  $filename;

  //die($filename);
 move_uploaded_file($file, $destination);

}



if (!empty($_POST['email']) && !empty($_POST['password'])) {
	
	require_once 'connection.php';

	$email  = trim($_POST['email']);
	$password  = trim($_POST['password']);
	$password = password_hash($password, PASSWORD_BCRYPT);

	try{

//sql query
		$query='INSERT INTO users (email,password,photo) VALUES (:email,:password,:photo)';

//pdo sql execute
$stmt = $con -> prepare($query);
$stmt ->bindParam(':email', $email);
$stmt ->bindParam(':password', $password);
$stmt ->bindParam(':photo', $filename);
$stmt ->execute();
$con ->lastInsertId();


$message = 'Your Registration are done successfully.Thank you.';

	}catch(Exception $e){

		$message = $e -> getMessage();


	}


}

else{

$message = 'please provide all the info';	
}

}

 ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>User Registration Form</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet"  href="//getbootstrap.com/docs/4.3/examples/sign-in/signin.css">


</head>
<body class="text-center">

<?php if (isset($message)): ?>

<div class="alert alert-success">

	<?php echo $message; ?>
	
</div>
<?php endif; ?>

    <form class="form-signin" action="" method="post" enctype="multipart/form-data" > 
  <div class="jumbotron bg-danger">
  	
  
  <h1 class="h3 mb-3 font-weight-normal">User Registration</h1>

  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>

  <label for="inputPassword" class="sr-only">Password</label>

  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
  
<label for="inputPhoto" class="sr-only">Photo</label>
  
<input type="file" name="photo" id="inputphoto" class="form-control"><br/>

  <button class="btn btn-lg btn-primary btn-block" name="register" type="submit">Register</button>

</div>

<hr/>

<p>
	<a href="login.php">login</a>
</p>

  </form>
</body>
</html>