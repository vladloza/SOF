<<<<<<< HEAD
<?php 
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include("header.php");
$output = '';

$output .= '<div id="main" class="container margin-top">
=======
<div id="main" class="container margin-top">
<div id="addNews">
    <div>
        <a href="#" class="admin-control">Додати новину</a>
    </div>
</div>
>>>>>>> origin/master
    <div class="wrapper2">
        <div id="primary" class="site-content">
            <div id="content" role="main">';

try{
            
    require("dbconfig.php");
    //$row[3]
    $sqlQuery = 'select * from News order by id desc';

    $result = $conn->query($sqlQuery);
        
    while($row = $result->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
    {
        $output .= '<article>
                    <header class="entry-header">
                        <h2 class="entry-title">
                            <a href="#">'.stripslashes($row[1]).'</a>
                        </h2>
                    </header>
                    <div class="entry-summary">
                        <p>'.stripslashes($row[2]).'
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
    echo "DB Falied! ".$e;
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