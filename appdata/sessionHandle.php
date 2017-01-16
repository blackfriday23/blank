<?php
class sessionHandle{
	
	
	//include('appdata/sessionHandle.php');
	//include('../model/user.php');
	  
	
	
	function __construct() {            
        if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}      
    }  
	
	function setUser($user){
		$_SESSION['user']=$user;
		//$_SESSION['id']=$user->getUserId();
		//$_SESSION['name']=$user->getName();
		//$_SESSION['email']=$user->getEmail();
		//$_SESSION['avatar']=$user->getAvatar();
		//$_SESSION['isApprove']=$user->getisApprove();
		//$_SESSION['type']=$user->getType();
	}
	
	function getUser(){
		
		//include('../model/user.php');
		
		//$user_id =(isset($_SESSION['id'])?$_SESSION['id']:'');
		//$name =(isset($_SESSION['name'])?$_SESSION['name']:'');
		//$email =(isset($_SESSION['email'])?$_SESSION['email']:'');
		//$avatar =(isset($_SESSION['avatar'])?$_SESSION['avatar']:'');
		//$isApprove =(isset($_SESSION['isApprove'])?$_SESSION['isApprove']:'');
		//$type =(isset($_SESSION['type'])?$_SESSION['type']:'');
		
		//$user = new user($user_id,$name,$email,$avatar,$isApprove,$type);
		
		return $user =(isset($_SESSION['user'])?$_SESSION['user']:'');
		
		 
	}
	function destroy_session(){
		session_unset(); 
		session_destroy();	
	}
}
?>