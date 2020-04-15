<?php

/** @var $user \app\models\crud\User */

if ($it_is_me = is_object($user) && ($user->id == \app\controllers\UsersController::get()->getUser()->id))
{
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="alert-heading">Предупреждение</h4>
        <p>Если Вы отредактируете этого пользователя, то Вам придётся ещё раз войти под ним после редактирования</p>
    </div>
    <?php
}

$mod = $user && is_object($user);
?>
<form method="post">
    <?= $mod ? "<div class='row'>
        <div class='col-md-5'><label for='id'>ID: </label></div>
        <div class='col-md-7'><input id='id' type='text' name='id' value='" . $user->id . "' readonly></div>
    </div>" : "" ?>
    <div class="row">
        <div class="col-md-5">
            <label for="name">ФИО:</label>
        </div>
        <div class="col-md-7">
            <input id="name" type="text" name="name" value="<?= $mod ? $user->name : "" ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <label for="login">Логин: </label>
        </div>
        <div class="col-md-7">
            <input id="login" type="text" name="login" value="<?= $mod ? $user->login : "" ?>" required>
        </div>
    </div>
    <?php
    if ($mod)
    {
        ?>
        <div class="row">
            <div class="col-md-5">
                <label for="password1">Введите старый пароль: </label>
            </div>
            <div class="col-md-7">
                <input id="password1" type="password" name="check_password" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <label for="password2">Новый пароль <small>(если не хотите менять, оставьте поле пустым)</small>: </label>
            </div>
            <div class="col-md-7">
                <input id="password2" type="password" name="new_password">
            </div>
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="row">
            <div class="col-md-5">
                <label for="password">Введите пароль: </label>
            </div>
            <div class="col-md-7">
                <input id="password" type="password" name="password" required>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="row">
        <div class="col-md-5">
            <label>
                Уровень доступа<?= $it_is_me
                    ? " <small>(Вы не можете изменить <u>свой</u> уровень доступа)</small>"
                    : "" ?>:
            </label>
        </div>
        <div class="col-md-7">
            <select name="role"<?= $it_is_me ? " disabled" : "" ?>>
                <option value="admin"<?= $mod && $user->role === "admin" ? " selected" :  "" ?>>
                    Администратор
                </option>
                <option value="moderator"<?= $mod && $user->role === "moderator" ? " selected" :  "" ?>>
                    Модератор
                </option>
                <option value="commentator"<?= $mod && $user->role === "commentator" ? " selected"  : "" ?>>
                    Тот, кто может писать комментарии
                </option>
            </select>
        </div>
    </div>

    <input type="hidden" name="token" value="<?= $mod ? $user->token : "" ?>">

    <button type="submit">Сохранить</button>
</form>
