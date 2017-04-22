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
    $target_name = '';
    $image = '';

    if (is_uploaded_file($_FILES['fileUpload']['tmp_name']))
    {
        $target_name = basename($_FILES['fileUpload']['name']);
        $image = base64_encode(file_get_contents(addslashes($_FILES['fileUpload']['tmp_name'])));
    }
    
    if (isset($title)&&isset($text)&&$title!=''&&$text!='')
    {
        $sqlQuery = "INSERT INTO News (Title, Text, CreateDate, ImageName, ImageBody) VALUES (:title, :text, :date, :imgName, :imgBody)";

        try{
            include("dbconfig.php");
                
            $stmt = $conn->prepare($sqlQuery);

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':text', $text);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':imgName', $target_name);
            $stmt->bindParam(':imgBody', $image);

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
    else echo "Заповніть поля!";
}

if(isset($_POST['edit'])){        
    $title = addslashes(htmlspecialchars($_POST['title'])); 
    $text = addslashes(htmlspecialchars($_POST['text']));
    $id = $_POST['id'];
    $date = date("Y-m-d H:i:s");
    $target_name = '';
    $image = '';

    if (isset($title)&&isset($text)&&$title!=''&&$text!='')
    {
        $sqlQuery = "UPDATE News SET Title = :title, Text = :text, CreateDate= :date WHERE id = :id";

        if (is_uploaded_file($_FILES['fileUpload']['tmp_name']))
        {
            $target_name = basename($_FILES['fileUpload']['name']);
            $image = base64_encode(file_get_contents(addslashes($_FILES['fileUpload']['tmp_name'])));
            $sqlQuery = "UPDATE News SET Title = :title, Text = :text, CreateDate= :date, ImageName = :target_name, ImageBody = :image WHERE id = :id";
        }

        try{
            
            include("dbconfig.php");
            
            $stmt = $conn->prepare($sqlQuery);

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':text', $text);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':id', $id);
            if (is_uploaded_file($_FILES['fileUpload']['tmp_name']))
            {
                $stmt->bindParam(':target_name', $target_name);
                $stmt->bindParam(':image', $image);
            }

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
    else echo "Заповніть поля!";
}

?>