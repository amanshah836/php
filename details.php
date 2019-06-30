<?php
 $first_name = filter_input(INPUT_POST, 'first_name');
 $last_name = filter_input(INPUT_POST, 'last_name');
 $email = filter_input(INPUT_POST, 'email');
 $password = filter_input(INPUT_POST,'password');
 $confm_Password = filter_input(INPUT_POST,'confm_Password');
 include('database.php');
if (!empty($first_name) || !empty($last_name) || !empty($email)|| !empty($password)|| !empty($confm_Password)) {
	if($confm_Password == $password){
		$emailList = mysqli_query($conn, "SELECT email from users where email = '{$email}'");
	    if ($emailList){
		     $available = mysqli_fetch_assoc($emailList);
	        if (empty($available['email'])){
		        $sql = "INSERT INTO users (first_name, last_name, email, password)
		        values ('$first_name','$last_name','$email','$password')";
				if ($conn->query($sql)){
				    echo "New record is inserted sucessfully";
				}
				else {
					    echo "Error: ". $sql ."
					    ". $conn->error;
				    }
		    } else {
				  echo "Email already exists";
				}
		}   else  {
			    echo "Error: ". $sql ."
			    ". $conn->error;
		    }
		        $conn->close();
    }   else  {
		    echo "passwords do not match";
		     die();
	    }
} else {
		echo "all the fields are required";
	    die();
    }

?>