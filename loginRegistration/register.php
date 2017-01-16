<?php
include('../model/user.php');
include('../database/dbOperation.php');
include_once "../appdata/sessionHandle.php";
//include('appdata/sessionHandle.php');
include('../appdata/appConstant.php');

$submitregister = (isset($_POST['submitregister'])?$_POST['submitregister']:'');

if($submitregister){
	
	$fullname = (isset($_POST['fullname'])?$_POST['fullname']:'');
	$email = (isset($_POST['email'])?$_POST['email']:'');
	$password = (isset($_POST['password'])?$_POST['password']:'');
	$confpassword = (isset($_POST['confpassword'])?$_POST['confpassword']:'');
	
	$avatar =  appConstant :: $USER_AVATAR_DEFAULT_URL;
	
	$target_dir =  "../" . appConstant :: $USER_AVATAR_DIR;
	$target_file = $target_dir . basename($_FILES["profilepic"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["profilepic"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	
	if ($uploadOk == 0) {
	
	} else {
		if (move_uploaded_file($_FILES["profilepic"]["tmp_name"], $target_file)) {
			
			$avatar = appConstant :: $USER_AVATAR_DIR . $_FILES["profilepic"]["name"];
			echo $avatar;
			
		} else {
			
		}
	}
	
	if($password == $confpassword){
		
		$db_operation=new dbOperation();
		$return_msg = $db_operation->addUser($fullname,$email,$password,$avatar,false,"user");
		
		if($return_msg == dbOperation :: $ALERT_EMAIL_ALREADY_REGISTERED){
			
			$message = "<font color='red'>User With This Email Id Already Registered</font>";
			
		}else if($return_msg == dbOperation :: $ALERT_DATABASE_ENTRY_PROBLEM){
			
			$message = "<font color='red'>Something wrong during database insert operation!!!</font>";
			
		}else{
			
			$user_id = $return_msg;
			
			$user = new user($user_id,$fullname,$email,$avatar,false,"user");
			
			

			$session = new sessionHandle();
			$session->setUser($user);
			
			//echo $avatar;
			
			//echo $user->getName();
			
			//Logged in True
			header('Location: ../user/profile.php');
		}
		
	}else{
		$message = "<font color='red'>Password Don't Match !</font>";
	}
	
	
}

?>

<html>
    <head>
        <title> Register a new account </title>
		<link rel="stylesheet" type="text/css" href="../css/styles.css"/>
    </head>
    <body>
		<?php	include('../header.php'); ?>
        <div id="registermember">
            <form action="" method="POST" enctype="multipart/form-data">
                <p> <input type="text" name="fullname" id="fullname" placeholder="Fullname"/> </p>
                <p> <input type="email" name="email" id="email" placeholder="Email"/> </p>
				<p> Profile Picture</br>
				<input type="file" name="profilepic" id="profilepic"/> </p>
                <p> <input type="password" name="password" id="password" placeholder="Password"/> </p>
				<p> <input type="password" name="confpassword" id="confpassword" placeholder="Confrim Password"/> </p>
                <p> <input type="submit" name="submitregister" id="submitregister" value="Register"/></p>
				<p> <?php echo (isset($message)?$message:''); ?>  </p>
            </form>
        </div>

        
    </body>
</html>