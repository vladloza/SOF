<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);
include("header.php");
require("addscript.php");

$sqlQuery = 'select * from employees where id = '.$_GET["id"];

try{  
    include("dbconfig.php");
    
    $smtp = $conn->query($sqlQuery);

    $row = $smtp->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);

    echo add_edit(true, $row[0], $row[1], $row[2]);
}
catch(Exeption $e)
{
    echo "DB Falied! ".$e;
}

?>