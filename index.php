<?php

    require_once('env.config.php');

    class Connection {
        public $connect;
        public function __construct()
        {
            $this->connect = new mysqli($_ENV['SERVER'], $_ENV['USERNAME'], '', $_ENV['DB']);
            if ($this->connect->connect_error) {
                header('Location: signup.php');
                $_SESSION['connectError'] = 'Error! No connection';
            }
            else{
                echo 'Connected to Database';
            }  	
        }

    }

    class SignUp extends Connection {
        public function insertIntoDb($fname, $lname, $email, $phone, $hash_pword)
        {
            $verifyEmail = "SELECT * FROM users WHERE email = '$email'";
            $queryDB = $this->connect->query($verifyEmail);

            if ($queryDB->num_rows>0) {
                header('Location: signup.php');
                $_SESSION['emailError'] = 'Email Already exists';
            }
            else{
                $insertIntoDb = "INSERT INTO users (first_name, last_name, email, phone_num, password) VALUES ('$fname', '$lname', '$email', '$phone', '$hash_pword')";
                $a =  $this->connect->query($insertIntoDb);
                if ($a) {
                    header('Location: login.php');
                    $_SESSION['regSuccess'] = '<div class="alert alert-success alert-dismissible">You are now a user, Kindly login!</div>';
                }
                else{
                    header('Location: signup.php');
                    $_SESSION['regError'] = 'Unuccessful, Error in connection';
                }
            }
        }
    }

    class Login extends Connection{
        public function checkLogin($email, $pword)
        {
            $sql = "SELECT user_id, password FROM users where email = '$email' or phone_num = '$email'";
            $fetchFromDb = $this->connect->query($sql);
            $arrDb = $fetchFromDb->fetch_assoc();
            $verify = password_verify($pword, $arrDb['password']);
            if ($verify) {
                header('Location: dashboard.php');
                $_SESSION['passId'] =  $arrDb['user_id'];
            }
            else{
                header('Location: login.php');
                $_SESSION['loginFail'] = '<div class="alert alert-danger alert-dismissible">
                Email or Password is Incorrect
                </div>';
            }
        }
    }

    class UploadPictures extends Connection{
        public function profilePic($user_id, $pic)
        {
            if($pic['error'] == 0){
                $pictureName = $pic['name'];
                $sql = "UPDATE users SET profilepics_name = '$pictureName' where user_id = '$user_id'";
                $picIntoDB = $this->connect->query($sql);
                if ($picIntoDB) {
                    move_uploaded_file($pic['tmp_name'], 'uploads/' .$pic['name']);
                }
                header('Location: profile.php');
            }
            elseif($pic['error'] > 0){
                header('Location: profile.php');
            }
        }
        public function postImage($user_id, $pic1, $pic2, $pic3, $pic4, $caption)
        {
            $pic1Name = $pic1['name'];
            $sql = "INSERT INTO image (img_name, img_caption, user_id) VALUES('$pic1Name', '$caption', '$user_id')";
            $insertImg = $this->connect->query($sql);
            move_uploaded_file($pic1['tmp_name'], 'uploads/' .$pic1['name']);
            header('Location: dashboard.php');
        }
    }

    class UpdateProfile extends Connection{
        public function setMyProfile($user_id, $fname, $lname, $bio, $email, $phoneNum)  
        {
            $sql = "UPDATE users SET first_name = '$fname', last_name = '$lname', email = '$email', phone_num = '$phoneNum', bio_details = '$bio' where user_id = $user_id";
            $updateDb = $this->connect->query($sql);
            header('Location: profile.php');
        }
        public function setMyPword($email, $newPassword, $hash_conf_pword)
        {
            $queryDb = "SELECT user_id, email, password FROM users where email = '$email' or phone_num = '$email'";
        $checkEmail = $this->connect->query($queryDb);
        if ($checkEmail->num_rows>0) {
            $a = $checkEmail->fetch_assoc();
                $user_id = $a['user_id'];
                $queryChangePword = "UPDATE users SET password = '$hash_conf_pword' where user_id = '$user_id'";
                $this->connect->query($queryChangePword);
                header('Location: login.php');
                $_SESSION['changePwordInfo'] = '<div class="alert alert-success alert-dismissible">
                Password changed succesfully....pls log in
                </div>';
        }
        else{
            header('Location: changepword.php');
            $_SESSION['noDetails'] = '<div class="alert alert-danger alert-dismissible">
            Invalid Email
            </div>';
        }
        }
    }
?>