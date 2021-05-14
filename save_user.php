<?php include 'header.php'?>
<?php
    if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['first_name'])) { $first_name = $_POST['first_name']; if ($first_name == '') { unset($first_name);} }
    if (isset($_POST['last_name'])) { $last_name = $_POST['last_name']; if ($last_name == '') { unset($last_name);} }
    if (isset($_POST['middle_name'])) { $middle_name = $_POST['middle_name'];} 
    if (isset($_POST['email'])) { $email = $_POST['email']; if ($email == '') { unset($email);} }
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
 if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
    //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
 $password = stripslashes($password);
    $password = htmlspecialchars($password);
    $first_name = stripslashes($first_name);
    $first_name = htmlspecialchars($first_name);
    $last_name = stripslashes($last_name);
    $last_name = htmlspecialchars($last_name);
    $middle_name = stripslashes($middle_name);
    $middle_name = htmlspecialchars($middle_name);
    $email = stripslashes($email);
    $email = htmlspecialchars($email);
 //удаляем лишние пробелы
    $login = trim($login);
    $password = trim($password);
    $first_name = trim($first_name);
    $last_name = trim($last_name);
    $middle_name = trim($middle_name);
    $email = trim($email);

    
 // подключаемся к базе
    include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
 // проверка на существование пользователя с таким же логином
    $result = mysqli_query($db, "SELECT id FROM customers WHERE login='$login'");
    $myrow = mysqli_fetch_assoc($result);
    if (!empty($myrow['id'])) {
    exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
    }
    
    
 // если такого нет, то сохраняем данные
    $result2 = mysqli_query ($db,"INSERT INTO customers (id,first_name,last_name,middle_name,email,login,password, status) VALUES(null,'$first_name', '$last_name', '$middle_name', '$email', '$login','$password', 0)");
    // Проверяем, есть ли ошибки
    if ($result2=='TRUE')
    {
    echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='index.php'>Главная страница</a>";
    }
 else {
    echo "Ошибка! Вы не зарегистрированы.";
    echo  mysqli_error($db);
    
    }?>
    <?php include 'footer.php'?>