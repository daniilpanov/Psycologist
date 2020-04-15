<?php

/** @var $constant \app\models\crud\Constant|null */

$mod = is_object($constant);
?>

<form method="post">
    <?php
    if ($mod)
    {
        ?>
        <div class="row">
            <div class="col-md-3">
                <label for="id">ID: </label>
            </div>
            <div class="col-md-7">
                <input id="id" type="text" name="id" value="<?= $constant->id ?>" readonly>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="row">
        <div class="col-md-3">
            <label for="name">Название</label>
        </div>
        <div class="col-md-7">
            <input id="name" type="text" name="name" value="<?= $mod ? $constant->name : "" ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="key">Ключ (тип)</label>
        </div>
        <div class="col-md-7">
            <input id="key" type="text" name="key" value="<?= $mod ? $constant->key : "" ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="value">Значение </label>
        </div>
        <div class="col-md-7">
            <input id="value" type="text" name="value" value="<?= $mod ? $constant->value : "" ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="translate">Описание</label>
        </div>
        <div class="col-md-7">
            <textarea id="translate" name="translate"><?= $mod ? $constant->translate : "" ?></textarea>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        Сохранить
    </button>
</form>