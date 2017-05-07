<?php include("header.php"); ?>

<?php $output = '';

$output .= '
<div class="container">
    <div class="clearfix staff-header-container margin-top">
        <div class="col-md-4">
            <div class="staff-header">
                <h2>НАША МЕТА</h2>
            </div>
        </div>
        <div class="col-md-8">
            <div class="staff-small-header">
                <h4>Завдання викладачів кафедри навчити студентів <strong>розв’язувати задачі, що пов’язані з написанням програмного і мікропрограмного забезпечення</strong> для вбудованих мікроконтролерів.</h4>
            </div>
        </div>
    </div>
    <div class="team-header">
        <div class="team-header-inside">
            <h2>Наша команда</h2>
        </div>
    </div>
    <div class="clearfix">
';
try{ 
            
    include("dbconfig.php");
    $sqlQuery = 'select * from teachers order by id';

    $result = $conn->query($sqlQuery);
   
    while($row = $result->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
    {
       $output .= '
       <div class="col-xs-6 col-sm-3 staff-block">
            <div class="block-inside">
                <div class="block-content">
                    <a href="#">
                        <div class="image-block-wrapper">
                            <img src="data:image;base64, '.$row[3].'" class="image-block">
                        </div>
                        <div class="image-caption-wrapper">
                            <div class="image-caption">
                                <p>'.$row[1].'</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
       ';             
    }
}
catch(Exeption $e)
{
    echo "DB Falied!";
}

$output .= '    </div>
</div>
<hr>';
echo $output;

include("footer.php");
 ?>

