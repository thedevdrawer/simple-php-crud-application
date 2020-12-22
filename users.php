<?php
    include('includes/functions.php');
    auth();
    if(isset($_POST['btnCreateUser'])):
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $active = $_POST['active'];
        $level = $_POST['level'];
        createUser($username, $password, $fname, $lname, $active, $level);
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
        <h1><em class="fa fa-users"></em> Users</h1>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-current-tab" data-toggle="tab" href="#users">Current Users</a>
            <a class="nav-item nav-link" id="nav-add-tab" data-toggle="tab" href="#add">Add New User</a>
          </div>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="users">
            <table class="table table-striped users">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Active</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
          </div>
          <div class="tab-pane fade" id="add">
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
                <div class="row">
                    <div class="col-md-6">
                        <label for="active">Active</label>
                        <select name="active" id="active" class="form-control">  
                            <option value="0" default>Inactive</option>
                            <option value="1">Active</option>
                        </select>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="form-control">  
                            <option value="0" default>0 - View Only</option>
                            <option value="1">1 - Admin</option>
                        </select>                    
                        <br>
                    </div>
                </div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control">
                <br>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <br>
                <button name="btnCreateUser" class="btn btn-primary">Create New User</button>
            </form>
          </div>
        </div>
    </div>
    <?php include('theme/footer-scripts.php'); ?>
</body>
</html>