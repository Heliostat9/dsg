<?php session_start();?>
<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <title>Банк Цусима - Мы выдаём кредиты под выгодный процент</title>
    <link href="style.css" rel="stylesheet">
</head>
<body style=" background-repeat: no-repeat; background-size: cover;">
<div style="position: absolute; z-index: -1;height:58px; width: 100%;background-color: white;"></div>    
<div class="container">
        
        <div class="fs">
            <header >
                <p>Банк Цусима</p>

                <ul>
                    <li><a href="index.php">Главная</a></li>
                    <?php
                    if (isset($_SESSION["session_username"]) )
                    {
                        if ($_SESSION['status'] == 2) {
                            echo '<li><a href="admin.php">Админка</a></li>';
                        } 
                        echo '<li><a href="logout.php">Выйти</a></li>';
                        echo '<li><a href="intropage.php">' . $_SESSION["session_username"] .'</a></li>';
                        
                    }
                    else 
                    {
                          echo '<li><a href="login.php">Войти</a></li>';
                          echo '<li><a href="registration.php">Зарегистрироваться</a></li>';
                    } 
                    ?>
                </ul>
            </header>