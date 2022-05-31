
<section class="user__login">
    <div class="user__login-container">
        <fieldset class="user__login-form">
            <legend>Авторизация</legend>
            <form method="POST">
                <div class="form-floating">
                    <input type="text" name="username" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Логин</label>
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
                <div class="error-box">
                    <?php
                        if(isset($_SESSION['error']))
                        {
                            echo $_SESSION['error'];
                        }
                    ?>
                </div>
            </form>
        </fieldset>
    </div>
</section>
