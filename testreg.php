<?php
session_start();
if(isset($_SESSION["session_username"])){
header("Location: intropage.php");
}

?>
<?php require_once("bd.php");?> 
<?php
	if(isset($_POST["login"])){
	if(!empty($_POST['login']) && !empty($_POST['password'])) {
	$login=htmlspecialchars($_POST['login']);
	$password=htmlspecialchars($_POST['password']);
	$query =mysqli_query($db,"SELECT * FROM customers WHERE login='".$login."' AND password='".$password."'");
	$numrows=mysqli_num_rows($query);
	if($numrows!=0)
 {
while($row=mysqli_fetch_assoc($query))
 {
	$_SESSION['id'] = $row['id'];
	$dbusername=$row['login'];
  $dbpassword=$row['password'];
  $_SESSION['status'] = $row['status'];
 }
  if($login == $dbusername && $password == $dbpassword)
 {
	// старое место расположения
	//  session_start();
	 $_SESSION['auth'] = true;
	 
     $_SESSION['session_username']=$login;
     if(isset($_SESSION["session_username"])){
        echo '<meta http-equiv="refresh" content="0;URL=/intropage.php">';
        
        }
	}
	} else {
	//  $message = "Invalid username or password!";
	
	echo  "Invalid username or password!";
 }
	} else {
    $message = "All fields are required!";
	}
	}
?>