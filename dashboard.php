<?php
    session_start();
    // include 'credentials.php';
    $connnection = new mysqli('localhost', 'root', '', 'instagram');
    $user_id =  $_SESSION['passId'];
    if ($user_id == '') {
        header('Location: login.php');
    }
    else{
        $sql = "SELECT first_name, last_name, phone_num, profilepics_name FROM users where user_id = '$user_id'";
        $fetchData = $connnection->query($sql);
        $dataFromDb = $fetchData->fetch_assoc();
        $username = $dataFromDb['first_name'] . ' '. $dataFromDb['last_name'];
        $mobile = $dataFromDb['phone_num'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./bootstrap-4.5.0-dist/css/bootstrap.min.css">
    <script src="bootstrap-4.5.0-dist/js/jquery.js"></script>
	<script src="bootstrap-4.5.0-dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="./bootstrap-4.5.0-dist/css/font-awesome.css">
    <style>
        #uploadedImg:hover{
            opacity: 0.7;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand ml-5 mb-0 h1 d-inline-flex">
        Instagram
    </span>
    <ul class="nav justify-content-end">
  <li class="nav-item">
    <a class="nav-link active" data-toggl="tooltip" title="Home" href="dashboard.php"><i class="fa fa-home fa-lg"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggl="tooltip" title="Profile" href="followers.php"><i class="fa fa-lg fa-instagram"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggl="tooltip" title="Upload Post" href="postImage.php"><i class="fa fa-lg fa-plus-circle"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggl="tooltip" title="Log Out" href="" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-lg fa-power-off"></i></a>
  </li>
</ul>
    </nav> 

    <div class="modal fade" id="logoutModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <!-- <div class="modal-header">
        <h3>Exit</h3>
    </div> -->
        <div class="modal-body">
        <p class="h5 pt-2 text-center">Are you sure you want to log out?</p>
        <div class="float-right">
            <a data-dismiss="modal" role="button" class="btn btn-light">No, Thanks</a>
            <a href="login.php" role="button" class="btn btn-light">Yes</a>        
        </div>
        </div>
    </div>
  </div>
</div>

    <?php
        $picture = $dataFromDb['profilepics_name'];
    if ($picture == '') {
        $image = './uploads/user.png';
    }
    else{
        $image = './uploads/' .$picture;
    }

    ?> 
    <div class="container w-75">
    <div class="d-inline-flex">
        <img src="<?php echo $image ?>" width="100px" class="rounded-circle bg-light shadow" alt="Image">
        <div class="pl-4">
        <p class="pt-3 h6"><?php echo $username?></p>  
        <p class="text-muted"><?php echo $mobile?></p>          
        </div>
    </div><br>
        <a name="" id="" class="btn btn-primary" href="profile.php" role="button">Edit Profile</a>
        <hr>
        <p class="h5">Recent Posts</p> 
        <div class="row">

        <?php
            $sql = "SELECT img_id, img_name, img_caption FROM `users` JOIN `image` USING(user_id) WHERE user_id = '$user_id'";
            $fetchPost = $connnection->query($sql);
            $a = $fetchPost->fetch_all(MYSQLI_ASSOC);
            $_SESSION['noOfPost'] =  count($a);
            if (count($a) == 0) {
                echo "<p class='container w-50 display-3'>No recent posts</p>";
            }
            else{
            for ($i=0; $i < count($a); $i++) { 
                    // echo $a[$i]['img_name'] . '<br>';
                    if ($a[$i]['img_name'] !== '') {
                        $uploadImage = './uploads/' . $a[$i]['img_name'];                        
                    ?>
                    <div class="col-md-4 mb-3">
                    <a><img data-toggle="modal" data-target="#myModal" id="uploadedImg" <?php $_SESSION['imgId']= $a[$i]['img_id']; ?> src="<?php echo $uploadImage; ?>" class="w-100 h-100" style="border-radius: 20px;"></a>
                    </div>
                    <?php } } } ?>
            </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <?php echo $_SESSION['imgId']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- Modal -->
</body>
</html>
