<?php
    // include_once('env.config.php');
    session_start();
    $connnection = new mysqli($_ENV['SERVER'], $_ENV['USERNAME'], $_ENV['PASSWORD'], $_ENV['DB']);

    $user_id = $_SESSION['passId'];
    if ($user_id == '') {
        header('Location: login.php');
    }
    else{
    $sql = "SELECT * FROM users where user_id = '$user_id'";
    $fetchData = $connnection->query($sql);
    $dataFromDb = $fetchData->fetch_assoc();
    $username = $dataFromDb['last_name'] . ' '. $dataFromDb['first_name'];
    $mobile = $dataFromDb['phone_num'];
    $bio = $dataFromDb['bio_details'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</head>
<body>

    <?php
    include 'nav.php';
        $picture = $dataFromDb['profilepics_name'];
    if ($picture == '') {
        $image = './uploads/user.png';
    }
    else{
        $image = './uploads/' .$picture;
    }

    ?> 
    <div class="container w-75 pt-3">
        <div class="row">
            <div class="col-3">
            <img src="<?php echo $image ?>" width="150px" height="150px" class="shadow rounded-circle bg-light" alt="Image">
            </div>
            <div class="col-9 w-50 float-left">
                <form action="config.php" method="post" enctype="multipart/form-data">
                    <button name="editPicture" class="btn btn-light">Edit Profile Picture</button>
                    <input type="file" name="picture" class="" id="">
                </form>
                <div class="row m-2 w-50">
                    <div class="col-4"><?php echo $_SESSION['noOfPost']?> posts</div>
                    <div class="col-4">2 followers</div>
                    <div class="col-4">0 following</div>
                </div>
                <p class="h6 float-left pt-2 col-12"><?php echo $username; ?></p>
                <p class="text-muted float-left pl-2"><?php echo $bio; ?></p>
            </div>
        </div>
        <hr>
        <form action="config.php" method="post">
        <div class="container-fluid">
            <p class="text-muted h5">Personal Information</p>
            <div class="container">
                <div class="form-row col-12">
                    <div class="form-group col-md-6">
                        <label class="h6"> First Name </label>
                        <input type="text" value="<?php echo $dataFromDb['first_name']?>" name="fname" class="form-control" id="">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="h6"> Last Name </label>
                        <input type="text" name="lname" value="<?php echo $dataFromDb['last_name']; ?>" class="form-control" id="">
                    </div>
                </div>
                <div class="form-group col">
                    <label for="" class="h6">Bio</label>
                    <textarea name="bio" value="<?php echo $bio; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $bio; ?></textarea>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <p class="text-muted h5">Contact Information</p>
            <div class="container">
            <div class="form-row col-12">
                    <div class="form-group col-md-6">
                        <label class="h6"> Email </label>
                        <input type="text" name="email" value="<?php echo $dataFromDb['email']?>" class="form-control" id="">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="h6"> Phone Number </label>
                        <input type="text" name="phoneNum" value="<?php echo $dataFromDb['phone_num']?>" class="form-control" id="">
                    </div>
                </div>
            </div>
        </div>
<button name="updateProfile" class="btn btn-primary float-right">Submit</button>
</form>
</div>
    
</body>
</html>