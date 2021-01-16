<?php 
 session_start();
 require("../connection/config.php");
 if (empty(  $_SESSION['user_id'])&&empty(  $_SESSION['logged_in'])) 
 {
 	header("Location:login.php");
 }
  if ( $_SESSION['role']!=1) {
   header("Location:login.php");
 }
  $statment= $pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
  $statment->execute();
  $result=$statment->FETCHALL();
 if ($_POST) 
 {
   $file='images/'.$_FILES['image']['name'];
   $imagetype=pathinfo($file,PATHINFO_EXTENSION);
   if ($imagetype!='jpg'&&$imagetype!='png'&&$imagetype!='jpeg')
    {
   	echo "<script>alert('image must be jpg,png or jpeg')</script>";
    }
    else
     {
    	$title=$_POST['title'];
    	$content=$_POST['content'];
    	$image=$_FILES['image']['name'];


    	move_uploaded_file($_FILES['image']['tmp_name'], $file);

        $statment=$pdo->prepare("INSERT INTO posts(title,content,image,user_id)
         VALUES (:title,:content,:image,:user_id)");
        $result=$statment->execute(
        array(':title'=>$title,':content'=>$content,':image'=>$image,
        ':user_id'=>$_SESSION['user_id'])
        );
        if ($result)
        {
            echo "<script>alert('new blog is posted');window.location.href='index.php'</script>";
        }
     }

 }

 ?>
          <?php require("header.php"); ?>
            <h1 class="m-0">NEW POST</h1>
          </div><!-- /.col --><br><br>
          <div class="col-md-12">
            <div class="card">
            	<div class="card-body">
            		
            	
             <form action="add.php" method="post" accept-charset="utf-8" 
             enctype="multipart/form-data">
             <div class="form-group">
             	<label for="">Title</label>
             	<input type="text" name="title" value="" class="form-control" required>
             </div>
             <div class="form-group">
             	<label for="">Content</label>
                 <textarea name="content" rows="8" cols="80" class="form-control" required></textarea>
             </div>
             <div class="form-group">
             	<label for="">image</label><br>
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
