<?php 
session_start();
 require("connection/config.php");
  require("connection/common.php");
 if (empty(  $_SESSION['user_id'])&&empty(  $_SESSION['logged_in'])) 
 {
  header("Location:login.php");
   
}
 $statment=$pdo->prepare("SELECT * FROM posts WHERE id=".$_GET['id']);
 $statment->execute();
 $result= $statment->fetchall();


$post_id= $_GET['id'];

 $statment1=$pdo->prepare("SELECT * FROM comments WHERE post_id=$post_id");
 $statment1->execute();


 $cmresult= $statment1->fetchall();
 $userresult=[];
 foreach ($cmresult as $key => $value) {
 $au_id=$cmresult[$key]['user_id'];
 
 $statment2=$pdo->prepare("SELECT * FROM users WHERE id=$au_id");
 $statment2->execute();
 $userresult[]= $statment2->fetchall();
 }

 //$post_id=$_GET['id'];
 if ($_POST) {
    if (empty($_POST['comment'])) {
      $cmt_err="you need to fill comment";
    }else{$comment=$_POST['comment'];
      $statment=$pdo->prepare("INSERT INTO comments(content,user_id,post_id)
         VALUES (:content,:user_id,:post_id)");
        $result=$statment->execute(
        array(':content'=>$comment,':user_id'=>$_SESSION['user_id'],':post_id'=>$post_id)
        );
        if ($result)
        {
          header("Location:blogdetail.php?id=".$post_id);
        }}
    


 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Widgets</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
 
  <!-- Main Sidebar Container -->
  

  <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
       
        <div class="row">
          <div class="col-md-12">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
               <div class="user-block" style="text-align: center !important;float:none;">
                <h4><?=mo($result[0]['title']); ?></h4>
                </div>
              
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
               <img src="admin/images/<?php echo $result[0]['image']; ?>"alt="" class="img-fluid pad">
               <p><?=$result[0]['content'] ?></p> 
              </div>
              <h3>Comment</h3>
              
              <!-- /.card-body -->
              <div class="card-footer card-comments">
                <div class="card-comment" style="margin:left  !important;">
                
                  <?php if ($cmresult) { ?>
                    <div class="comment-text" >
                    <?php foreach ($cmresult as $key => $value): ?>
                      <span class="username" style="margin:left  !important;">
                      <?php echo mo($userresult[$key][0]['name']); ;?>
                      <span class="text-muted float-right">
                        <?php echo $value['created_at'] ?></span>
                    </span><!-- /.username -->
                    <?php echo mo($value['content']); ?>
                    <?php endforeach ?>
                  </div>
                  <?php } ?>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
               
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                <form action="" method="POST">
                  <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
                  <!-- .img-push is used to add margin to elements next to floating images -->
                  <p class="text-danger"><?= empty($cmt_err)?'':$cmt_err;?></p>
                  <div class="img-push">
                    <input type="text"  name="comment"class="form-control form-control-sm" placeholder="Press enter to post comment">
                  </div>
                </form>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->
 <footer class="main-footer" style="margin-left: 0px !important;">
    <div class="float-right ">
     <a href="logout.php" class="btn btn-dark">Log out</a>
      <a href="index.php" class="btn btn-warning">Back</a>
    </div>
    <strong>Copyright &copy; 2020 <a href="https://adminlte.io">Sai Khant kyaw</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
