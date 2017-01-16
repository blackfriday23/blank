<?php

include('../database/dbOperation.php');
include_once "../appdata/sessionHandle.php";
//include('appdata/sessionHandle.php');
//include('../appdata/appConstant.php');
include_once "../appdata/appConstant.php";

$loginsubmit = (isset($_POST['loginsubmit'])?$_POST['loginsubmit']:'');

if($loginsubmit){	
	$email =(isset($_POST['email'])?$_POST['email']:'');
	$password =(isset($_POST['password'])?$_POST['password']:'');

	$message = "OK";
	
	$db_operation=new dbOperation();
	
		
	$user = $db_operation->getUser($email,$password);
		
	if($user){
		$session = new sessionHandle();
		$session->setUser($user);
			
		//echo $user->getName();
			
		//Logged in True
		if($user->getType() == appConstant :: $USER_TYPE_GENERALUSER){
			header('Location: ../user/profile.php');
		}else if($user->getType() == appConstant :: $USER_TYPE_ADMIN){
			header('Location: ../admin/index.php');
		}
	}else{
		$message = "<font color='red'>Error in Email or password please try again</font>";
	}
	

	

}


$sfullname =(isset($_SESSION['fullname'])?$_SESSION['fullname']:'');
if($sfullname){
	header('Location: index.php');
}


?>

<html>
    <head>
        <title> Login </title>
		<link rel="stylesheet" type="text/css" href="../css/styles.css"/>
    </head>
    <body>
		<?php	include('../header.php'); ?>
        <div id="loginmember">
            
            <form action="" method="POST">
                 <p> <input type="email" name="email" id="email" placeholder="Your Email"/> </p>
                 <p> <input type="password" name="password" id="password" placeholder="Your Password"/> </p>
                 <p> <input type="submit" name="loginsubmit" id="loginsubmit" value="Login"/></p>
                 <p> <?php echo (isset($message)?$message:''); ?> </p>
            </form>
           
        </div>
        
    </body>
</html>