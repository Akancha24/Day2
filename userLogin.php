 <?php
 $user_name=$_POST['user_name'];
 $user_password=$_POST['password'];
 $username="root";
 $password="root";
 $servername="localhost";
 try{
 	$connection=new PDO("mysql:host=$servername;dbname=user_details",$username,$password);
 	$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 	$sql="select id from login_details where name=:username and password=:password";
 	$statement=$connection->prepare($sql);
 	$statement->bindParam(':username',$user_name);
 	$statement->bindParam(':password',$password);
 	$statement->execute();
 	if(1==$statement->rowCount()){
	session_start();
	$_SESSION["username"] = $user_name;
	setcookie($user_name, $password, time() + 3600, "/"); 
	header("Location:http://example.com/Session_Cookie_Assignment/homepage.html");
	}
	else{
		header("Location:http://example.com/Session_Cookie_Assignment/userLogin.html");
	}
 }
 catch(PDOException $exception){
 	echo "Connection failed: ".$exception->getMessage();
 }
 ?> 	

