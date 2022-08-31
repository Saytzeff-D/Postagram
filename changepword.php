<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    <style>
        .body-bg{
            background-color: #f2f2f2 !important;
        }  
    </style>
</head>
<body>
    <div class="body-bg container-fluid w-100 h-100">
        <div class="container w-50 p-5">
        <form action="config.php" class="bg-white container shadow p-5 mb-5 mt-3 text-center" method="post">
                    <?php
                        if (isset($_SESSION['inputError'])) {
                            echo $_SESSION['inputError'];
                        }
                        elseif (isset($_SESSION['incorrectInfo'])) {
                            echo $_SESSION['incorrectInfo'];
                        }
                        elseif (isset($_SESSION['noDetails'])) {
                            echo $_SESSION['noDetails'];
                        }
                        elseif (isset($_SESSION['pwordNtMatch'])) {
                            echo $_SESSION['pwordNtMatch'];
                        }
                    ?>
            <p class="text-center h2" style="font-family: nautilus_pompiliusregular;">Instagram</p>
            <p class="text-muted text-center">Change password</p>
            <input type="text" placeholder="Email Address or Mobile" name="email" class="form-control m-3">
            <input type="password" placeholder="New Password" name="newPword" class="form-control m-3">
            <input type="password" placeholder="Confirm New Password" name="confNewPword" class="form-control m-3">
            <button type="submit" name="changePword" class="btn btn-danger btn-block">Change</button>
            <a href="login.php" class="float-right pt-1">Proceed to Login</a>
        </form>        
        </div>
    </div>
</body>
</html>

<?php
    session_unset();
?>