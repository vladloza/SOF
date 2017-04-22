<?php 
ini_set('display_errors', 'On');
error_reporting(E_ALL);

if (isset($_GET['des']) /*&& isset($_SESSION['currentUser'])*/){
    if($_GET['des']=='del'){

        $sqlQuery = 'delete from News where id = '.$_GET["id"];
        
        try{  
            require("dbconfig.php");
            
            $smtp = $conn->query($sqlQuery);
           
            header("Refresh:0; url=news.php");
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
            
    require("dbconfig.php");
    //$row[3] - DateTime Create
    $sqlQuery = 'select * from News order by id desc';

    $result = $conn->query($sqlQuery);
        
    while($row = $result->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
    {
        $output .= '<article>
                    <header class="entry-header">
                        <h2 style="display:inline-block" class="entry-title">
                            <a href="#">'.stripslashes($row[1]).'</a>
                        </h2>
                        <div style="display:inline-block; margin: 20px"><a href="editnews.php?id='.$row[0].'">Edit</a> | <a href="?des=del&id='.$row[0].'">Del</a></div>
                    </header>
                    <div class="entry-summary">
                        <p>'.html_entity_decode($row[2]).' 
                            <span class="read-more">
                                <a href="#'.$row[0].'">Read more</a>
                            </span>
                        </p>   
                    </div>
                    <footer class="entry-meta"></footer>
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
</div>';

echo $output;

include("footer.php");

?>