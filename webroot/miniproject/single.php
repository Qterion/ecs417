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
  <div class="row">
    <section class="col-md-8 col-md-push-2" id="top">
      <article class="blog_head">
        <ul class="single_head">
        <li><p class="single_title"><?php echo($post['title']); ?></p></li>
        <li><p id="date" class="pull-right"><strong><?php echo date("jS F, Y,h:i A",strtotime($post['timestamp']));?></strong></p></li>
      </ul>
      </article>
      <ul class="single_body">
      <li><p class="single_content"><?php echo($post['post_text']);?></p></li>
      <li><p class="made_by">Made by: <?php echo($post['user']);?></p></li>
      <?php
      if(isset($_SESSION["user"])){
     $user=$_SESSION["user"];
     if($user=="Admin" OR $user==$post['user']){
      ?>
       <li><p><a href="post.php?post_del=<?php echo $_GET['id'];?>" class="del_btn">Delete</a></p></li>
      <?php
     }}
     ?>
   </ul>
    </section>
    <section class="col-md-8 col-md-push-2">
      <?php if(isset($_SESSION["user"])){ ?>
        <form  method="POST" action="post.php?id=<?php echo $post['id'];?>" id="Comment_form">
        <p><img id="user_img" src="default.png" alt="Default img">
        <input type="text" name="Comment" id="comment" placeholder="Please add your comment"> 
        <input type="button" name="add_comment"  id="list_button" onclick="preventDefault()" value="Add comment"></p>
         </form>
         <?php }else{ ?>
          <p>Please login before adding a comment</p>
            <?php }?>
    <?php
    $post_id=$_GET['id'];
    $sql="SELECT * FROM comments WHERE post_id='$post_id' ORDER BY id DESC";
    if($result=mysqli_query($db,$sql)){
      if(mysqli_num_rows($result)>0){
        while($row=$result->fetch_assoc()){?>  
          <ul class="Comment">
          <li><h5 id="date" class="pull-right"><strong><?php echo date("jS F, Y,h:i A",strtotime($row['comment_time']));?></strong></h5></li>
          <li class="pull-left"><img id="comm_img" src="default.png" alt="Default img"></li>
         <li><p class="comm_username"><strong><?php echo $row['username'];?></strong></p></li>
         <li><p id="comm_content"><strong><?php echo $row['content'];?></strong></p></li>
   
     <?php
     if(isset($_SESSION["user"])){
     $user=$_SESSION["user"];
     if($user=="Admin" OR $user==$row['username']){
      $post_id=$_GET['id'];
      ?>
      <li><a href="post.php?del=<?php echo $row['id']; ?>&id=<?php echo $post_id;?>" class="del_btn">Delete</a></li>
      <?php
     }}
     ?>
     </ul>
     <?php
     } 
     }
     else{?>
      <ul>
      <li><p>Be the first commentator</p></li>
      </ul>
    <?php } }?>

    </section>
  </div>
</div>
</div>
<footer>
<p id="footer">Links</p>
<p id="footer">email- <a href="mailto:musa.nursultan@gmail.com" class="links">musa.nursultan@gmail.com</a></p>
<p id="footer">© 2020 Mussa Nursultan</p>
</footer>
<script type="text/javascript">
  function preventDefault(){
  var count=0;
 if(document.getElementById("comment").value ==""){
  document.getElementById("comment").style.background='#db6e67';
    count=1;
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