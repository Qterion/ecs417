<?php 
session_start();

$dbhost = getenv("MYSQL_SERVICE_HOST");
$dbport = getenv("MYSQL_SERVICE_PORT");
$dbuser = getenv("DATABASE_USER");
$dbpwd = getenv("DATABASE_PASSWORD");
$dbname = getenv("DATABASE_NAME");
$db = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
if ($db->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

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
			header('location: index.php');
		}
		else{
			array_push($errors,"The username/password was incorrect");
			header('location: index.php');
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
	header('location: index.php');
}