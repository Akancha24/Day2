<?php
session_start();
if(empty($SESSION['akansha@gmail.com'])){
	echo "Login First!";
	die();
}
$selected_database=$_POST['option_selected'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
if("mysql"==$selected_database){
	 $username="root";
	 $password="root";
	 $servername="localhost";
	 try{
	 	$connection=new PDO("mysql:host=$servername;dbname=user_details",$username,$password);
	 	$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	 }
	catch(PDOException $exception){
 		echo "Connection failed: ".$exception->getMessage();
 	}
}
else if("pgsql"==$selected_database){
	$username="postgres";
	$password="root";
	$servername="localhost";
	try{
		$connection=new PDO("pgsql:host=$servername;dbname=user_details",$username,$password);
	 	$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $exception){
 		echo "Connection failed: ".$exception->getMessage();
 	}

}
$sql="insert into user_info(first_name,last_name) values(:first_name , :last_name)";
$statement=$conn->prepare($sql);
$statement->bindParam(':first_name',$first_name);
$statement->bindParam(':last_name',$last_name);
$statement->execute();
header("Location:http://example.com/Session_Cookie_Assignment/homepage.html");
?>
