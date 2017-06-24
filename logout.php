<?php 
session_start();
unset($_SESSION['isLogged']);
printf("<script>location.href='index.php'</script>");
?>