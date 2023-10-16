<?php
$servername="localhost";
$username="root";
$password="";
$database="notes";
$table="mynotes";

//Connect to  localhost using PHP

$conn=mysqli_connect($servername,$username,$password);

//Create a database using PHP

$sql="CREATE DATABASE ".$database."";

$result= mysqli_query($conn,$sql);

//Connect to  database using PHP

$conn=mysqli_connect($servername,$username,$password,$database);

//Create a table in a database using PHP

$sql="CREATE TABLE `".$table."` (`sno` INT(11) NOT NULL AUTO_INCREMENT ,
`title` VARCHAR(100) NOT NULL , `description` VARCHAR(1000) NOT NULL ,
 PRIMARY KEY (`sno`)) ;";

 $result= mysqli_query($conn,$sql);

?>