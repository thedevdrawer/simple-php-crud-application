<?php
    include('includes/functions.php');
    auth();
    if(isset($_POST['btnUpdateUser'])):
        $username = $_POST['username'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $active = $_POST['active'];
        $level = $_POST['level'];
        $id = $_POST['id'];
        updateUser($username, $fname, $lname, $active, $level, $id);
    endif;
    $user = (isset($_GET['id'])) ? selectSingleUser($_GET['id']) : false;
    $activeArr = array(0=>'Inactive', 1=>'Active');
    $levelArr = array(0=>'0 - View Only', 1=>'1 - Admin');
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
        <form action="" method="post" class="register">
            <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id">
            <div class="row">
                <div class="col-md-6">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $user['fname']; ?>">
                    <br>
                </div>
                <div class="col-md-6">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname" class="form-control" value="<?php echo $user['lname']; ?>">
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="active">Active</label>
                    <select name="active" id="active" class="form-control">  
                        <?php
                            foreach ($activeArr as $key=>$active) :
                                if($key == $user['active']):
                                    $selected = ' selected';
                                else:
                                    $selected = '';
                                endif;
                                echo '<option value="'.$key.'"'.$selected.'>'.$active.'</option>';
                            endforeach;
                        ?>
                    </select>
                    <br>
                </div>
                <div class="col-md-6">
                    <label for="level">Level</label>
                    <select name="level" id="level" class="form-control">  
                        <?php
                            foreach ($levelArr as $key=>$level) :
                                if($key == $user['level']):
                                    $selected = ' selected';
                                else:
                                    $selected = '';
                                endif;
                                echo '<option value="'.$key.'"'.$selected.'>'.$level.'</option>';
                            endforeach;
                        ?>
                    </select>                    
                    <br>
                </div>
            </div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="<?php echo $user['username']; ?>" readonly>
            <br>
            <button name="btnUpdateUser" class="btn btn-primary">Update User</button> <a href="#">Reset Password</a>
        </form>
    </div>
    <?php include('theme/footer-scripts.php'); ?>
</body>
</html>