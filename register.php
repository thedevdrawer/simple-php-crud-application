<?php
    include('includes/functions.php');
    if(isset($_POST['btnRegister'])):
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        createUser($username, $password, $fname, $lname);
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
    <?php if(isset($_SESSION['message'])): ?>
        <div class="alert alert-<?php echo $_SESSION['message']['type']; ?>" role="alert">
            <?php echo $_SESSION['message']['msg']; ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?> 
    <div class="card">
        <div class="card-body">
            <div class="container-fluid">
                <h1>Register</h1>
                <form action="" method="post" class="register">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="fname">First Name</label>
                            <input type="text" name="fname" id="fname" class="form-control">
                            <br>
                        </div>
                        <div class="col-md-6">
                            <label for="lname">Last Name</label>
                            <input type="text" name="lname" id="lname" class="form-control">
                            <br>
                        </div>
                    </div>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control">
                    <br>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <br>
                    <button name="btnRegister" class="btn btn-primary">Register</button> <a href="/login">Cancel</a>
                </form>
            </div>
    <?php include('theme/footer-scripts.php'); ?>
</body>
</html>