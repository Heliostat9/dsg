<?php

session_start();
if(!isset($_SESSION["session_username"]) ):
header("location:index.php");
else:
    if ($_SESSION['status'] != 1){header("location:index.php");}
?>
<?php include('header.php');?>
<?php 
include('bd.php');
?>
<main>
<table border="1">
    <tr>
        <td>Цель кредита</td>
        <td>Начало кредита</td>
        <td>Конец кредита</td>
        <td>Сумма кредита</td>
        <td>Статус</td>
    </tr>
    <?php 
    /*
        if (isset($_GET['del'])) {
            $sql = mysqli_query($db, 'DELETE FROM `customers` where `id`="' . $_GET['del'] . '"');
            if ($sql) {
                echo "<p>Пользователь удалён</p>";
            } else {
                echo "<p>Ошибка</p>";
            }
        }

        if (isset($_GET['edit'])) {
            if (isset($_POST['first_name'])) {
                $sql = mysqli_query($db,'UPDATE customers SET ' 
                                    . '`first_name` = "' . $_POST['first_name'] . '",'
                                    . '`last_name` = "' . $_POST['last_name'] . '",'
                                    . '`middle_name` = "' . $_POST['middle_name'] . '",'
                                    . '`email` = "' . $_POST['email'] . '",'
                                    . '`login` = "' . $_POST['login'] . '",'
                                    . '`password` = "' . $_POST['password'] . '",'
                                    . '`status` = "' . $_POST['status'] . '" '
                                    . 'where `id` = ' .$_GET['edit']);
            }
        }
*/
        $iduser = $_SESSION['id'];
        $sql = mysqli_query($db, "SELECT * FROM credits");
        while ($result = mysqli_fetch_assoc($sql)) {
            if ($result['status'] == 1) {
                $answer = "Погащен";
            } else {
                $answer = "Активен";
            }
            echo '<tr><td>' . $result['name'] . '</td><td>' 
                            . $result['start_time'] . '</td><td>'
                            . $result['end_time'] . '</td><td>'
                            . $result['price'] . '</td><td>'
                            . $answer . '</td></tr>'
                            ;
                            
        }
    
    ?>
</table>

<?php
    if (isset($_GET['edit'])) {
        $sql = mysqli_query($db, "SELECT `first_name`, `last_name`, `middle_name`, `email`, `login`, `password`, `status` from customers where `id` = " . $_GET['edit']);
        $result = mysqli_fetch_assoc($sql);
    
?>
<table>
    <form action="" method="post">
        <tr>
            <td>Имя</td>
            <td><input type="text" name="first_name" value="<?php echo ($result['first_name']); ?>"></td>
        <tr>
        </tr>
        <tr>
            <td>Фамилия</td>
            <td><input type="text" name="last_name" value="<?php echo($result['last_name']); ?>"></td>
        </tr>
        <tr>
            <td>Отчество</td>
            <td><input type="text" name="middle_name" value="<?php echo ($result['middle_name']); ?>"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="<?php echo($result['email']); ?>"></td>
        </tr>
        <tr>
            <td>Логин</td>
            <td><input type="text" name="login" value="<?php echo($result['login']); ?>"></td>
        </tr>
        <tr>
            <td>Пароль</td>
            <td><input type="text" name="password" value="<?php echo($result['password']); ?>"></td>
        </tr>
        <tr>
            <td>Статус</td>
            <td><input type="text" name="status" value="<?php echo($result['status']); ?>"></td>
        </tr>
        <tr>
            <td><input type="submit" value="OK"></td>
        </tr>
    </form>
</table>
<?php } ?>
</main>
<?php include('footer.php'); ?>
<?php endif; ?>