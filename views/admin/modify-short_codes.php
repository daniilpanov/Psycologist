<?php

use app\models\crud\Menu;

/** @var $short_code \app\models\crud\short_codes\ShortCodeModelBase|null */

?>

<form method="post">
    <?= $short_code
        ? "<div class='row'><div class='col-md-4'>ID</div>
            <div class='col-md-7'><input type='text' name='id' value='{$short_code->id}' readonly></div></div>"
        : "" ?>

    <div class="row">
        <div class="col-md-4">
            <label for="code">ShortCode</label>
        </div>
        <div class="col-md-7">
            <div class="input-group">
                <div class="input-group-prepend">
                    [
                </div>
                <input id="code" type="text" name="code" required
                    <?= $short_code ? " value='{$short_code->code}'" : "" ?>>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            Тип шорткода
        </div>
        <div class="col-md-7">
            <select name="type">
                <option value="c"<?= $short_code && $short_code->type == "c" ? " selected" : ""?>>C</option>
                <option value="d"<?= $short_code && $short_code->type == "d" ? " selected" : ""?>>D</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="comment">Комментарий</label>
        </div>
        <div class="col-md-7">
            <textarea name="comment" id="comment"><?= $short_code ? $short_code->comment : "" ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="content-base">PHP-код для замены (return)</label>
        </div>
        <div class="col-md-12">
            <textarea type="text" id="content-base" name="replacement"><?= $short_code ? $short_code->replacement : "" ?></textarea>
        </div>
    </div>

    <button type="submit" id="save">Сохранить</button>
</form>