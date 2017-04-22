<?php

if (isset($_GET['id'])){
    include_once 'header.php';

    $output = '';

    try{             
        include("dbconfig.php");
        $id = $_GET["id"];
        $sqlQuery = "select * from News where id = '$id'";

        $result = $conn->query($sqlQuery);
            
        $row = $result->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);

        $output .= '<div class="container margin-top">  
                    <article class="clearfix">
                        <div class="main-image">
                             <img src="data:image;base64, '.$row[5].'"/>
                        </div>   
                        <header class="entry-header" style="display: inline-block;">
                                <h2 class="entry-title">'.stripslashes($row[1]).'</h2>
                            </header>
                        <div class="body-container clearfix">          
                            <div class="entry-summary">
                               <p>'.html_entity_decode($row[2]).'<p>
                            </div>
                        </div>        
                    </article> 
                    <div class="margin-top">
                        <div class="nav-previous">
                            <a href="#">< Как жить дальше?</a>
                        </div>
                        <div class="nav-next">
                             <a href="#">Невозможно жить дальше...></a>
                        </div>
                    </div>   
                </div>
                <hr>';
        echo $output;
    }
    catch(Exeption $e)
    {
        echo "DB Falied!";
    }

    include_once 'footer.php';
}
?>