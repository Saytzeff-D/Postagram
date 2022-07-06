<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./bootstrap-4.5.0-dist/css/bootstrap.min.css">
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