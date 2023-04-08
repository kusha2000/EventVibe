<?php

//$conn = mysqli_connect('localhost','root','','eventvibe') or die('connection failed');
//$conn = mysqli_connect('jdbc:mysql://sql12.freesqldatabase.com:3306/sql12607400','sql12607400','QW8AK47F1q','eventvibe');
//$conn = mysqli_connect('sql12.freesqldatabase.com','sql12610108','tzklByQlqj','sql12610108');
//$conn = mysqli_connect('mysql-120194-0.cloudclusters.net','admin','vDmxpQUR','eventVibe');
$conn = new mysqli('mysql-120194-0.cloudclusters.net','admin','vDmxpQUR','eventVibe',10090);


/*try{
    //$dsn="jdbc:mysql://sql6.freesqldatabase.com:3306/sql12607400";
    $dsn="localhoSt";
    $user="ql12607400";
    $pass="QW8AK47F1q";

    $conn=new PDO($dsn,$user,$pass);

    $conn->query("USE eventvibe");
}catch(PDOException $e){
    die("Error:".$e->getMessage());
}*/


if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>