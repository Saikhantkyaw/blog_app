<?php
   session_start();
  require("connection/config.php");
  if ($_POST)
   {   if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) ||
        strlen($_POST['password']) < 4) {

     if (empty($_POST['name'])) {
       $name_err="* you need to fill name";
     }
     if (empty($_POST['email'])) {
       $email_err="* you need to fill email";
     }
     if (empty($_POST['password'])) {
       $password_err="* you need to fill password";
     }
     if ( strlen($_POST['password']) < 4) {
      $password_err="* your password must be 4 at least";
     }
     }else{
      $name=$_POST['name'];
    $email=$_POST['email'];
    $password=password_hash($_POST['password'], PASSWORD_DEFAULT);

    $statment= $pdo->prepare("SELECT * FROM users WHERE email= :email");
    $statment->BindValue(':email',$email);
    $statment->execute();
    $user=$statment->fetch(PDO::FETCH_ASSOC);

  if($user){
        echo " <script>alert('your email is already taken')</script> ";
  }else{
        $statment=$pdo->prepare("INSERT INTO users(name,email,password,role)
         VALUES (:name,:email,:password,:role)");
        $result=$statment->execute(
        array(':name'=>$name,':email'=>$email,':password'=>$password,':role'=>0)
        );
        if ($result)
        {
  echo "<script>alert('successfully register');window.location.href='login.php'</script>";
        }

  }

     }
    

    }

  

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Blog</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Register</p>

      <form action="register.php" method="post">
        <p class="text-danger"><?= empty($name_err)?'':$name_err;?></p>
         <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Name" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <p class="text-danger"><?= empty($email_err)?'':$email_err;?></p>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <p class="text-danger"><?= empty($password_err)?'':$password_err;?></p>
        <div class="input-group mb-3">
          <input type="password"  name="password"  class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <div class="row">
        
          <!-- /.col -->
            <div class="container">
            <button type="submit" class="btn btn-primary btn-block">Sing up</button>

            <a href="login.php" class="btn btn-warning btn-block ">Log in</a>
          </div>
          <!-- /.col -->
        </div>
      </form>

     
      <!-- /.social-auth-links -->

      
      <!-- <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
