<?php
    // ini_set('display_errors', 'On');
    // error_reporting(E_ALL);

function add_edit($id=0, $title='', $text=''){
    $out = '
    <div class="container">
    <div class="margin-top">
    <form method="POST">
        <input type="hidden" name="id" value="'.$id.'">
        <div class="margin-top">
            <div class="editBlock">
                <span>Заголовок:</span>
               <div><input type="text" name="title" style="font-weight: bold" value="'.$title.'"></div>
            </div>
            <div class="editBlock">
                <span>Оберіть фото</span>
                <div>
                    <input id="Upload" type="file" name="file" accept="image/jpeg,image/png,image/gif"/>
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

    $sqlQuery = "INSERT INTO News (Title, Text, CreateDate) VALUES (:title, :text, :date)";

    try{
        
        require("dbconfig.php");
        
        $stmt = $conn->prepare($sqlQuery);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':date', $date);            

        $stmt->execute();

        header("Refresh:0; url=news.php");
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

        $stmt->execute();

        header("Refresh:0; url=news.php");
    }
    catch(Exeption $e)
    {
        echo "DB Falied! ".$e;
    }
}

?>