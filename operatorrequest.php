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
        <td>Сумма кредита</td>
        <td>Цель</td>
        <td>Имя</td>
        <td>Фамилия</td>
        <td>Отчество</td>
        <td>Срок кредита</td>
        <td>Статус</td>
    </tr>
    <?php 
        /*if (isset($_GET['del'])) {
            $sql = mysqli_query($db, 'DELETE FROM `customers` where `id`="' . $_GET['del'] . '"');
            if ($sql) {
                echo "<p>Пользователь удалён</p>";
            } else {
                echo "<p>Ошибка</p>";
            }
        }
*/
        if (isset($_GET['edit'])) {
            if (isset($_POST['status'])) {
                $sql = mysqli_query($db,'UPDATE requests SET ' 
                                    . '`status` = "' . $_POST['status'] . '" '
                                    . 'where `id` = ' .$_GET['edit']);
                //TODO сделать вставку если статус одобрено и удалить заявку
                if ($_POST['status'] == 1) {
                   
                    $dat = date('Y-m-d', time());
                    if (isset($_POST['target'])) {$tar = $_POST['target'];}
                    $iuser = $_POST['id_user'];
                    $cd = $_POST['credit_date'];
                    $cs = $_POST['credit_sum'];
                    $dv = 0;
                    echo $dat;
                    $sql = mysqli_query($db,"INSERT INTO credits VALUES(null,$iuser, '$tar', '$dat' , '$cd',$cs, $dv);");
                    echo mysqli_error($db);
                    
                }
                
                
            }
        }
        $id = $_SESSION['id'];
        $sql = mysqli_query($db, "SELECT * FROM requests");
        while ($result = mysqli_fetch_assoc($sql)) {
            $id_user = $result['id_user'];
            $result_user = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM customers where id='$id_user'"));
            if ($result['status'] == 1) {$answer ="Одобрено";}
            else if ($result['status'] == 2) {$answer ="Отклонено";}
            else {$answer = "На рассмотрении";}  
            echo '<tr><td>' . $result['credit_sum'] . '</td><td>' 
                            . $result['target'] . '</td><td>'
                            . $result_user['first_name'] . '</td><td>'
                            . $result_user['last_name'] . '</td><td>'
                            . $result_user['middle_name'] . '</td><td>'
                            . $result['credit_date'] . '</td><td>'
                            . $answer  . '</td>'
                            . '<td><a href="?edit=' . $result['id'] . '">Редактировать</a></td>'
    
                            ;
                            
        }
    
    ?>
</table>

<?php
    if (isset($_GET['edit'])) {
        $sql = mysqli_query($db, "SELECT `credit_sum`,`target`, `id_user`, `credit_date`, `status`, `id` from requests where `id` = " . $_GET['edit']);
        $result = mysqli_fetch_assoc($sql);
    
?>
<table>
    <form action="" method="post">
        <tr>
            <td>Сумма кредита</td>
            <td><input type="text" name="credit_sum"  value="<?php echo ($result['credit_sum']); ?>"></td>
        <tr>
        <tr>
            <td>Цель кредита</td>
            <td><input type="text" name="target"  value="<?php echo ($result['target']); ?>"></td>
        <tr>
        </tr>
        <tr>
            <td>Срок кредита</td>
            <td><input type="text" name="credit_date"   value="<?php echo($result['credit_date']); ?>"> <input  type="text" name="id_user" value="<?php echo($result['id_user']); ?>"></td>

        </tr>
        <tr>
            <td>Статус</td>
            <td>
            <label for="cars">Статус</label>
            <select id="cars" name="status">
            <option value="0" <?php if($result['status'] == 0) echo "selected"; ?>>На рассмотрении</option>
            <option value="1" <?php if($result['status'] == 1) echo "selected"; ?>>Одобрено</option>
            <option value="2" <?php if($result['status'] == 2) echo "selected"; ?>>Отклонено</option>
            </select> 
            </td>
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