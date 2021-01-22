<?php 
 session_start();
 require("../connection/config.php");
  require("../connection/common.php");
 if (empty(  $_SESSION['user_id'])&&empty(  $_SESSION['logged_in'])) 
 {
 	header("Location:login.php");
 }
 if ($_POST) { 
  if (empty($_POST['title']) || empty($_POST['content'])  ) {

     if (empty($_POST['title'])) {
       $title_err="* you need to fill title";
     }
     if (empty($_POST['content'])) {
       $content_err="* you need to fill content";
     }
   
   }else{
      $id=$_POST['id'];
  $title=$_POST['title'];
  $content=$_POST['content'];


  if ($_FILES['image']['name']!=null) {

  
      $file='images/'.$_FILES['image']['name'];
   $imagetype=pathinfo($file,PATHINFO_EXTENSION);
   if ($imagetype!='jpg'&&$imagetype!='png'&&$imagetype!='jpeg')
    {
       echo "<script>alert('image must be jpg,png or jpeg')</script>";
    }
    else
     {
     
      $image=$_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'], $file);
      $statment=$pdo->prepare("UPDATE posts SET title='$title',content='$content',
        image='$image' WHERE
       id='$id'");
        $result=$statment->execute();
        if ($result) {
                echo
              "<script>alert('Your post is sucessfully updated');
                window.location.href='index.php'</script>";
        }
     
     }

   }else{

      $statment=$pdo->prepare("UPDATE posts SET title='$title',content='$content' WHERE
       id='$id'");
        $result=$statment->execute();
        if ($result) {
           echo "<script>alert('Your post is sucessfully updated');
                 window.location.href='index.php'</script>";
      }
  }


   }    
 
}
 $statment=$pdo->prepare("SELECT * FROM posts WHERE id=".$_GET['id']);
 $statment->execute();
 $result= $statment->fetchall();


 
 ?>
          <?php require("header.php"); ?>
            <h1 class="m-0">NEW POST</h1>
          </div><!-- /.col --><br><br>
          <div class="col-md-12">
            <div class="card">
            	<div class="card-body">
            		
            	
             <form action="" method="post" accept-charset="utf-8" 
             enctype="multipart/form-data">
              <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
             <input type="hidden" name="id" value="<?= mo($result[0]['id']);  ?>">
             <div class="form-group">
             	<label for="">Title</label> 
               <p class="text-danger"><?= empty($title_err)?'':$title_err;?></p>
             	<input type="text" name="title" value="<?=mo($result[0]['title']); ?>"
               class="form-control">
             </div>
             <div class="form-group">
             	<label for="">Content</label>
                <p class="text-danger"><?= empty($content_err)?'':$content_err;?></p>
                 <textarea name="content" rows="8" cols="80" class="form-control">
                  <?= mo($result[0]['content']); ?></textarea>
             </div>
             <div class="form-group">
             	<label for="">image</label><br> 
               
              <img src="images/<?php echo $result[0]['image'] ?>"alt="" height="150" width="300">
              <br>
             	<input type="file" name="image" value="" >
             </div>
             <div class="form-group">
             	<input type="submit" value="POST" class="btn btn-info">
             	<a href="index.php" class="btn btn-warning">BACK</a>
             </div>
             </form>
             	</div>
             </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
         
          
          <!-- /.col-md-6 -->
         
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require("footer.php") ;?>
