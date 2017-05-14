<?php

$output = '<!DOCTYPE html>
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
<body class="home blog custom-font-enabled single-author hfeed">
<div id="page">
	<header id="masthead" class="site-header container" role="banner">
      <div class="navbar" role="navigation" style="margin:0px;">
      <div>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse themonic-nav">   
          <ul class="nav-menu">
            <li class="active"><a href="#">Головна</a></li>
            <li><a href="about.php">Про кафедру</a></li>
            <li><a href="abiturient.php">Абітурієнту</a></li>
            <li><a href="staff.php">Співробітники</a></li>
            <li><a href="news.php">Новини</a></li>
            <li><a href="services.php">Послуги</a></li>
            <li><a href="contacts.php">Контакти</a></li>
          </ul>
        </div><!--/.nav-collapse -->
        <div class="clear"></div>
      </div>
      </header>';

echo $output;

?>