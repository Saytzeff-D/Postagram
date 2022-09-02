<?php
    session_start();
    $connnection = new mysqli('localhost', 'root', '', 'php_instagram');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
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
