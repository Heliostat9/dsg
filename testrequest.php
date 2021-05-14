<?php
session_start();
if(isset($_SESSION["session_username"])){
header("Location: intropage.php");
}

?>
<?php
if (isset($_POST['series_pass'])) { $series_pass = $_POST['series_pass']; if ($series_pass == '') { unset($series_pass);} }
if (isset($_POST['number_pass'])) { $number_pass = $_POST['number_pass']; if ($number_pass == '') { unset($number_pass);} }
if (isset($_POST['date_pass'])) { $date_pass = $_POST['date_pass']; if ($date_pass == '') { unset($date_pass);} }
if (isset($_POST['code_pass'])) { $code_pass = $_POST['code_pass']; if ($code_pass == '') { unset($code_pass);} }
if (isset($_POST['credit_sum'])) { $credit_sum = $_POST['credit_sum']; if ($credit_sum == '') { unset($credit_sum);} }
if (isset($_POST['credit_date'])) { $credit_date = $_POST['credit_date']; if ($credit_date == '') { unset($credit_date);} }
if (isset($_POST['target'])) { $target = $_POST['target']; if ($target == '') { unset($target);} }
if (empty($series_pass) or empty($number_pass) or empty($date_pass) or empty($code_pass) or empty($credit_sum) or empty($credit_date) ) {
    exit("Вы не ввели все поля!");
}
    $series_pass = stripslashes($series_pass);
    $series_pass = htmlspecialchars($series_pass);
    $number_pass = stripslashes($number_pass);
    $number_pass = htmlspecialchars($number_pass);
    $date_pass = stripslashes($date_pass);
    $date_pass = htmlspecialchars($date_pass);
    $code_pass = stripslashes($code_pass);
    $code_pass = htmlspecialchars($code_pass);
    $credit_sum = stripslashes($credit_sum);
    $credit_sum = htmlspecialchars($credit_sum);
    $credit_date = stripslashes($credit_date);
    $credit_date = htmlspecialchars($credit_date);
    $target = stripslashes($target);
    $target = htmlspecialchars($target);


    
    $series_pas = trim($series_pas);
    $number_pass = trim($number_pass);
    $date_pass = trim($date_pass);
    $code_pass = trim($code_pass);
    $credit_sum = trim($credit_sum);
    $credit_date = trim($credit_date);

    $credit_date = date('Y-m-d H:i:s', strtotime($credit_date));
    $date_pass = date('Y-m-d H:i:s', strtotime($date_pass));

    include ("bd.php");
    $id = $_SESSION['id'];

    $result = mysqli_query ($db,"INSERT INTO `requests` (`id`, `id_user`,`series_pass`,`number_pass`,`date_pass`,`code_pass`,`credit_sum`,`credit_date`, `target`) VALUES(null,$id ,$series_pass, $number_pass, '$date_pass', $code_pass, $credit_sum,'$credit_date', '$target');");

    if ($result2=='TRUE')
    {
    echo "Заявка принята";
    }
 else {
    echo "Ошибка! Что-то пошло не так!";
    echo  mysqli_error($db);
    
    }


?>
 