<?php
    session_start();
    header('login.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram App</title>
    <link rel="stylesheet" href="./bootstrap-4.5.0-dist/css/bootstrap.min.css">
    <style>
        .body-bg{
            background-color: #f2f2f2 !important;
        }  
        .form-bg{
            background-color: violet;
        }  
    </style>
</head>
<body>
    <div class="body-bg container-fluid w-100 h-100 pb-5">
        <div class="container w-50 pt-5" aria-hidden="true"></i>
            <form action="config.php" method="post" class="bg-white container w-75 shadow p-5 text-center mb-5">
                <?php
                if (isset($_SESSION['inputError'])) {
                    echo $_SESSION['inputError'];
                }
               elseif(isset($_SESSION['loginFail'])){
                   echo $_SESSION['loginFail'];
                }  
                elseif(isset($_SESSION['emailError'])){
                    echo $_SESSION['emailError'];
                }
                elseif (isset($_SESSION['changePwordInfo'])) {
                    echo $_SESSION['changePwordInfo'];
                }   
                elseif (isset($_SESSION['regSuccess'])) {
                    echo $_SESSION['regSuccess'];
                }     
                ?>
                <h3>Log In</h3>
                <div class="form-group pt-3 col">
                    <input type="text" placeholder="Email Address" name="Email" class="form-control">
                </div>
                <div class="form-group pt-2 col">
                    <input type="password" placeholder="Password" name="password" class="form-control">
                </div>
                <div class="d-flex justify-content-center container pb-2">
                    <button type="submit" name="login" class="btn btn-warning btn-block">Log In</button>
                </div>
                <a href="changepword.php" class="">Forgotten Password?</a>
                <hr>
                <button class="btn btn-success"><a href="signup.php" class="text-white" style="text-decoration: none;">Create New Account</a></button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
    session_unset();
?>