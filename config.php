<?php
    require_once('index.php');
    session_start();
    
    if(isset($_POST['submit'])){
        $fname = $_POST['sname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phoneNum'];
        $password = $_POST['pword'];
        $hash_pword = password_hash($password, PASSWORD_DEFAULT);
        if(!empty($fname) and !empty($lname) and !empty($email) and !empty($phone) and !empty($password)){
            $signUp = new SignUp;
            $signUp->insertIntoDb($fname, $lname, $email, $phone, $hash_pword);
        }
        else{
            header('Location: signup.php');
            $_SESSION['inputError'] = 'Pls fill out the inputs';
            exit();
        }
    }

    elseif(isset($_POST['login'])){
    $email = $_POST['Email'];
    $pword = $_POST['password'];
    if(!empty($email) and !empty($pword)){
        $userLogin = new Login;
        $userLogin->checkLogin($email, $pword);
    }
    else{
        header('Location: login.php');
        $_SESSION['inputError'] = '<div class="alert alert-danger alert-dismissible">
        Pls fill out the required field
        </div>';
    }
    }

    elseif(isset($_POST['editPicture'])){
        $user_id = $_SESSION['passId'];
        $pic = ($_FILES['picture']);
        $myProfilePic = new UploadPictures;
        $myProfilePic->profilePic($user_id, $pic);
    }

    elseif(isset($_POST['uploadPost'])){
         $user_id = $_SESSION['passId'];
        if ($user_id == '') {
            header('Location: login.php');
        }
        else{
        $caption = $_POST['caption'];
        $pic1= ($_FILES['pic1']);
        $pic2= ($_FILES['pic2']);
        $pic3= ($_FILES['pic3']);
        $pic4= ($_FILES['pic4']);
            if($pic1['error'] == 0 && !empty($caption)){
                $postImage = new UploadPictures;
                $postImage->postImage($user_id, $pic1, $pic2, $pic3, $pic4, $caption);
            }
            else{
                header('Location: postImage.php');
            }
        }
    }

    elseif(isset($_POST['updateProfile'])){
        $user_id = $_SESSION['passId'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $bio = $_POST['bio'];
        $email = $_POST['email'];
        $phoneNum = $_POST['phoneNum'];
        $updateMyProfile = new UpdateProfile;
        $updateMyProfile->setMyProfile($user_id, $fname, $lname, $bio, $email, $phoneNum);
    }

    elseif(isset($_POST['changePword'])){
        $email = $_POST['email'];
        $newPassword = $_POST['newPword'];
        $confPword = $_POST['confNewPword'];
        $hash_conf_pword = password_hash($confPword, PASSWORD_DEFAULT);
        if(empty($email) && empty($newPassword) or empty($confPword)){
            header('Location: changepword.php');
            $_SESSION['inputError'] = '<div class="alert alert-danger alert-dismissible">
            Pls fill out the required field
            </div>';
        }
        elseif($newPassword !== $confPword){
            header('Location: changepword.php');
            $_SESSION['pwordNtMatch'] = '<div class="alert alert-danger alert-dismissible">
            Password not Match
            </div>';
        }
        else{
            $updateMyPword = new UpdateProfile;
            $updateMyPword->setMyPword($email, $newPassword, $hash_conf_pword);
        }
    }

?>