<?php

include_once "../appdata/sessionHandle.php";
include_once "../model/user.php";
include_once "../appdata/appConstant.php";
include_once "../database/dbOperation.php";
//include('../database/dbOperation.php');
//include('appdata/appConstant.php');

$session = new sessionHandle();
$db_operation = new dbOperation();

$user = $session->getUser();
if (!$user) {
    header("Location: " . appConstant:: $ROOT_DIR); /* Redirect browser */
    exit();
}

$delete = (isset($_GET['delete']) ? $_GET['delete'] : '');

if ($delete) {
    $update = $db_operation->deletePost($delete);
    //echo $delete;
}


?>

<html>
<head>
    <title> Home </title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css"/>
</head>

<body>
<?php include('../header.php'); ?>
</br>
<?php include '../user/user_posts.php'; ?>
</body>
</html>











