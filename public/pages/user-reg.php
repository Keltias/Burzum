<?php 
    require "./tpl/header.php";
    use App\Controllers\UserController;

    if(isset($_POST['button']))
    {
        $data = [
            'username' => trim(htmlspecialchars($_POST['username'])),
            'email' => trim(htmlspecialchars($_POST['email'])),
            'password' => trim(htmlspecialchars($_POST['password'])),
            'password_confirm'  => trim(htmlspecialchars($_POST['password_confirm']))
        ];

        $user_reg = new UserController($data);
        $user_reg->UserRegister();
    }
?>
<section class="user__reg">
    <div class="user__reg-container">
        <fieldset class="user__reg-form">
            <legend>Регистрация пользователя</legend>
            <form method="POST">
                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Укажите ваш почтовый адрес</label>
                </div>
                <div class="form-floating">
                    <input type="text" name="username" class="form-control" id="floatingUsername" placeholder="Username">
                    <label for="floatingPassword">Придумайте логин</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Придумайте пароль</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password_confirm" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Подтвердите пароль</label>
                </div>
                <div class="button-box">
                    <button class="w-50 btn btn-lg btn-primary" type="submit" name="button">Зарегестрироваться</button>
                </div>
                <div class="support-box">
                    <a href="#">Уже есть аккаунт ?</a>
                </div>
                <div class="error-box">
                    <p>
                        <?php
                            if(isset($_SESSION['error']))
                            {
                                echo $_SESSION['error'];
                            }
                        ?>
                    </p>
                </div>
            </form>
        </fieldset>
    </div>
</section>
<?php require "./tpl/footer.php" ?>