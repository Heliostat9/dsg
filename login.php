<?php include 'header.php'?>
<main>
    <form class="form_login" action="testreg.php" method="post">
        <p class="login_title">Вход</p>
        <label for="login">Логин
        <div><input  id="login" class="form_input" type="text" placeholder="Введите логин" name="login" required></div>
        </label>
        <label for="password">Пароль
        <div><input id="password" class="form_input" type="password" placeholder="Введите пароль" name="password" required></div>
        </label>
        
        <div><input class="form_submit" type="submit" name="submit" value="Войти"></div>
        
        <a href="registration.php">У меня нет аккаунта</a>
    </form>
</main>
<?php include 'footer.php'?>