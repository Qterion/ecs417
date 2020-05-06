<?php include('post.php');
?>
<?php 
if(isset($_GET['id'])){
	$post=getPost($_GET['id']);
}
else{
	echo("nothing here");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>MNZ</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="ded.css">
</head>
<body>
<header>
<nav class="navbar navbar-inverse" id="nav">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="mini.php">Nursultan Mussa</a>
    </div>
     <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="blog.php">Blog</a></li>
        <li><a href="#">Links</a></li>
        <li><a href="#">My projects</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <?php if(isset($_SESSION["user"])){ ?>
        <li><p id="welcome_user"> Welcome <strong><?php echo $_SESSION['user'];?></strong></p></li>
      <li><a href="mini.php?logout='1'"><span class="glyphicon glyphicon-log-out" data-toggle="modal" data-target="#LogoutForm"></span> Logout</a></li>
  <?php }else{ ?>
      <li><a href="register.php"><span class="glyphicon glyphicon-user" ></span> Sign Up</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in" data-toggle="modal" data-target="#LoginForm"></span> Login</a></li>
  <?php }?>
   </ul>
    </div>
  </div>
</nav>
</header>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="blog_head">
				<p class="post_title"><?php echo($post['title']); ?></p>
				<h5 id="date" class="pull-right"><strong><?php echo date("jS F, Y,h:i A",strtotime($post['timestamp']));?></strong></h5>
			</div>
		</div>
		<div class="col-md-8">
			<p><?php echo($post['post_text']);?></p>
		</div>
    <div class="col-md-8">
      <ul>
      <?php if(isset($_SESSION["user"])){ ?>
         <div  id="err_message">
         </div>
        <form  method="POST" action="post.php?id=<?php echo $post['id'];?>" id="Comment_form">
        <li>Add your coment</li>
        <li><input type="text" name="Comment" id="comment"/><br /></li>
        <li><input type="button" name="add_comment"  id="log_reg" class="btn" onclick="Submit()" value="Add comment"></li>
         </form>
         <?php }else{ ?>
          <li><p>Please login before adding a comment</p><li>
            <?php }?>
          </ul>
    </div>
    <div class="col-md-8">
   fewf
</div>
	</div>
</div>
<script type="text/javascript">
  function Submit(){
  var count=0;
  document.getElementById("err_message").innerHTML = "";
 if(document.getElementById("comment").value ==""){
    count=1;
    document.getElementById("err_message").innerHTML += "Please add some comments <br />";
  }
if(count==0){
  document.getElementById("Comment_form").submit();
}
}
  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>