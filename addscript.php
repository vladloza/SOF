<?php
session_start();
ini_set('display_errors', 'On');
error_reporting(E_ALL);

function add_edit($isEmp = false, $id = 0, $title = '', $text = '')
{
    $out = '
    <div class="container">
    <div class="margin-top">
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="'.$id.'">
        <input type="hidden" name="employee" value="'.$isEmp.'">
        <div class="margin-top">
            <div class="editBlock">
                <span>';
    if (!$isEmp) {
        $out .= 'Заголовок:';
    } else {
        $out .= 'ПІБ';
    }
    $out .= '</span>
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
        $out .= 'name="edit" value="Редагувати"/>';
    } else {
        $out .= 'name="add" value="Додати"/>';
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
if ( isset($_SESSION['isLogged']))
{
    return $out;
}
    return "";
}

if (isset($_POST['add']) && isset($_SESSION['isLogged'])) {
    $title = $_POST['title'];
    $text = $_POST['text'];
    $date = date("Y-m-d H:i:s");
    $isEmp = $_POST['employee'];
    $target_name = '';
    $image = '';

    if (is_uploaded_file($_FILES['fileUpload']['tmp_name'])) {
        $target_name = basename($_FILES['fileUpload']['name']);
        $image = base64_encode(file_get_contents(addslashes($_FILES['fileUpload']['tmp_name'])));
    }
    
    if (isset($title)&&isset($text)&&$title!=''&&$text!='') {
        $sqlQuery = "";
        if (!$isEmp) {
            $sqlQuery .= "INSERT INTO News (Title, Text, CreateDate, ImageName, ImageBody) VALUES (:title, :text, :date, :imgName, :imgBody)";
        } else {
            $sqlQuery .= "INSERT INTO Employees (FullName, Text, ImageName, ImageBody) VALUES (:title, :text, :imgName, :imgBody)";
        }
        try {
            include("dbconfig.php");
                
            $stmt = $conn->prepare($sqlQuery);

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':text', $text);
            if (!$isEmp) {
                $stmt->bindParam(':date', $date);
            }
            $stmt->bindParam(':imgName', $target_name);
            $stmt->bindParam(':imgBody', $image);

            if ($stmt->execute()) {
                if (!$isEmp) {
                    header("Refresh:0; url=news.php");
                } else {
                    header("Refresh:0; url=staff.php");
                }
            } else {
                echo "Error!";
            }
        } catch (Exeption $e) {
            echo "DB Falied! ".$e;
        }
    } else {
        echo "Заповніть поля!";
    }
}

if (isset($_POST['edit']) && isset($_SESSION['isLogged'])) {
    $title = $_POST['title'];
    $text = $_POST['text'];
    $id = $_POST['id'];
    $isEmp = $_POST['employee'];
    $date = date("Y-m-d H:i:s");
    $target_name = '';
    $image = '';

    if (isset($title)&&isset($text)&&$title!=''&&$text!='') {
        if (!$isEmp) {
            $sqlQuery = "UPDATE News SET Title = :title, Text = :text, CreateDate= :date WHERE id = :id";
        } else {
            $sqlQuery = "UPDATE Employees SET FullName = :title, Text = :text WHERE id = :id";
        }

        if (is_uploaded_file($_FILES['fileUpload']['tmp_name'])) {
            $target_name = basename($_FILES['fileUpload']['name']);
            $image = base64_encode(file_get_contents(addslashes($_FILES['fileUpload']['tmp_name'])));
            if (!$isEmp) {
                $sqlQuery = "UPDATE News SET Title = :title, Text = :text, CreateDate= :date, ImageName = :target_name, ImageBody = :image WHERE id = :id";
            } else {
                $sqlQuery = "UPDATE Employees SET FullName = :title, Text = :text, ImageName = :target_name, ImageBody = :image WHERE id = :id";
            }
        }

        try {
            include("dbconfig.php");
            
            $stmt = $conn->prepare($sqlQuery);

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':text', $text);
            if (!$isEmp) {
                $stmt->bindParam(':date', $date);
            }
            $stmt->bindParam(':id', $id);
            if (is_uploaded_file($_FILES['fileUpload']['tmp_name'])) {
                $stmt->bindParam(':target_name', $target_name);
                $stmt->bindParam(':image', $image);
            }

            if ($stmt->execute()) {
                if (!$isEmp) {
                    header("Refresh:0; url=news.php");
                } else {
                    header("Refresh:0; url=staff.php");
                }
            } else {
                echo "Error!";
            }
        } catch (Exeption $e) {
            echo "DB Falied! ".$e;
        }
    } else {
        echo "Заповніть поля!";
    }
}
