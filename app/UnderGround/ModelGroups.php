<?php


namespace app\UnderGround;


use app\models\Model;

class ModelGroups extends Model
{
    public $name;
    public $strict;

    public $models = [], $groups = [];

    public function __construct($name, $strict = null)
    {
        $this->name = $name;
        $this->strict = $strict;
    }

    public function addModel($model, $id = null, $group = null)
    {
        if ($this->strict)
        {
            $clazz = explode("\\", get_class($model));
            $clazz = end($clazz);

            if ($this->strict != $clazz)
                return false;
        }

        $group = $this->getGroup($group);

        if ($id === null)
            $id = count($this->models);
        elseif (is_array($id))
            $id = $model->id;

        return $group->models[$id] = $model;
    }

    public function addGroup($group)
    {
        return $this->groups[$group->name] = $group;
    }

    public function getModel($id)
    {
        return isset($this->models[$id]) ? $this->models[$id] : null;
    }

    public function searchModel($name = null, $params = [], $only_one = false)
    {
        if ($this->strict)
        {
            if (!$name || (is_array($name) && !$name[0]))
                $name = $this->strict;
            elseif(implode("\\", $name) != $this->strict)
                return false;
        }

        $needle_group = (is_array($name) && count($name) > 1)
            ? $this->getGroup($name)
            : $this;

        $found_models = [];

        foreach ($needle_group->models as $id => $model)
        {
            $clazz = explode("\\", get_class($model));
            $clazz = end($clazz);
            if ($clazz == $name && count(array_diff_assoc($params, get_object_vars($model))) == 0)
            {
                if ($only_one)
                    return $model;
                $found_models[$id] = $model;
            }
        }

        return $found_models;
    }

    /**
     * @param $name array|null
     * @return ModelGroups|null
     */
    public function getGroup($name = null)
    {
        if (!$name)
            return $this;

        $needle_group = is_array($name) ? array_shift($name) : $name;

        return isset($this->groups[$needle_group]) ? $this->groups[$needle_group]->getGroup($name) : null;
    }
}