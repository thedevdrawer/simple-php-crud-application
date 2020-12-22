<?php
include('functions.php');
if (isset($_GET['type']) && $_GET['type']=='get') {
    echo json_encode(array('data'=>selectAll()));
}

if (isset($_GET['type']) && $_GET['type']=='getUsers') {
    echo json_encode(array('data'=>selectAllUsers()));
}