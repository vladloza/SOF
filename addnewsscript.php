<?php
    // ini_set('display_errors', 'On');
    // error_reporting(E_ALL);

function add_edit($id=0, $title='', $text=''){
    $out = '<form method="POST">
        <input type="hidden" name="id" value="'.$id.'">
        <table cellpadding="0" cellspacing="0" border="0" width="80%" align="center">
            <tr>
                <td><b>Заголовок:</b></td>
                <td><input type="text" name="title" value="'.$title.'" style="width: 98%"></td>
            </tr>
            <tr>
                <td colspan="2"><b>Текст:</b></td>
            </tr>
            <tr>
                <td colspan="2"><textarea name="text" style="width: 99%; height: 200px">'.$text.'</textarea></td>
            </tr>
            <tr><td colspan="2" align="center"><input type="submit" ';
    if ($id) {
        $out .= 'name="edit" value="Edit"'; 
    }
    else { 
        $out .= 'name="add" value="Add"';
    }

    $out .= '></td></tr>
        </table>
    </form>';

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