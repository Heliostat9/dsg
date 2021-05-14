<?php

session_start();
if(!isset($_SESSION["session_username"]) ):
header("location:index.php");
else:
    if ($_SESSION['status'] != 0){header("location:index.php");}
?>
<?php include('header.php');?>
<main>
<form class="form_login" action="testrequest.php" method="post">
        <p class="login_title">Оформление кредита</p>
        <div><input class="form_input" type="text" placeholder="Серия паспорта" name="series_pass" required></div>
        <div><input class="form_input" type="text" placeholder="Номер паспорта" name="number_pass" required></div>
        <div><input class="form_input" type="date" placeholder="Дата выдачи" name="date_pass" required></div>
        <div><input class="form_input" type="text" placeholder="Код подразделения" name="code_pass" required></div>
        <div><input class="form_input" type="text" placeholder="Сумма кредита" name="credit_sum" required></div>
        <div><input class="form_input" type="text" placeholder="Цель кредита" name="target" required></div>
        <div><input class="form_input" type="date" placeholder="Срок кредита" name="credit_date" required></div>
        <div><input class="form_submit" type="submit" name="submit" value="Отправить"></div>
    </form>
</main>
<?php include('footer.php'); ?>
<?php endif; ?>