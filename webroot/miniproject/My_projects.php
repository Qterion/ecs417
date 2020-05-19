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
<div class="container-fluid">
  <div class="col-md-8 col-md-push-2">
  <div class="row">
    <article id="top">
    <p id="page_title">My Recent Projects</p>
  </article>
    <section  id="project" >
      <p id="title">Booby-Trapped Castle</p>
      <p>It is a simple text based multiplayer rpg castle exploration game. I have spent two weeks creating this project. Features of this game include: Maximum of 4 users can play this game at the same time and items in every room are randomly generated, allowing for a unique experience every round. </p>
      <p >Link to the project: <a href="castle.pdf"  class="links">Download</a></p>
    </section>
    <section id="project" >
      <p id="title">Car race Simulator</p>
      <p> This is a quick 2D based drag racing game, where users can select a race car of their choice and compete against a computer vehicle on different tracks. This project was created over the course of a month.  </p>
      <p>Link to the project: <a href="car.zip"  class="links">Download</a></p>
    </section>
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