<div class="container center">
    <form method="post">
        <label for="login">Ваш логин</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">@</span>
            </div>
            <input name="login" id="login" type="text" class="form-control" placeholder="Username">
        </div>

        <label for="login">Ваш пароль</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">#</span>
            </div>
            <input name="password" id="login" type="password" class="form-control" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-block btn-primary">
            Войти
        </button>
    </form>
</div>

<script>
    $("html").css("height", "100%");
    $("body").css("height", "100%");
</script>