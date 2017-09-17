<?php
include 'dbconfig.php';
ini_set('display_errors', 'On');
error_reporting(E_ALL);
$startFrom = $_POST['startFrom'];

$sqlQuery = 'select * from News order by id desc limit '.$startFrom.', 5';

$result = $conn->query($sqlQuery);
    
$news = '';
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
    $text = mb_substr($text, 0, 217, "UTF-8");
        
    if(!isset($_SESSION))
    {
        session_start();
    }
    $news .= '<article class="clearfix">
                <span class="date-wrapper">'.$row[3].'</span>
                <div class="image-container">
                    <img src="data:image;base64, '.$row[5].'"/>
                </div>
                <div class="body-container clearfix">
                    <header class="entry-header">';

    if (isset($_SESSION['isLogged']))
    {
        $news .=         '<div class="entry-admin"><a href="editnews.php?id='.$row[0].'">Редагувати</a> | <a href="?des=del&id='.$row[0].'">Видалити</a></div>';
    }

    $news .=             '<h2 class="entry-title">
                            <a href="item.php?id='.$row[0].'">'.stripslashes($row[1]).'</a>
                        </h2>
                    </header>
                    <div class="entry-summary">
                        <div class="entry-summary-body">'.$text.'... <span class="read-more">
                                <a href="item.php?id='.$row[0].'">Read more</a>
                            </span>  
                        </div>          
                    </div>
                </div>        
            </article>';
}
echo $news;

?>