<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);
session_start();

if(isset($_POST['login'])) {
    $log = $_POST['log'];
    $pass = $_POST['pass'];

    include("dbconfig.php");

    $sqlQuery = "SELECT * from admins where UserName = :log and Password = :pass";

    $stmt = $conn->prepare($sqlQuery);

    $stmt->bindParam(':log', $log);
    $stmt->bindParam(':pass', $pass);
    $stmt->execute();

    $rows = $stmt->fetchAll();
    
    if($stmt->rowCount()) {
        $_SESSION['isLogged'] = true;
        header("Refresh:0; url=news.php");
    }
}

$output = '';

$output .= '
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="js/ckfinder/ckfinder.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <form method="POST" enctype="multipart/form-data">
    <body class="admin-body">
        <div class="login-page">
              <div class="admin-form">
                <form class="login-form">
                    <input type="text" name="log" placeholder="Логін"/>
                    <input type="password" name="pass" placeholder="Пароль"/>
                    <input type="submit" name="login" value="Увійти"></button>
                </form>
            </div>    
        </div>
    </body>
    </form>
</html>';

echo $output;

?>