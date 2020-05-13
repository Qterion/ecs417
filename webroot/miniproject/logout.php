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
	
if(isset($_GET['logout']))
{
	logout();
}
function logout(){
	session_destroy();
	unset($_SESSION['user']);
	header('location: index.php');
}