<?php
session_start();
include('database.php');
if (isset($_SESSION['id'])) { 
  $fquery = $conn->query("SELECT `first_name` FROM `users` WHERE `id` = ".$_SESSION['id']);
  $ffetch = $fquery->fetch_assoc();
  echo"Welcome  ".$ffetch['first_name']."";
?>
<!DOCTYPE html>
<html>
<body>
<style>
  .topright {
    position: absolute;
    top: 8px;
    right: 16px;
    font-size: 18px;
  }
</style>
<table border=1 cellspacing="0" align="center">
<tr>
  <th>Id</th> 
  <th>first_name</th> 
  <th>last_name</th>
  <th>email</th>
  <th>Edit</th>
  <th>Delete</th>
</tr>
<?php
  if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "SELECT id, first_name , last_name , email FROM users";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["first_name"] . "</td><td>"
    . $row["last_name"]. "</td><td>" . $row["email"]. "</td><td> <a href='edit.php?id=".$row["id"]."'>Edit</a></td> <td> <a href='delete.php?id=".$row["id"]."'>Delete</a></td></tr>";
    	} echo "</table>";
    } else { 
   		echo "0 results";
   	}
$conn->close();
?>
</table>
</body>
</html>
<div class="topright">
<br><a href='logout.php'>Logout</a></div>
<?php
} else{
  echo "Please Login to view page";
}
?>