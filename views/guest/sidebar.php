<?php

use app\App;
use app\UnderGround as UG;

// Функция вывода страничек для определённого меню
function print_pages_at_menu($menu)
{
    if ($pages = UG::searchModel(
        "menu.Page", ['menu_id' => $menu->id, 'visible_in' => ["s", "ts"], 'parent_id' => '0']
    ))
    {
        foreach ($pages as $page)
        {
            echo "<li><a href='" . ROOT . "page/id" . $page->id . "'>" . $page->name . "</a></li>";
            print_pages_at_page($page);
        }
    }
}

// Функция вывода страничек для определённой страницы
function print_pages_at_page($page)
{
    if ($pages = UG::searchModel("menu.Page", ['parent_id' => $page->id, 'visible_in' => ["s", "ts"]]))
    {
        echo "<ul class='pages-list'>";
        foreach ($pages as $page)
        {
            echo "<li><a href='" . ROOT . "page/id" . $page->id . "'>" . $page->name . "</a></li>";
            print_pages_at_page($page);
        }
        echo "</ul>";
    }
}


//
if (App::$display_children == '1')
{
    $children = UG::searchModel("menu.Page", ['parent_id' => App::$id]);

    if ($children)
    {
        echo "<h4>Оглавление:</h4><ul>";

        foreach ($children as $child)
        {
            echo "<li><a href='" . ROOT . "page/id" . $child->id . "'>" . $child->name . "</a></li>";
            if ($child->display_children)
                print_pages_at_page($child);
        }

        echo "</ul>";
    }
}


$menus = UG::searchModel("menu.Menu");

if ($menus)
{
    foreach ($menus as $menu)
    {
        echo "<h4>" . $menu->name . "</h4>";
        echo "<ul class='menu-list'>";
        print_pages_at_menu($menu);
        echo "</ul>";
    }
}