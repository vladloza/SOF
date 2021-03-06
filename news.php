<?php 
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include("header.php");

if (isset($_GET['des']) && isset($_SESSION['isLogged'])){
    if($_GET['des'] =='del'){

        $sqlQuery = 'delete from News where id = '.$_GET["id"];
        
        try{  
            include("dbconfig.php");
            
            if($smtp = $conn->query($sqlQuery))
            {
                printf("<script>location.href='news.php'</script>");
            }
            else
            {
                echo "Error";
            }
        }
        catch(Exeption $e)
        {
            echo "DB Falied! ".$e;
        }
    }
}

$output = '';

$output .= '<div id="main" class="container margin-top">';

if (isset($_SESSION['isLogged']))
{
    $output .= '
    <div id="addNews">
        <div>
            <a href="addnews.php" class="admin-control">Додати новину</a>
        </div>
    </div>';
}

$output .= '
    <div class="wrapper2">
        <div id="primary" class="site-content">
            <div id="content" role="main">';

try{ 
            
    include("dbconfig.php");
    $sqlQuery = 'select * from News order by id desc limit 5';

    $result = $conn->query($sqlQuery);
        
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
        $output .= '<article class="clearfix">
                        <span class="date-wrapper">'.$row[3].'</span>
                        <div class="image-container">
                            <img src="data:image;base64, '.$row[5].'"/>
                        </div>
                        <div class="body-container clearfix">
                            <header class="entry-header">';

        if (isset($_SESSION['isLogged']))
        {
            $output .=         '<div class="entry-admin"><a href="editnews.php?id='.$row[0].'">Редагувати</a> | <a href="?des=del&id='.$row[0].'">Видалити</a></div>';
        }

        $output .=             '<h2 class="entry-title">
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
}
catch(Exeption $e)
{
    echo "DB Falied!";
}

$output .= '</div>
        </div>
    </div>
</div>
</div>
<script src="js/ajax.js"></script>';

echo $output;

include("footer.php");

?>

