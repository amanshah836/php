<!DOCTYPE html>
<html>
<head>
<title>Form site</title>
</head>
<body>
<style>
.topright{
   position: absolute;
   top: 8px;
   right: 16px;
   font-size: 18px;
}
</style>
<form method="post" action="#">
email : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="email" required><br><br>
password : <input type="password" name="password" required ><br><br>
<input type="submit" value="login">
</form>
</body>
</html>
<?php
session_start();
 $email = filter_input(INPUT_POST, 'email');
 $password = filter_input(INPUT_POST, 'password');
include('database.php');
 if (!empty($email) || !empty($password)){
	$sql = "SELECT * from users where email = '{$email}' and password = '{$password}'";
	$result = mysqli_query($conn, $sql);
	if($result){
		  $row = mysqli_fetch_assoc($result);
		if ($row['password'] == $password ) {
	      echo"matches successfully";
	      print_r($_SESSION);
	      $_SESSION['id'] = $row['id'];
	      header('location: datafetch.php');
        }   else   {
	      echo "email and password are incorrect";
        }
    }   else   {
		echo "Error: ". $sql ."
		". $conn->error;
    }
 }
?>
<div class="topright">
<br><a href='logout.php'>Logout</a></div>