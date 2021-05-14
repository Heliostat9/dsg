<?php include 'header.php'?>
<main style="box-sizing:border-box;width: 100%; background-color: white; padding: 20px 25px; border-radius: 5px;">
    <form class="form_login" action="save_user.php" method="post">
        <p class="login_title">Регистрация</p>
        <label for="login">Имя
        <div><input class="form_input" type="text" placeholder="Введите своё имя" name="first_name" required></div>
        </label>
        <label for="login">Фамилия
        <div><input class="form_input" type="text" placeholder="Введите свою фамилию" name="last_name" required></div>
        </label>
        <label for="login">Отчество
        <div><input class="form_input" type="text" placeholder="*Введите своё отчество" name="middle_name"></div>
        </label>
        <label for="login">Email
        <div><input class="form_input" type="email" placeholder="Введите свой Email" name="email" required></div>
        </label>
        <label for="login">Логин
        <div><input class="form_input" type="text" placeholder="Придумайте логин" name="login" required></div>
        </label>
        <label for="login">Пароль
        <div><input class="form_input" type="password" placeholder="Придумайте пароль" name="password" required></div>
        </label>
        <label for="login">Повторение пароля
        <div><input class="form_input" type="password" placeholder="Повторите пароль" required></div>
        </label>
        <div><input class="form_submit" type="submit" value="Зарегистрироваться"></div>
        <div><a href="login.php">У меня уже есть аккаунт</a></div>
        
    </form>
</main>
<?php include 'footer.php'?>