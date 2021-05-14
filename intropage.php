<?php

session_start();

if(!isset($_SESSION["session_username"])):
header("location:login.php");
else:
?>
	
<?php include("header.php"); ?>
<main id="welcome">
<h2>Добро пожаловать, <span><?php
if ($_SESSION['status'] == 2) {
  echo " админ ";
} else if ($_SESSION['status'] == 1) {
  echo " оператор-кассир ";
} else {
  echo " пользователь ";
} 

echo $_SESSION['session_username']; ?>! </span></h2>
<?php 
if ($_SESSION['status'] == 0) {
  echo "<button class='btn' onClick=\"window.location.href='request.php'\">Оформить заявку</button>";
  echo "<button class='btn' onClick=\"window.location.href='credits.php'\">Мои кредиты</button>";
  echo "<button class='btn' onClick=\"window.location.href='myrequest.php'\">Заявки</button>";
  
 }
 

 if ($_SESSION['status'] == 1) {
  echo "<button class='btn' onClick=\"window.location.href='operatorrequest.php'\">Заявки</button>";
  echo "<button class='btn' onClick=\"window.location.href='operatorcredits.php'\">Кредиты</button>";
 }
 ?>
  <p><a href="logout.php">Выйти</a> из системы</p>
</main>
	
<?php include("footer.php"); ?>
	
<?php endif; ?>