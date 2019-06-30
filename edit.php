<?php
session_start();
function renderForm($id, $first_name, $last_name, $email,$error) {
	if ($error != ''){
	    echo "$error";
	}
	else {
		echo '
			<html>
			<head>
			<title>Edit Record</title>
			</head>
			<body>
			<style>
    			.topright {
		           position: absolute;
		           top: 18px;
		           right: 18px;
		           font-size: 18px;
		       }
            </style>
			<form action="#" method="post">
			<input type="hidden" name="id" value="'.$id.'"/>
			<div>
			<p>ID '.$id.'</p><br><br><br>
			first_name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="first_name" value=" '.$first_name.'"/><br/><br/><br/>
			last_name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="last_name" value="'.$last_name.'"/><br/><br/><br/>
			email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="email" value="'.$email.'"/><br/><br/><br/>
			<input type="submit" name="login">
			</div>
			</form>
			</body>
			</html>
			';
	    }
}
if (!isset($_SESSION['id'])) {
	echo "Please Login to view page";	
	header('location:login.php');
}
	include('database.php');
if (isset($_POST['login'])) {
	if (is_numeric($_POST['id'])) {
	    $id = $_POST['id'];
	    $first_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['first_name']));
	    $last_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['last_name']));
	    $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
            if ($first_name == '' || $last_name == '' || $email == ''  ) {
				renderForm($id, $first_name, $last_name, $email, '');
				echo '<br>ERROR: Please fill in all required fields!';
			}   else  {
				$result = mysqli_query($conn, "UPDATE users SET first_name='$first_name', last_name='$last_name'
					,email='$email' , password='$password' WHERE id='$id'")
				or die(mysqli_error());
				echo "<br>Update Successful";	
				header('location:datafetch.php');
			}
	}   else  {
	        echo '<br>Error! prior';
	    }
}   else   { 
	    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
		    $id = $_GET['id'];
		    $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id")
		    or die(mysqli_error());
		    $row = mysqli_fetch_array($result);
		    if($row) {
				$first_name = $row['first_name'];
				$last_name = $row['last_name'];
				$email = $row['email'];
				renderForm($id, $first_name, $last_name, $email , '');
            }   else   {
	            echo "<br>No results!";
	        }
	    }   else   {
	            echo '<br>Error! last';
	        }
    }
?>
<div class="topright">
<br><a href='logout.php'>Logout</a></div>