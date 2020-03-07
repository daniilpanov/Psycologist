<?php


namespace app\models;


class ViewDisplay extends Model
{
    public $view_name, $data;

    public function __construct($view_name, $data = [])
    {
        $this->view_name = $view_name;
        $this->data = $data;
    }

    public function render()
    {
        extract($this->data);
        include "views/" . $this->view_name . ".php";
    }
}