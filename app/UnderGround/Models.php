<?php


namespace app\UnderGround;


class Models
{
    private static $instance;

    public static function inst()
    {
        if (!self::$instance)
            self::$instance = new self;

        return self::$instance;
    }


    public $groups;

    public function __construct()
    {
        $this->groups = ['default' => new ModelGroups('default')];
    }

    public function addGroup($group)
    {
        return $this->groups[$group->name] = $group;
    }

    public function searchModel($name, $params = [], $only_one = false)
    {
        $arr_name = explode(".", $name);

        if (($c = count($arr_name)) > 1)
        {
            $group = array_shift($arr_name);

            return isset($this->groups[$group])
                ? $this->groups[$group]
                    ->searchModel($arr_name, $params, $only_one)
                : false;
        }

        return $this->groups['default']->searchModel($name, $params, $only_one);
    }

    public function createModel($name, $params = [], $id = null, $strict_names = false)
    {
        $groups = explode(".", $name);
        $name = end($groups);
        $namespace = "app\\models\\$name";
        $c = count($groups) - 1;
        unset($groups[$c]);

        if ($c < 1)
        {
            $groups = null;
            $curr = 'default';
        }
        else
            $curr = array_shift($groups);

        if (!isset($this->groups[$curr]))
            $this->groups[$curr] = new ModelGroups($curr, ($strict_names ? $name : null));

        return $this->groups[$curr]
            ->addModel(new $namespace(...array_values($params)), $id, ($groups ? $groups : null));
    }

    public function createModelIfNotExists($name, $params = [])
    {
        if (!$model = $this->searchModel($name, $params, true))
            $model = $this->createModel($name, $params);

        return $model;
    }

    public function getGroup($name = 'default')
    {
        $groups = explode(".", $name);
        $curr = array_shift($groups);

        return isset($this->groups[$curr])
            ? $this->groups[$curr]->getGroup($groups)
            : null;
    }
}