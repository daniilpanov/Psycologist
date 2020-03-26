<?php

use app\models\crud\Menu;

/** @var $menu Menu|null */
/** @var $menus \app\models\crud\Menu[] */

$last_pos = end($menus);
$last_pos = (!is_object($menu) || (is_object($menu) && $last_pos->id != $menu->id))
    ? $last_pos->position + 1 : $last_pos->position;

?>

<form method="post">
    <?= $menu
        ? "<div class='row'><div class='col-md-4'>ID</div>
            <div class='col-md-7'><input type='text' name='id' value='{$menu->id}' readonly></div></div>"
        : "" ?>

    <div class="row">
        <div class="col-md-4">
            <label for="name">Название меню</label>
        </div>
        <div class="col-md-7">
            <input id="name" type="text" name="name" required
                <?= $menu ? " value='{$menu->name}'" : "" ?>>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            Выберите позицию меню
        </div>
        <div class="col-md-7">
            <select name="position">
                <?php
                foreach ($menus as $item)
                {
                    if (is_object($menu) && $item->id == $menu->id)
                        continue;

                    echo "<option value='" . $item->position . "'";
                    if (is_object($menu) && $item->position == $menu->position + 1)
                        echo " selected";
                    echo ">Перед '" . $item->name . "'</option>";
                }
                ?>
                <option value="<?= $last_pos ?>"
                    <?= (!is_object($menu) || (is_object($menu) && $menu->position === $last_pos) ? " selected" : "") ?>
                >
                    В конец списка
                </option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            Видимость (опубликовать сейчас?)
        </div>
        <div class="col-md-7">
            <select name="visible">
                <option value="1"<?= is_object($menu) && $menu->visible == "1" ? " selected" : "" ?>>
                    Visible (да)</option>
                <option value="0"<?= is_object($menu) && $menu->visible == "0" ? " selected" : "" ?>>
                    Invisible (нет)</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            Описание (для SEO)
        </div>
        <div class="col-md-7">
            <textarea name="description"><?= $menu ? $menu->description : "" ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            Ключевые слова (для SEO)
        </div>
        <div class="col-md-7">
            <input type="text" name="keywords" value="<?= $menu ? $menu->keywords : "" ?>">
        </div>
    </div>

    <button type="submit">Сохранить</button>
</form>