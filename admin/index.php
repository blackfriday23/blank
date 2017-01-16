<?php
include_once "../appdata/sessionHandle.php";
include_once "../model/user.php";
include_once "../appdata/appConstant.php";
include_once "../database/dbOperation.php";
//include('../database/dbOperation.php');
//include('appdata/appConstant.php');

$session = new sessionHandle();
$db_operation=new dbOperation();

$admin = $session->getUser();
if(!$admin){
	header("Location: ". appConstant :: $ROOT_DIR); /* Redirect browser */
	exit();
}


$approve = (isset($_GET['approve'])?$_GET['approve']:'');
$decline = (isset($_GET['decline'])?$_GET['decline']:'');
$block = (isset($_GET['block'])?$_GET['block']:'');
$unblock = (isset($_GET['unblock'])?$_GET['unblock']:'');

if($approve){
	$update = $db_operation->approveUserRequest($approve);
}else if ($decline){
	$update = $db_operation->removeUserRequest($decline);
}else if($block){
	$update = $db_operation->blockUserRequest($block);
}else if($unblock){
	$update = $db_operation->unblockUserRequest($unblock);
}

$users = $db_operation->fetchusers();

?>
<html>
	<head>
		<title> Admin </title>
		<link rel="stylesheet" type="text/css" href="../css/styles.css"/>
		<style>
			table {
				font-family: arial, sans-serif;
				border-collapse: collapse;
				width: 100%;
			}

			td, th {
				border: 1px solid #dddddd;
				text-align: left;
				padding: 8px;
			}

			tr:nth-child(even) {
				background-color: #dddddd;
			}
		</style>
	</head>
	<body>
	<?php	include('../header.php'); ?>
	</br>

	<center>
			<table>
			  <tr>
				<th>id</th>
				<th>User</th>
				<th>Request</th>
				<th>Approve</th>
				
			  </tr>
			  <?php $i=1; foreach($users as $showusers){  ?>
			  
			  <tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $showusers['name']; ?></td>
				
				<?php if($showusers['approveStatus'] == appConstant :: $USER_POST_APPROVE_STATUS_NOTAPPROVE){ ?>
					<td> 
						<font color="red">Not Approved</font> 
					</td>
				<?php }else if($showusers['approveStatus'] == appConstant :: $USER_POST_APPROVE_STATUS_APPROVED){ ?>
					<td>
						<font color="green">Approved</font>
					</td>
				<?php }else if($showusers['approveStatus'] == appConstant :: $USER_POST_APPROVE_STATUS_WAITING){ ?>
					<td>
						<font color="orange">Wating to Approve (Request Sent)</font>
					</td>
				<?php }else if($showusers['approveStatus'] == appConstant :: $USER_POST_APPROVE_STATUS_BLOCKED){ ?>
					<td>
						<font color="red">USER IS BLOCKED</font>
					</td>
				<?php } ?>
				
				<?php if($showusers['approveStatus'] == appConstant :: $USER_POST_APPROVE_STATUS_WAITING) { ?>
					<td>
					<a href="?approve=<?php echo $showusers['id']; ?>">
					Yes
					</a> 
					/ 
					<a href="?decline=<?php echo $showusers['id']; ?>">
					No
					</a>
					</td>
				<?php }else if($showusers['approveStatus'] == appConstant :: $USER_POST_APPROVE_STATUS_NOTAPPROVE) { ?>
					<td> 
						No Request Sent
					</td>
				<?php }else if($showusers['approveStatus'] == appConstant :: $USER_POST_APPROVE_STATUS_APPROVED) { ?>
					<td>
					     <a href="?decline=<?php echo $showusers['id']; ?>">
							Remove
						</a>
						/
						<a href="?block=<?php echo $showusers['id']; ?>">
							Block
						</a>
					</td>
				<?php }else if($showusers['approveStatus'] == appConstant :: $USER_POST_APPROVE_STATUS_BLOCKED){ ?>
					<td>
						<a href="?unblock=<?php echo $showusers['id']; ?>">
							UnBlock
						</a>
					</td>
				<?php } ?>
				
				
			  
			  </tr>
			  <?php $i=$i+1; } ?>
			  
			</table>

	</center>
	</body>
</html>


















































