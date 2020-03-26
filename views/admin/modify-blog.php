<?php

use app\models\crud\BlogItem;

/** @var $blog_item BlogItem|null */
/** @var $blog BlogItem[] */

$last_pos = end($blog);
$last_pos = (!is_object($blog_item) || (is_object($blog_item) && $last_pos->id != $blog_item->id))
    ? $last_pos->position + 1 : $last_pos->position;

?>

<form method="post">
    <?= $blog_item
        ? "<div class='row'><div class='col-md-3'>ID</div>
            <div class='col-md-7'><input type='text' name='id' value='{$blog_item->id}' readonly></div></div>"
        : "" ?>

    <div class="row">
        <div class="col-md-3">
            <label for="name">Название страницы</label>
        </div>
        <div class="col-md-7">
            <input id="name" type="text" name="name" required
                <?= $blog_item ? " value='{$blog_item->name}'" : "" ?>>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            Описание
        </div>
        <div class="col-md-7">
            <textarea name="description"><?= $blog_item ? $blog_item->description : "" ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            Ключевые слова (для SEO)
        </div>
        <div class="col-md-7">
            <input type="text" name="keywords" value="<?= $blog_item ? $blog_item->keywords : "" ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            Опубликовать?
        </div>
        <div class="col-md-7">
            <select name="visible">
                <option value="1"<?= is_object($blog_item) && $blog_item->visible == "1" ? " selected" : "" ?>>
                    Да</option>
                <option value="0"<?= is_object($blog_item) && $blog_item->visible == "0" ? " selected" : "" ?>>
                    Нет</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            Выберите позицию новости
        </div>
        <div class="col-md-7">
            <select name="position">
                <?php
                foreach ($blog as $item)
                {
                    if (is_object($blog_item) && $item->id == $blog_item->id)
                        continue;

                    echo "<option value='" . $item->position . "'";
                    if (is_object($blog_item) && $item->position == $blog_item->position + 1)
                        echo " selected";
                    echo ">Перед '" . $item->name . "'</option>";
                }
                ?>
                <option value="<?= $last_pos ?>"
                    <?= (!is_object($blog_item) || (is_object($blog_item) && $blog_item->position === $last_pos) ? " selected" : "") ?>
                >
                    В конец списка
                </option>
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
                <textarea name="content" id="content-base"><?= $blog_item ? $blog_item->content : "" ?></textarea>
            </label>
        </div>
        <div class="col-md-12">
            <span>
                CodesVisible - off
                <div id="content-view" contenteditable="true"><?= $blog_item ? $blog_item->prepared_content : "" ?></div>
            </span>
        </div>
    </div>

    <button type="submit">Сохранить</button>
</form>