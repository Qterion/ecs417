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

$username = "";
$email    = "";
$errors   = array(); 
$month="";

if(isset($_POST['Title'])){
	addpost();
}

function addpost(){
	global $db,$title,$post_text;
	$title =  e($_POST['Title']);
	$post_text   =  e($_POST['Post_text']);
	$user=$_SESSION['user'];
	$query = "INSERT INTO posts (title,post_text,user) VALUES('$title','$post_text','$user')";
	mysqli_query($db, $query);
	header("Location:blog.php");
}

if (isset($_POST['login'])){
	login();
}
function login(){
	global $db, $errors, $username, $email,$password;
	$user    =  e($_POST['user']);
	$password =  e($_POST['password']);
	if (empty($user)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($password)) { 
		array_push($errors, "Password is required"); 
    }
    if (count($errors) ==0) {
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
		}
	}

}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}
function get_month(){
	global $month;
	echo($month);
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