<?php

session_start();
if(!isset($_SESSION["session_username"]) ):
header("location:index.php");
else:
    if ($_SESSION['status'] != 2){header("location:index.php");}
?>
<?php include('header.php');?>
<?php 
include('bd.php');
?>
<main>
<table border="1">
    <tr>
        <td>Идентификатор</td>
        <td>Имя</td>
        <td>Фамилия</td>
        <td>Отчество</td>
        <td>Email</td>
        <td>Логин</td>
        <td>Пароль</td>
        <td>Статус</td>
    </tr>
    <?php 
        if (isset($_GET['del'])) {
            $sql = mysqli_query($db, 'DELETE FROM `customers` where `id`="' . $_GET['del'] . '"');
            echo mysqli_error($db);
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

        $sql = mysqli_query($db, "SELECT * FROM customers");
        while ($result = mysqli_fetch_assoc($sql)) {
            echo '<tr><td>' . $result['id'] . '</td><td>' 
                            . $result['first_name'] . '</td><td>'
                            . $result['last_name'] . '</td><td>'
                            . $result['middle_name'] . '</td><td>'
                            . $result['email'] . '</td><td>'
                            . $result['login'] . '</td><td>'
                            . $result['password'] . '</td><td>'
                            . $result['status'] . '</td><td><a href="?del='
                            . $result['id'] . '">Удалить</a></td>'
                            . '<td><a href="?edit=' . $result['id'] . '">Редактировать</a></td></tr>'
                            ;
                            
        }

        if(isset($_GET['sort'])) {
            if($_GET['sort'] == 'asc') {
                $sql = mysqli_query($db, "SELECT * FROM customers ORDER BY ASC");
                while ($result = mysqli_fetch_assoc($sql)) {
                echo '<tr><td>' . $result['id'] . '</td><td>' 
                                . $result['first_name'] . '</td><td>'
                                . $result['last_name'] . '</td><td>'
                                . $result['middle_name'] . '</td><td>'
                                . $result['email'] . '</td><td>'
                                . $result['login'] . '</td><td>'
                                . $result['password'] . '</td><td>'
                                . $result['status'] . '</td><td><a href="?del='
                                . $result['id'] . '">Удалить</a></td>'
                                . '<td><a href="?edit=' . $result['id'] . '">Редактировать</a></td></tr>'
                                ;                   
                }
            }
            elseif($_GET['sort'] == 'desc') {
                $sql = mysqli_query($db, "SELECT * FROM customers ORDER BY DESC");
                while ($result = mysqli_fetch_assoc($sql)) {
                echo '<tr><td>' . $result['id'] . '</td><td>' 
                                . $result['first_name'] . '</td><td>'
                                . $result['last_name'] . '</td><td>'
                                . $result['middle_name'] . '</td><td>'
                                . $result['email'] . '</td><td>'
                                . $result['login'] . '</td><td>'
                                . $result['password'] . '</td><td>'
                                . $result['status'] . '</td><td><a href="?del='
                                . $result['id'] . '">Удалить</a></td>'
                                . '<td><a href="?edit=' . $result['id'] . '">Редактировать</a></td></tr>'
                                ;                   
                }
            }
        } else {
            $sql = mysqli_query($db, "SELECT * FROM customers");
            while ($result = mysqli_fetch_assoc($sql)) {
            echo '<tr><td>' . $result['id'] . '</td><td>' 
                            . $result['first_name'] . '</td><td>'
                            . $result['last_name'] . '</td><td>'
                            . $result['middle_name'] . '</td><td>'
                            . $result['email'] . '</td><td>'
                            . $result['login'] . '</td><td>'
                            . $result['password'] . '</td><td>'
                            . $result['status'] . '</td><td><a href="?del='
                            . $result['id'] . '">Удалить</a></td>'
                            . '<td><a href="?edit=' . $result['id'] . '">Редактировать</a></td></tr>'
                            ;                   
            }
        }
    
    ?>
</table>

<?php
    if (isset($_GET['edit'])) {
        $sql = mysqli_query($db, "SELECT `first_name`, `last_name`, `middle_name`, `email`, `login`, `password`, `status` from customers where `id` = " . $_GET['edit']);
        $result = mysqli_fetch_assoc($sql);
    
?>
<table>
    <form action="">
        <select name="sort">
            <option value="asc">По возрастанию</option>
            <option value="desc">По убыванию</option>
            <option value="desc">По умолочанию</option>
        </select>
        <input type="submit" value="Сортировать">
    </form>
    <form action="" method="post">
        <label>
            Имя
            <input type="text" name="first_name" value="<?php echo ($result['first_name']); ?>">
        </label>
        <label>
            Фамилия
            <input type="text" name="last_name" value="<?php echo($result['last_name']); ?>">
        </label>
        <label>
            Отчество
            <input type="text" name="middle_name" value="<?php echo ($result['middle_name']); ?>">
        </label>
        <label>
            Email
            <input type="text" name="email" value="<?php echo($result['email']); ?>">
            </label>
        <label>
            Логин
            <input type="text" name="login" value="<?php echo($result['login']); ?>">
        </label>
        <label>
            Пароль
            <input type="text" name="password" value="<?php echo($result['password']); ?>">
        </label>
        <label>
            Статус
            <input type="text" name="status" value="<?php echo($result['status']); ?>">
        </label>
        <label>
            <input type="submit" value="OK">
        </label>
        
    </form>
</table>
<?php } ?>
</main>
<?php include('footer.php'); ?>
<?php endif; ?>
