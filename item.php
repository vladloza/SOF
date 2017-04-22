<?php

if (isset($_GET['id'])){
    include_once 'header.php';

    $output = '';

    try{             
        include("dbconfig.php");
        $id = $_GET["id"];
        $sqlQuery = "(select * from News where id = :id) union (select * from News where id<:id order by id desc limit 1) union (select * from News where id>:id order by id asc limit 1)";

        $stmt = $conn->prepare($sqlQuery);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $rows = $stmt->fetchAll();

        $row = $rows[0];
        $rowLeft = $rows[1];
        $rowRight = null;
        if (count($rows)==3) {
            $rowRight = $rows[2];
        }
        elseif ($rowLeft[0]>$row[0]) {
            $rowRight = $rowLeft; 
            $rowLeft = null;
        }

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
                    <div class="margin-top">';

        if ($rowLeft) $output .=     '<div class="nav-previous">
                            <a href="item.php?id='.$rowLeft[0].'"><-- '.$rowLeft[1].'</a>
                        </div>';
        if ($rowRight) $output .=     '<div class="nav-next">
                             <a href="item.php?id='.$rowRight[0].'">'.$rowRight[1].' --></a>
                        </div>';
        $output .= '</div>   
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