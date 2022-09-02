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
    <div class="body-bg container-fluid w-100 h-100 d-flex justify-content-center">
        <div class="col-md-6 col-sm-8 pt-3 pb-1">
            <form action="config.php" method="post" class="bg-white shadow p-5 text-center mb-5" enctype="multipart/form-data">
                <h3 class="text-success">
                <?php 
                    if (isset($_SESSION['inputError'])) {
                        echo $_SESSION['inputError'];
                    }
                    elseif (isset($_SESSION['emailError'])) {
                        echo $_SESSION['emailError'];
                    }
                    elseif (isset($_SESSION['regError'])) {
                        echo $_SESSION['regError'];
                    }
                    elseif (isset($_SESSION['connectError'])) {
                        echo $_SESSION['connectError'];
                    }
                ?>
                </h3>
                <p class="h1" style="font-family: cursive;">Postagram</p>
                <h5>Sign Up</h5>
                <div class="form-row pt-2 col">
                    <div class="form-group col-md-6">
                        <input type="text" placeholder="Surame" name="sname" class="form-control" data-error="Required">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" placeholder="Last Name" name="lname" class="form-control">
                    </div>
                </div>
                <div class="form-group pt-2 col-12">
                    <input type="email" placeholder="Email Address" name="email" name="Email" class="form-control">
                </div>
                <div class="form-group pt-2 col-12">
                    <input type="text" placeholder="Phone Number" name="phoneNum" class="form-control">
                </div>
                <div class="form-group pt-2 col-12">
                    <input type="password" placeholder="Create Password" name="pword" class="form-control">
                </div>
                <button type="submit" name="submit" class="btn btn-success btn-block">Create New Account</button>
                <a href="login.php" class="float-right pt-2 pb-3">Already have an account?</a>
            </form>
        </div>
    </div>
</body>
</html>

<?php
    session_unset();
?>