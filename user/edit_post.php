<?php

include_once "../database/dbOperation.php";

$post_id = (isset($_GET['id'])?$_GET['id']:'');


$db_operation=new dbOperation();
$post = $db_operation->getPost($post_id);

$makeedit = (isset($_POST['makeedit'])?$_POST['makeedit']:'');
if($makeedit){
	
	$postdesc=(isset($_POST['postdesc'])?$_POST['postdesc']:'');

	$insertpost = $db_operation->updatePost($post_id,$postdesc);
	
	header("Location:../index.php");
}


?>


<html>
<body>

<center>
	<div id="postarea">
		<form method="post" action="">
			<p><textarea name="postdesc" style="width:250px;height:60px" placeholder="Say any thing"><?php echo $post ?></textarea></p>
				
				<p><input type="submit" name="makeedit"/></p>
				<hr width="280px"/>
		</form>
	</div>
</center>	


</body>
</html>