<?php
    $host="localhost";
    $port=3306;
    $socket="";
    $user="root";
    $password="1q@W3e\$R";
    $dbname="usrdata";
    
    $con = mysql_connect($host, $user, $password, $dbname, $port, $socket)
        or die ('Could not connect to the database server' . mysqli_connect_error());
    
    //$con->close();
?>