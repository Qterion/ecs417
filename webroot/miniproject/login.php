<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'users');

// variable declaration
$username = "";
$email    = "";
$errors   = array(); 
$month="";

if (isset($_POST['username'])){
	login();
}
function login(){
	global $db, $errors, $username, $email,$password;
	$user    =  e($_POST['username']);
	$password =  e($_POST['password']);
		$password = md5($password);
		$query="SELECT*FROM user_list WHERE user='$user' AND password='$password'";
		$result=mysqli_query($db,$query);
		if(mysqli_num_rows($result)==1){
			$_SESSION['user']=$user;
			$_SESSION['success']="you are now logged in";
			header('location: mini.php');
		}
		else{
			array_push($errors,"The username/password was incorrect");
			header('location: mini.php');
		}

}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}
function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}
if(isset($_GET['logout']))
{
	logout();
}
function logout(){
	session_destroy();
	unset($_SESSION['user']);
	header('location: mini.php');
}