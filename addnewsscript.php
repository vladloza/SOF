<?php
    // ini_set('display_errors', 'On');
    // error_reporting(E_ALL);

function add_edit($id=0, $title='', $text=''){
    $out = '
    <div class="container">
    <div class="margin-top">
    <form method="POST">
        <input type="hidden" name="id" value="'.$id.'">
        <div>
        <div class="addNews">
            <div>
                <input class="admin-control" type="submit"';
    if ($id) {
        $out .= 'name="edit" value="Редагувати">'; 
    }
    else { 
        $out .= 'name="add" value="Додати">';
    }

    $out .= '</div>
        </div>
        <div class="margin-top addNewsBlock">
            <div class="editTitle">
                <span>Заголовок:</span>
               <div style="display:initial"><input type="text" name="title" value="'.$title.'"></div>
            </div>
            <div>
                <textarea name="text" id="editor1">'.$text.'</textarea>
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

        if($stmt) { echo '<font color="green">Запись добавлена!</font>';}
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

        if($stmt) { echo '<font color="green">Запись изменена!</font>';}
    }
    catch(Exeption $e)
    {
        echo "DB Falied! ".$e;
    }
}

?>