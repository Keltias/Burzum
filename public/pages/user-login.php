<?php require "./tpl/header.php" ?>
<section class="user__login">
    <div class="user__login-container">
        <fieldset class="user__login-form">
            <legend>Авторизация</legend>
            <form action="../handlers/UserLoginHandler.php" method="POST">
                <div class="form-floating">
                    <input type="text" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Пароль</label>
                </div>
                <div class="button-box">
                    <button class="w-50 btn btn-lg btn-primary" type="submit" name="button">Войти</button>
                </div>
                <div class="support-box">
                    <a href="#">Забыли пароль?</a>
                </div>
            </form>
        </fieldset>
    </div>
</section>
<?php require "./tpl/footer.php" ?>