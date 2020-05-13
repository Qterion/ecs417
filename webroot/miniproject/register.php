<?php 
session_start();

// connect to database
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

if (isset($_POST['user'])) {
	register();
}
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}
function register(){
	global $db, $username, $email,$password;
	$password =  e($_POST['password']);
	$user    =  e($_POST['user']);	
	$sql_user="SELECT * FROM user_list WHERE user='$user'";
	$result=mysqli_query($db,$sql_user);	

    	if(mysqli_num_rows($result)>0){
    	header('location: register.html');
	    }
	else
	{
		$password = md5($password);
		if (isset($_POST['user'])) 
		{
			$user_type = e($_POST['user']);
			$query = "INSERT INTO user_list (user,password) VALUES('$user','$password')";
			mysqli_query($db, $query);
			$_SESSION['user']=$user;
			$_SESSION['success']="you are now logged in";
			header('location: index.php');
		}
		else
		{
			$query = "INSERT INTO user_list (username,password) VALUES('$user','$password')";
			mysqli_query($db, $query);
			$logged_in_user_id = mysqli_insert_id($db);			
		}
	}
}