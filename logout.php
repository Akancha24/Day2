<?php
	session_destroy();
	setcookie('akansha@gmail.com',null,-1,'/');
	header("Location:http://example.com/Session_Cookie_Assignment/userLogin.html");
?>