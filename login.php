<?php 

session_start();
//direct to the login page
if (isset($_SESSION['id'], $_SESSION['email'], $_SESSION['role'])) {
	header('Location: dashboard.php');
	exit();
}
//end of code



if (isset($_POST['login'])) {

$email = trim($_POST['email']);
$password = trim($_POST['password']);


require_once 'connection.php';

$query = 'SELECT id,email,password,role FROM users WHERE email=:email';

 
//email exit or not

$stmt = $con->prepare($query);
$stmt->bindParam(':email', $email);
$stmt->execute();

$user = $stmt->fetch();


//password varify

 if ($user) {
 
 if (md5($password, $user['password']) == true) {
 	
 	$message = 'login successful.';

 	$_SESSION['id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];



    header('Location: dashboard.php');

 }else{

 	$message = 'try again';
 }
 } else{

 	$message = 'Invalid';
 }

 }
 ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>User login Form</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<link rel="stylesheet"  href="//getbootstrap.com/docs/4.3/examples/sign-in/signin.css">


</head>
<body class="text-center">

    <form class="form-signin" action="" method="post" enctype="multipart/form-data" > 
    	
  <?php if (isset($message)): ?>

<div class="alert alert-success">

	<?php echo $message; ?>
	
</div>
<?php endif; ?>

  	<div class="container-fluid">
  	
  			<div class="jumbotron bg-danger">
  			
  					
  				
 	  
  <h1 class="h3 mb-3 font-weight-normal">User Login</h1>

  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>

  <label for="inputPassword" class="sr-only">Password</label>

  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
  

  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>

  <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Login</button>

<hr?>
 
  	<a href="signin.php">Register</a>

 				
	</div>


			</div>
      
</form>
</body>
</html>