<?php
    include('includes/functions.php');
    auth();
    if (isset($_POST['btnInsert'])) :
        insert($_POST['fname'], $_POST['lname'], $_POST['phone']);
    endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DevDrawer DB</title>
    <?php include('theme/header-scripts.php'); ?>
</head>
<body>
    <?php include('theme/header.php'); ?>
    <div class="container-fluid">
        <h1><em class="fa fa-plus-circle"></em> Insert</h1>
        <form action="" method="post" class="form">
        <div class="row">
            <div class="col-md-6">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname" class="form-control" value="">
                    <br>
                </div>
                <div class="col-md-6">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname" class="form-control" value="">
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control phone" value="">
                    <br>
                </div>
            </div>
            <button name="btnInsert" class="btn btn-primary">Insert Record</button>
        </form>  
    </div>
    <?php include('theme/footer-scripts.php'); ?>  
</body>
</html>