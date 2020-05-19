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
<div class="container-fluid" id="main_part">
  <div class="row">
    <div class="col-md-8 col-md-push-2">
      <section class="row" id="Myself">
     <div class="col-md-12 text-center">
      <h2>About Myself</h2>
      <section id="abmyslf">
    <p>My name is Nursultan Mussa and i am computer science student at Queen Mary University of London </p>
  </section>
  </div>
  <figure id="main_img" class="col-md-8 col-md-push-4">
      <img src="my_image.jpg" class="img-responsive" alt="Nursultan Mussa">
    </figure>
</section>
<div class="row">
<section class="col-md-12">
      <h2 class="Education_title">Education</h2>
    <table class="Education" style="font-size:15px; ">
      <thead>
      <tr>
        <td><p>Years</p></td>
        <td><p>Qualification</p></td>
      </tr>
    </thead>
      <tr>
        <td><p>2019 - Present: </p></td>
        <td><p> Bachelor of Computer Science at Queen Mary University of London  </p></td>
      </tr>
      <tr>
        <td><p>2018 - 2019 : </p></td>
        <td><p> University Foundation Programme (UFP) at The David Game College  </p></td>
      </tr>
      <tr>
        <td><p>2016 - 2018 : </p></td>
        <td><p> IGCSE at The David Game College </p></td>
      </tr>
    </table>
     </section>
   </div>
</div>
<div class="col-md-2 col-md-pull-8">
  <aside>
  <article id="main_box">
 <h3 class="box_title" >Professional skills</h3>
<section class="box_content">
<ul id="list">
  <li>HTML-Hyper Text Markup Language</li>
  <li>CSS- Cascading Style Sheets</li>
  <li>Java</li>
</ul>
</section>
</article>
</aside>
<aside>
<article  id="main_box">
<h3 class="box_title">Research Interests</h3>
<section class="box_content">
  <p>Machine learning</p>
  <p>Image processing</p>
</section>
</article>
</aside>
</div>
<div class="col-md-2">
<aside>
  <article id="main_box">
 <h3 class="box_title"> Most recent post</h3>
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
</article>
</aside>
</div>
</div>
</div>
</div>
<footer>
<p id="footer">Links</p>
<p id="footer">email- <a href="mailto:musa.nursultan@gmail.com" class="links">musa.nursultan@gmail.com</a></p>
<p id="footer">© 2020 Mussa Nursultan</p>
</footer>
</body>
</html>