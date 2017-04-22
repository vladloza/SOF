<?php
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

function add_edit($id=0, $title='', $text=''){
    $out = '
    <div class="container">
    <div class="margin-top">
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="'.$id.'">
        <div class="margin-top">
            <div class="editBlock">
                <span>Заголовок:</span>
               <div><input type="text" name="title" style="font-weight: bold" value="'.$title.'"></div>
            </div>
            <div class="editBlock">
                <span>Оберіть фото</span>
                <div>
                    <input id="fileUpload" name="fileUpload" type="file" accept="image/jpeg,image/png,image/gif"/>
                </div>
            </div>
            <div>
                <textarea name="text" id="editor1">'.$text.'</textarea>
            </div>
            <div class="addNews">
                <div>
                    <input class="admin-control" style="width:100%" type="submit"';
    if ($id) {
        $out .= 'name="edit" value="Редагувати">'; 
    }
    else { 
        $out .= 'name="add" value="Додати">';
    }

    $out .= '</div>
        </div>
        </div>
    </div>
</form>
    <script type="text/javascript">
            var editor = CKEDITOR.replace( "editor1" );
            CKFinder.setupCKEditor( editor );
        </script>
    </div>
</div>';

    return $out;
}

if(isset($_POST['add'])){        
    $title = addslashes(htmlspecialchars($_POST['title'])); 
    $text = addslashes(htmlspecialchars($_POST['text']));
    $date = date("Y-m-d H:i:s");

    $sqlQuery = "INSERT INTO News (Title, Text, CreateDate, ImagePath) VALUES (:title, :text, :date, :imgPath)";

    try{
        $target_dir = 'uploads/';
        $target_file = $target_dir . basename($_FILES['fileUpload']['name']);
        
        if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $target_file))
        {
            require("dbconfig.php");
            
            $stmt = $conn->prepare($sqlQuery);

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':text', $text);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':imgPath', $target_file);

            if ($stmt->execute())
            {
                header("Refresh:0; url=news.php");
            }
            else
            {
                echo "Error!";
            }
        }
        else { echo "Error!"; }
    }
    catch(Exeption $e)
    {
        echo "DB Falied! ".$e;
    }
}

if(isset($_POST['edit'])){        
    $title = addslashes(htmlspecialchars($_POST['title'])); 
    $text = addslashes(htmlspecialchars($_POST['text']));
    $id = $_POST['id'];
    $date = date("Y-m-d H:i:s");

    $sqlQuery = "UPDATE News SET Title = :title, Text = :text, CreateDate= :date WHERE id = :id";

    try{
        
        require("dbconfig.php");
        
        $stmt = $conn->prepare($sqlQuery);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute())
        {
            header("Refresh:0; url=news.php");
        }
        else
        {
            echo "Error!";
        }
    }
    catch(Exeption $e)
    {
        echo "DB Falied! ".$e;
    }
}

?>