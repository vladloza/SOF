<?php

if (isset($_GET['id'])){
    include_once 'header.php';

    $output = '';

    try{             
        require("dbconfig.php");
        $id = $_GET["id"];
        $sqlQuery = "select * from News where id = '$id'";

        $result = $conn->query($sqlQuery);
            
        $row = $result->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);

        $output .= '<strong>id: </strong>'.$row[0];
        $output .= '<br/><strong>Title: </strong>'.$row[1];
        $output .= '<br/><strong>Text: </strong>'.$row[2];
        $output .= '<br/><strong>CreateDate: </strong>'.$row[3];
        $output .= '<br/><strong>ImagePath: </strong>'.$row[4];

        echo $output;
    }
    catch(Exeption $e)
    {
        echo "DB Falied!";
    }

    include_once 'footer.php';
}
?>