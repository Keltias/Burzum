<section class="article__create">
    <div class="article__create-container">
        <fieldset class="article__create-form">
            <legend>
                <h2>Создание статьи</h2>
            </legend>
            <form method="POST">
                <div class="form-floating">
                    <input type="text" name="title" class="form-control" id="floatingInput" placeholder="placeholder">
                    <label for="floatingInput">Заголовок статьи</label>
                </div>
                <div class="form-floating">
                    <textarea class="article-text form-control" name="content" placeholder="placeholder" id="floatingTextarea2"></textarea>
                    <label for="floatingTextarea2">Содержание статьи</label>
                </div>
                <div class="form-floating">
                    <input type="text" name="author" class="form-control" id="floatingPassword" placeholder="placeholder">
                    <label for="floatingPassword">Автор статьи</label>
                </div>
                <div class="button-box">
                    <button class="btn w-50 btn btn-lg btn-primary" name="button" type="submit">Опубликовать</button>
                </div>
            </form>
        </fieldset>
    </div>
</section>
