<?php

//$conn = mysqli_connect('localhost','root','','eventvibe') or die('connection failed');
//$conn = mysqli_connect('jdbc:mysql://sql12.freesqldatabase.com:3306/sql12607400','sql12607400','QW8AK47F1q','eventvibe');
$conn = mysqli_connect('sql12.freesqldatabase.com','sql12607400','QW8AK47F1q','sql12607400');
//$conn = mysqli_connect('mysql: dbname=id20491307_eventvibe; host=localhost','id20491307_eventvibeweb','QW8AK47F1q','4Q-/<g=5GQRwknG8');

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