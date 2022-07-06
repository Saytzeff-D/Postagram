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
    <link rel="stylesheet" href="./bootstrap-4.5.0-dist/css/bootstrap.css">
    <script src="bootstrap-4.5.0-dist/js/jquery.js"></script>
	<script src="bootstrap-4.5.0-dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="./bootstrap-4.5.0-dist/css/font-awesome.css">
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
    <a class="nav-link" data-toggl="tooltip" title="Log Out" href="login.php"><i class="fa fa-lg fa-power-off"></i></a>
  </li>
</ul>
    </nav> 
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
              
      <div class="modal fade" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        Content
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
        <hr>
        <p class="h5">People you may know</p>
        <div class="container w-75 bg-light mb-5 border">
           <?php
                $index = $_SESSION['passId'];
                $hmm = 1;
                $sql = "SELECT * FROM users";
                $allUsers = $connnection->query($sql);
                $b = $allUsers->fetch_all(MYSQLI_ASSOC);  
                $c = array_slice($b, $user_id, count($b), false);         
                // echo json_encode($c);
                for ($i=0; $i < count($c); $i++) { 
                    ?>
                     <table class='table' style="background-color: inherit !important;">
                        <span>
                        <?php if ($c[$i]['profilepics_name'] == "") {
                          $_SESSION['userId'] = $c[$i]['user_id'];
                            ?>
                            <img src="./uploads/user.png" class="rounded-circle" width="100px">
                        <?php } else {
                          ?>
                          <img data-toggle="modal" data-target="#myModal" src="./uploads/<?php echo $c[$i]['profilepics_name']?>" class='rounded-circle' width="100px" style="cursor: pointer;">
                        <?php } ?>
                        </span>
                        <span class="pl-3 font-weight-bold"><?php echo $c[$i]['first_name'] . ' ' . $c[$i]['last_name']?></span>
                        <span><button class="btn btn-primary float-right mt-5">Follow</button></span>
                        <hr>
                     </table>
        <?php } ?>

        </div>