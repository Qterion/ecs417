<?php include('post.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<title>MNZ</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="gerg.css">
</head>
<body>
<div id="container">
<header>
<hgroup>
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
</hgroup>
</header>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-9" >
     <div class="col-md-8 col-lg-8">
     	<h2>About Myself</h2>
    <p>My name is Nursultan Mussa and i am QMUL stundent</p>
     </div>
 <div class="col-md-3" id="image">
    <figure>
      <img class="responsive" src="Deagle.jpg" alt="Nursultan Mussa">
      <figcaption style="font-size: 10px;">Atyrau 2020</figcaption>
    </figure>
</div>
<div class="col-md-4" id="main_box" >
 <article class="box_title">
  <p>Most recent post</p>
  </article>
  <section class="box_content">
  <?php
  $sql="SELECT * FROM posts ORDER BY id DESC LIMIT 1";
  if($result = mysqli_query($db, $sql)){
  if(mysqli_num_rows($result)>0){
  while($row=$result->fetch_assoc()){?>
   <p class="post_title" style="font-size:16px;"><a style="text-decoration: none; 
  color: inherit;" href="single.php?id=<?php echo $row['id'];?>"><strong><?php echo $row['title'];?></strong></a></p>
  <?php
    $post_cont=$row['post_text']; 
    $strcut=substr($post_cont,0,80);
    $post_cont=substr($strcut,0,strrpos($strcut,' ')).'...';?>
    <p style="font-size:13px;"><strong><?php echo $post_cont;?></strong></p>
  <?php }}else{?>
      <p>No posts yet</p>
    <?php }}?>
</section>
</div>
</div>

<div class="col-md-3">
  <aside>
	<div id="main_box">
<article class="box_title"><p>Hobbies</p></article>
<section class="box_content">
<p>Programming</p>
<p>Cricket</p>
<p>Football</p>
</section>
</div>
</aside>
<aside>
<div id="main_box">
<article class="box_title"><p>Top 5 Movies</p></article>
<section class="box_content">
<p>Avengers-Infinity War</p>
<p>Star Wars-A New Hope</p>
<p>Captain America-Civil War</p>
<p>Matrix</p>
<p>Terminator 2</p>
</section>
</div>
</aside>
</div>
</div>
</div>
</div>
<footer>
<p id="footer">© 2020 Mussa Nursultan</p>
</footer>
</body>
</html>