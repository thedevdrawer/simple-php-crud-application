<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('db.php');
session_start();

/* format arrays */
function formatcode($arr){
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

/* select statement */
function selectAll(){
    global $mysqli;
    $data = array();
    $stmt = $mysqli->prepare('SELECT * FROM employees');
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 0):
        $_SESSION['message'] = array('type'=>'danger', 'msg'=>'There are currently no records in the database');
    else:
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
    endif;
    $stmt->close();
    return $data;
}

/* select single statement */
function selectSingle($id = NULL) {
    global $mysqli;
    $stmt = $mysqli->prepare('SELECT * FROM employees WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row;
}

/* insert statement */
function insert($fname = NULL, $lname = NULL, $phone = NULL){
    global $mysqli;
    $stmt = $mysqli->prepare('INSERT INTO employees (fname, lname, phone) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $fname, $lname, $phone);
    $stmt->execute();
    $stmt->close();
    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully added a new employee');
    header('Location: update.php?id='.$mysqli->insert_id);
    exit();
}

/* update statement */
function update($fname = NULL, $lname = NULL, $phone = NULL, $id){
    global $mysqli;
    $stmt = $mysqli->prepare('UPDATE employees SET fname = ?, lname = ?, phone = ? WHERE id =?');
    $stmt->bind_param('sssi', $fname, $lname, $phone, $id);
    $stmt->execute();
    if($stmt->affected_rows === 0):
        $_SESSION['message'] = array('type'=>'danger', 'msg'=>'You did not make any changes');
    else:
        $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully update the selected employee');
    endif;
    $stmt->close();
}

/* delete statement */
function delete($id){
    global $mysqli;
    $stmt = $mysqli->prepare('DELETE FROM employees WHERE id =?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully deleted the selected employee');
    header('Location: /');
    exit();
}

/* login statement */
function doLogin($username = NULL, $password = NULL) {
    global $mysqli;
    $stmt = $mysqli->prepare('SELECT * FROM users WHERE username = ? AND active = 1');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 0):
        $_SESSION['message'] = array('type'=>'danger', 'msg'=>'Your account has not been enabled. Please contact an administrator.');
    else:
        while($row = $result->fetch_assoc()){
            $hash = $row['password'];
            if(password_verify($password, $hash)):
                $_SESSION['user']['id'] = $row['id'];
                $_SESSION['user']['fname'] = $row['fname'];
                $_SESSION['user']['lname'] = $row['lname'];
                $_SESSION['user']['username'] = $row['username'];
                $_SESSION['user']['level'] = $row['level'];
                header('Location: /');
            else:
                $_SESSION['message'] = array('type'=>'danger', 'msg'=>'Your username or password is incorrect. Please try again.');
            endif;
        }
    endif;
    $stmt->close();
}

/* logout statement */
function doLogout(){
    unset($_SESSION['user']);
    $_SESSION['message'] = array('type'=>'success', 'msg'=>'You have been successfully logged out.');
    header('Location: /login');
    exit();
}

/* select all users */
function selectAllUsers() {
    global $mysqli;
    $data = array();
    $stmt = $mysqli->prepare('SELECT * FROM users');
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 0):
        $_SESSION['message'] = array('type'=>'danger', 'msg'=>'There are currently no records in the database');
    else:
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
    endif;
    $stmt->close();
    return $data; 
}

/* select single statement */
function selectSingleUser($id = NULL) {
    global $mysqli;
    $stmt = $mysqli->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row;
}

/* create user statement */
function createUser($username = NULL, $password = NULL, $fname = NULL, $lname = NULL, $active = NULL, $level = NULL) {
    global $mysqli;
    $stmt = $mysqli->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows !== 0):
        $_SESSION['message'] = array('type'=>'danger', 'msg'=>'The username you chose is taken. Please try again.');
    else:
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare('INSERT INTO users (username, password, fname, lname, active, level) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssii', $username, $password, $fname, $lname, $active, $level);
        $stmt->execute();
        $stmt->close();
        if(isset($_SESSION['user'])) :
            $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully added a new user');
            header('Location: /users');
        else:
            $_SESSION['message'] = array('type'=>'success', 'msg'=>'You have successfully create a new user, once approved you can log in here.');
            header('Location: /login');
        endif;
        exit();
    endif;
}

/* update user statement */
function updateUser($username, $fname = NULL, $lname = NULL, $active, $level, $id){
    global $mysqli;
    $stmt = $mysqli->prepare('UPDATE users SET username = ?, fname = ?, lname = ?, active = ?, level = ? WHERE id =?');
    $stmt->bind_param('sssiii', $username, $fname, $lname, $active, $level, $id);
    $stmt->execute();
    if($stmt->affected_rows === 0):
        $_SESSION['message'] = array('type'=>'danger', 'msg'=>'You did not make any changes');
    else:
        $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully update the selected user');
    endif;
    $stmt->close();
}

/* delete user statement */
function deleteUser($id){
    global $mysqli;
    $stmt = $mysqli->prepare('DELETE FROM users WHERE id =?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully deleted the selected user');
    header('Location: /users');
    exit();
}

/* validate use can access pages */
function auth() {
    if($_SESSION['user']['level'] < 1):
        $_SESSION['message'] = array('type'=>'danger', 'msg'=>'You are not authorized to view that page.');
        header('Location: /');
        exit();
    endif;
}