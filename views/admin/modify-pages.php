<?php

use app\models\crud\Page;

/** @var $page Page|null */
/** @var $pages Page[] */
/** @var $menus \app\models\crud\Menu[] */

$last_pos = end($pages);
$last_pos = (!is_object($page) || (is_object($page) && $last_pos->id != $page->id))
    ? $last_pos->position + 1 : $last_pos->position;

?>

<form method="post">
    <?= $page
        ? "<div class='row'><div class='col-md-3'>ID</div>
            <div class='col-md-7'><input type='text' name='id' value='{$page->id}' readonly></div></div>"
        : "" ?>

    <div class="row">
        <div class="col-md-3">
            <label for="name">Название страницы</label>
        </div>
        <div class="col-md-7">
            <input id="name" type="text" name="name" required
                <?= $page ? " value='{$page->name}'" : "" ?>>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="name">Заголовок страницы</label>
        </div>
        <div class="col-md-7">
            <input id="name" type="text" name="title"
                <?= $page ? " value='{$page->title}'" : "" ?>>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            Описание (для SEO)
        </div>
        <div class="col-md-7">
            <textarea name="description"><?= $page ? $page->description : "" ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            Ключевые слова (для SEO)
        </div>
        <div class="col-md-7">
            <input type="text" name="keywords" value="<?= $page ? $page->keywords : "" ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            Размещение страницы
        </div>
        <div class="col-md-7">
            <select name="visible_in">
                <option value="s"<?= is_object($page) && $page->visible_in == "s" ? " selected" : "" ?>>
                    В боковом меню</option>
                <option value="ts"<?= is_object($page) && $page->visible_in == "ts" ? " selected" : "" ?>>
                    Во всех меню меню</option>
                <option value="t"<?= is_object($page) && $page->visible_in == "t" ? " selected" : "" ?>>
                    В верхнем меню</option>
                <option value="0"<?= is_object($page) && $page->visible_in == "0" ? " selected" : "" ?>>
                    Invisible (не размещать)</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            Выберите позицию страницы
        </div>
        <div class="col-md-7">
            <select name="position">
                <?php
                foreach ($pages as $item)
                {
                    if (is_object($page) && $item->id == $page->id)
                        continue;

                    echo "<option value='" . $item->position . "'";
                    if (is_object($page) && $item->position == $page->position + 1)
                        echo " selected";
                    echo ">Перед '" . $item->name . "'</option>";
                }
                ?>
                <option value="<?= $last_pos ?>"
                    <?= (!is_object($page) || (is_object($page) && $page->position === $last_pos) ? " selected" : "") ?>
                >
                    В конец списка
                </option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            Родительская страница
        </div>
        <div class="col-md-7">
            <select name="parent_id">
                <option value="0"<?= is_object($page) && $page->parent_id == "0" ? " selected" : "" ?>>
                    Нет
                </option>
                <?php
                foreach ($pages as $item)
                {
                    if ($page->id == $item->id)
                        continue;

                    echo "<option value='" . $item->id . "'"
                        . (is_object($page) && $page->parent_id == $item->id ? " selected" : "") . ">"
                        . $item->name . "</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            Родительский пункт меню
        </div>
        <div class="col-md-7">
            <select name="menu_id">
                <option value="0"<?= is_object($page) && $page->menu_id == "0" ? " selected" : "" ?>>
                    Нет
                </option>
                <?php
                foreach ($menus as $item)
                {
                    echo "<option value='" . $item->id . "'"
                        . (is_object($page) && $page->menu_id == $item->id ? " selected" : "") . ">"
                        . $item->name . "</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            Контент:
        </div>
        <div class="col-md-12">
            <label id="content-base-label">
                CodesVisible - on
                <textarea name="content" id="content-base"><?= $page ? $page->content : "" ?></textarea>
            </label>
        </div>
        <div class="col-md-12">
            <span>
                CodesVisible - off
                <div id="content-view" contenteditable="true"><?= $page ? $page->prepared_content : "" ?></div>
            </span>
        </div>
    </div>

    <button type="submit" id="save">Сохранить</button>
</form>