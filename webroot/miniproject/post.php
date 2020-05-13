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
function getPost($slug){
	global $db;
	// Get single post slug
	$id = $_GET['id'];
	$sql = "SELECT * FROM posts WHERE id='$id'";
	$result = mysqli_query($db, $sql);

	// fetch query results as associative array.
	$post = mysqli_fetch_assoc($result);
	return $post;
}
if (isset($_POST['month'])){
	global $month;
	$month=e($_POST['month']);
	header("Location:viewBlog.php?month=$month;");
}
if (isset($_POST['Comment'])){
add_comment();
}
function add_comment(){
global $db, $errors, $username, $email,$password;
$user    =  $_SESSION['user'];
$post_id=e($_GET['id']);
$comment=e($_POST['Comment']);
$query = "INSERT INTO comments (post_id,username,content) VALUES('$post_id','$user','$comment')";
mysqli_query($db, $query);
header("location: single.php?id=".$post_id."");
}
if(isset($_GET['post_del'])){
	global $db;
	$id = $_GET['post_del'];
	$query = "DELETE FROM comments WHERE post_id='$id'";
	mysqli_query($db,$query);
	$query= "DELETE FROM posts WHERE id='$id'";
	mysqli_query($db,$query);
	header("location: viewBlog.php");
}
if (isset($_GET['del'])) {
	global $db;
	$id = $_GET['del'];
	$query = "DELETE FROM comments WHERE id='$id'";
	mysqli_query($db,$query);
    header("location: single.php?id=".$_GET['id']."");
}

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
	header('location: index.php');
}