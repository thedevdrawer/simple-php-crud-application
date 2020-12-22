<?php
include('includes/functions.php');
auth();
$user = (isset($_GET['id'])) ? delete($_GET['id']) : exit();