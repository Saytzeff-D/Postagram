<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
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