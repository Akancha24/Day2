<?php
session_start();
if(!isset($_SESSION["username"])){
	echo "Login First!";
	die();
}
//echo "hi";
$selected_database=$_POST['option_selected'];
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
    $sql = $connection->prepare("SELECT id,first_name,last_name FROM user_info") ; 
    $sql->execute() ;
    if(0==$sql->rowCount()){
   		echo "No data to display!";
    }
    else{
  ?>
    	<!DOCTYPE html>
		<html>
		<body>
			<table align="center">
		    <thead>
		        <tr>
		            <th>ID</th>
		            <th>First Name</th>
		            <th>Last Name</th>
		        </tr>
		    </thead>
		    <tbody>
		        <?php while( $row = $sql->fetch()) : ?>
		        <tr>
		            <td><?php echo $row['id']; ?></td>
		            <td><?php echo $row['first_name']; ?></td>
		            <td><?php echo $row['last_name']; ?></td>
		        </tr>
		        <?php endwhile ?>
		    </tbody>
		</table>
		<form action="homepage.html" method="post">
			<input type="submit" name="back_button" value="Back">
		</form>
		</body>
		</html>

 <?php   
    }   
?>


