<?php
include('includes/functions.php');
auth();
$user = (isset($_GET['id'])) ? deleteUser($_GET['id']) : exit();