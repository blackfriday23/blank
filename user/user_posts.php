<?php 


$session = new sessionHandle();

$user = $session->getUser();

$db_operation=new dbOperation();
$fetchpost = $db_operation->fetchposts();

//$fetchpost = $post->fetchposts();

?>

<html>

	<body>
	
	<center>
		<h2> Latest Posts </h2>
		<hr width="400px">
		<?php if($fetchpost){ ?>
		<?php foreach($fetchpost as $showpost){ ?>
		<div class="post">
			<p> 
			   <img src="<?php echo appConstant :: $ROOT_DIR . $showpost['avatar']; ?>" width="60px"/>
		       
					<b> <u><?php echo $showpost['name'] ?></u> </b></br>
					<i> <?php echo $showpost['time'] ?> </i>
			   
			</p>
			<p> <?php echo $showpost['post']; ?>  </p>
			
			<?php if($user){ ?>
				<?php if($user->getType() == appConstant :: $USER_TYPE_GENERALUSER) { ?>
					<?php if($showpost['user_id'] == $user->getUserId()){ ?>
						<?php if ($showpost['can_edit'] == '1'){?>
							<p> <a href="user/edit_post.php?id=<?php echo $showpost['id']; ?>" target="_blank">Edit</a> </p>
						<?php }else{ ?>
							<p> Edited </p>
						<?php } ?>
					<?php } ?>				
				<?php } else { ?>
						<p> 
						<a href="user/edit_post.php?id=<?php echo $showpost['id']; ?>" target="_blank">Edit</a>
						<a href="?delete=<?php echo $showpost['id']; ?>">
							Delete
						</a>
						</p>
				<?php } ?>

			<?php }?>
			
			
			
			<hr width="150px"/>
		</div>
		<?php } ?>
		<?php }else{ ?>
		<p>No Post Yet </p>
		<?php } ?>
	</center>

	</body>

</html>