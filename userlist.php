<?php 

require_once 'connection.php';

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

$query = 'SELECT * FROM users ORDER BY id DESC';

$stmt = $con->query($query);
$stmt->execute();

$users = $stmt->fetchAll();

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


<div class="container">
	<h1>User list</h1>
<a href="dashboard.php">Back</a>

	<table class="table table-bordered table-hover">

	<thead>
		
		<tr>
			
			<td>Id</td>
			<td>Email</td>
			<td>Photo</td>
			<td>Action</td>

		</tr>
	</thead>

	<tbody>

		<?php foreach ($users as $user): ?>
			<tr>
			
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td>
				<img src="../uploads/photo/<?php echo $user['photo']; ?>" alt="something" width="50">
			</td>

			<td>
				
		<a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-info">Edit</a>
		<a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');" >Delete</a>
			</td>

		</tr>
	<?php endforeach;  ?>
	</tbody>


	
</table>


</div>
</body>
</html>

