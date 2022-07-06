<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Status</title>
</head>
<body>
    <?php include 'nav.php'; ?>
    <div class="container w-50">
        <form action="config.php" class="border  mt-5 pt-2" method="post" enctype="multipart/form-data">
            <p class="h5 text-center">Upload Post</p>
            <div class="form-row col">
                <div class="form-group col-6">
                    <input type="file" name="pic1" class="form-control" id="">
                </div>
                <div class="form-group col-6">
                    <input type="file" name="pic2" class="form-control" id="">
                </div>
            </div>
            <div class="form-row col">
                <div class="form-group col-6">
                    <input type="file" name="pic3" class="form-control" id="">
                </div>
                <div class="form-group col-6">
                    <input type="file" name="pic4" class="form-control" id="">
                </div>
            </div>
            <div class="form-group col">
                <textarea name="caption" placeholder="Type a caption" class="form-control" id="" cols="30" rows="5"></textarea>
            </div>
            <div class="form-group col">
                <button name="uploadPost" class="btn btn-warning btn-block ">Upload</button>
            </div>
        </form>
    </div>
</body>
</html>