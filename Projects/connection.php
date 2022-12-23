<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "project";

    $con = mysqli_connect($server,$username,$password,$database,3307);
    
    if(!$con){
        die("No connection".mysqli_connect_error());
    }
    else{
         //echo "Connection Successful";
    }
?>