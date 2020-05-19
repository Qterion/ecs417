<?php
 require_once('post.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>MNZ</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="reset.css">
<link rel="stylesheet" type="text/css" href="my_styles.css">
</head>
<body>
<div id="container">  
<header>
<nav class="navbar navbar-inverse" id="nav">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Nursultan Mussa</a>
    </div>
     <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="viewBlog.php">Blog</a></li>
        <li><a href="My_projects.php">My projects</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <?php if(isset($_SESSION["user"])){ ?>
        <li><p id="welcome_user"> Welcome <strong><?php echo $_SESSION['user'];?></strong></p></li>
      <li><a href="logout.php?logout='1'"><span class="glyphicon glyphicon-log-out" data-toggle="modal" data-target="#LogoutForm"></span> Logout</a></li>
  <?php }else{ ?>
      <li><a href="register.html"><span class="glyphicon glyphicon-user" ></span> Sign Up</a></li>
      <li><a href="login.html"><span class="glyphicon glyphicon-log-in" data-toggle="modal" data-target="#LoginForm"></span> Login</a></li>
  <?php }?>
   </ul>
    </div>
  </div>
</nav>
</header>
<div class="container-fluid" >
  <div class="row" >
    <div class="col-md-8 col-md-push-2" id="top">
      <h1 id="page_title">Welcome to the blog page</h1>
      <nav class="blog_list">
        <ul>
        <li id="post_add">Want to add a new post?
        <?php if(isset($_SESSION["user"])){ ?>
        Click this <a href="addPost.html"><button name="register" id="list_button">Button</button></a>
         <?php }else{ ?>
            Please login to the website<a href="login.html"><button name="register" id="list_button">Login</button></a>
          <?php }?>
          </li>
        </ul>
        <div class="pull-right">
        <form  method="POST" action="post.php">
        <label for="months">Filter by month:</label>
<select id="months" name="month">
  <option value="0">Any</option>
  <option value="1">January</option>
  <option value="2">February</option>
  <option value="3">March</option>
  <option value="4">April</option>
  <option value="5">May</option>
  <option value="6">June</option>
  <option value="7">July</option>
  <option value="8">August</option>
  <option value="9">September</option>
  <option value="10">October</option>
  <option value="11">November</option>
  <option value="12">December</option>
</select>
<input type="button" name="post" id="list_button" onclick="this.form.submit()" value="Submit">
</form>
</div>
      </nav>
    </div>
  </div>
<div class="row">
 <section class="col-md-8 col-md-push-2">
  <?php
  if(isset($_GET['month'])){
   $month=$_GET['month'];
   if($_GET['month']==0){
    $sql="SELECT * FROM posts ORDER BY id DESC";
   }
   else{
   $sql="SELECT * FROM posts WHERE month(timestamp)='$month' ORDER BY id DESC";
   }

   } else {
   $sql="SELECT * FROM posts ORDER BY id DESC";
   }
    if($result = mysqli_query($db, $sql)){
  if(mysqli_num_rows($result)>0){
  while($row=$result->fetch_assoc()){?>
    <div class="post">
    <ul >
    <li><h5 id="date" class="pull-right"><strong><?php echo date("jS F, Y,h:i A",strtotime($row['timestamp']));?></strong></h5></li>
    <li><p class="post_title"><a class="title_link" href="single.php?id=<?php echo $row['id'];?>"><strong><?php echo $row['title'];?></strong></a></p></li>
    <?php
    $post_cont=$row['post_text']; 
    $strcut=substr($post_cont,0,50);
    $post_cont=substr($strcut,0,strrpos($strcut,' ')).'...';?>
      <li><p><strong><?php echo $post_cont;?></strong></p></li>
      <li><p class="made_by"><strong>Made by: <?php echo $row['user'];?></strong></p></li>
      <?php
      if(isset($_SESSION["user"])){
     $user=$_SESSION['user'];
     if($user=="Admin" OR $user==$row['user']){
      ?>
       <li style="float:left"><p><a href="post.php?post_del=<?php echo $row['id'];?>" class="del_btn">Delete</a></p></li>
      <?php
     }}
     ?>
     <li><a href="single.php?id=<?php echo $row['id'];?>"><button id="corner_button">Read more</button></a></li>
        </ul>
      </div>
    <?php }}else{?>
      <ul>
      <li><p>No posts yet</p></li>
      </ul>
    <?php }}?>
  
  </section>
</div>
</div>
</div>
<footer>
<p id="footer">Links</p>
<p id="footer">email- <a href="mailto:musa.nursultan@gmail.com" class="links">musa.nursultan@gmail.com</a></p>
<p id="footer">© 2020 Mussa Nursultan</p>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>