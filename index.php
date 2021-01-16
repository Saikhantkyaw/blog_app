<?php 
session_start();
 require("connection/config.php");
 if (empty(  $_SESSION['user_id'])&&empty(  $_SESSION['logged_in'])) 
 {
 	header("Location:login.php");
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

  <!-- Navbar -->
 
  <!-- Main Sidebar Container -->
  

  <!-- Content Wrapper. Contains page content -->
  
    <!-- Content Header (Page header) -->
   <?php 

   
              $statment= $pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
              $statment->execute();
              $result=$statment->FETCHALL();

    ?>
      <div class="container-fluid">
        
            <h1 style="text-align: center;">Blog site</h1>
         
        <div class="row">
        	  <?php 
           			if ($result) 
           			{$i=1;
           				foreach ($result as $value) 
           				{?>
           		  <div class="col-md-4">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
                <div class="user-block" style="text-align: center !important;float:none;">
                <h4> <?php echo $value['title']; ?></h4>
                </div>
                <!-- /.user-block -->
                
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <a href="blogdetail.php?id=<?php echo $value['id']; ?>" title="">
               <img src="admin/images/<?php echo $value['image']; ?>" class="img-fluid pad"
               style="height: 200 !important;"></a>

                <p> <?php echo $value['content']; ?> </p>
              
              </div>
          </div>
           
              </div>
          
           					
           		<?php	$i++;
           				}
           			}

                  ?>
                    
        
           
              </div>
              <!-- /.card-footer -->
     
      </div>
      
 

   
 
  <!-- /.content-wrapper -->

   <footer class="main-footer" style="margin-left: 0px !important;">
    <div class="float-right ">
     <a href="logout.php" class="btn btn-dark">Log out</a>
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
