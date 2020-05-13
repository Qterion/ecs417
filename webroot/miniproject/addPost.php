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

	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'http://localhost/miniproject/viewBlog.php');

// variable declaration
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
	header("Location:viewBlog.php");
}