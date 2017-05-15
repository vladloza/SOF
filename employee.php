<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
if (isset($_GET['id'])){
    include_once 'header.php';
    $output = '';

    try{             
        include("dbconfig.php");
        $id = $_GET["id"];
        $sqlQuery = "select * from employees where id = '$id'";

        $result = $conn->query($sqlQuery);
            
        $row = $result->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);

        $output .= '
        <div class="margin-top">
            <div class="employee-wrapper">
                <div class="container">
                    <div class="single-employee-sidebar">
                        <div class="employee-image">
                            <img src="data:image;base64, '.$row[3].'"/>
                        </div>
                        <div class="employee-content">
                            <h2 class="center-text">'.$row[1].'</h2>
                        </div>
                    </div>
                    <div class="single-employee-content">
                        <div class="column-container clearfix">
                            <div class="employee-text">
                                <p>'.$row[2].'</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
    
        echo $output;
    }
    catch(Exeption $e)
    {
        echo "DB Falied!";
    }

    include_once 'footer.php';
}
?>