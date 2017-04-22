<?php
include 'dbconfig.php';

$startFrom = $_POST['startFrom'];

$sqlQuery = 'select * from News order by id desc limit '.$startFrom.', 5';

$result = $conn->query($sqlQuery);
    
$articles = array();
while($row = $result->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
    $articles[] = $row;
}

echo json_encode($articles);

?>