<?php 
ini_set('display_errors', 'On');
error_reporting(E_ALL);

if (isset($_GET['des']) /*&& isset($_SESSION['currentUser'])*/){
    if($_GET['des']=='del'){

        $sqlQuery = 'delete from News where id = '.$_GET["id"];
        
        try{  
            include("dbconfig.php");
            
            if($smtp = $conn->query($sqlQuery))
            {
                header("Refresh:0; url=news.php");
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

include("header.php");
$output = '';

$output .= '<div id="main" class="container margin-top">
<div id="addNews">
    <div>
        <a href="addnews.php" class="admin-control">Додати новину</a>
    </div>
</div>
    <div class="wrapper2">
        <div id="primary" class="site-content">
            <div id="content" role="main">';

try{ 
            
    include("dbconfig.php");
    $sqlQuery = 'select * from News order by id desc limit 5';

    $result = $conn->query($sqlQuery);
        
    while($row = $result->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
    {
        $output .= '<article class="clearfix">
                        <div class="image-container">
                            <img src="data:image;base64, '.$row[5].'"/>
                        </div>
                        <div class="body-container clearfix">
                            <header class="entry-header">
                            <div class="entry-admin"><a href="editnews.php?id='.$row[0].'">Редагувати</a> | <a href="?des=del&id='.$row[0].'">Видалити</a></div>
                                <h2 class="entry-title">
                                    <a href="item.php?id='.$row[0].'">'.stripslashes($row[1]).'</a>
                                </h2>
                                
                            </header>
                            <div class="entry-summary">
                                <p>'.html_entity_decode($row[2]).' 
                                    <span class="read-more">
                                        <a href="item.php?id='.$row[0].'">Read more</a>
                                    </span>
                                </p>   
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
        <div class="pager">
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
        </div>
    </div>
</div>
</div>
<script src="js/ajax.js"></script>';

echo $output;

include("footer.php");

?>

