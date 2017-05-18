<?php
include 'dbconfig.php';
ini_set('display_errors', 'On');
error_reporting(E_ALL);
$startFrom = $_POST['startFrom'];

$sqlQuery = 'select * from News order by id desc limit '.$startFrom.', 5';

$result = $conn->query($sqlQuery);
    
$articles = array();
while($row = $result->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
    $dom = new DOMDocument();
    $html = mb_convert_encoding(html_entity_decode($row[2]), 'HTML-ENTITIES', 'UTF-8');
    $dom->loadHTML($html);
    $res = $dom->getElementsByTagName('p');
    $text = null;
    foreach($res as $elem)
    {
        $text .= $elem->nodeValue;
    }
    $text = substr($text, 0, 400);
    $article = array();
    $article[0] = $row[0];
    $article[1] = $row[1];
    $article[2] = $text;
    $article[3] = $row[3];
    $article[4] = $row[4];
    $article[5] = $row[5];
    if(!isset($_SESSION))
    {
        session_start();
    }
    if(isset($_SESSION['isLogged']))
    {
        $article[6] = $_SESSION['isLogged'];
    }
    $articles[] = $article;
}
echo json_encode($articles);

?>