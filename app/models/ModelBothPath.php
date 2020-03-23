<?php


namespace app\models;


use app\UnderGround;

abstract class ModelBothPath extends Model
{
    public $id;

    public function save()
    {
        $params = get_object_vars($this);
        unset($params['id']);
        $keys = array_keys($params);
        $params['id'] = $this->id;

        if ($this->id)
        {
            $sql = "UPDATE " . $this->getTable() . " SET "
                . implode_assoc("=:", ", ", array_combine($keys, $keys))
                . " WHERE id=:id";
        }
        else
        {
            echo $sql = "INSERT INTO " . $this->getTable() . "("
                . implode(", ", $keys)
                . ") VALUE( "
                . ":" . implode(", :", $keys) . ")";
        }
        unset($params['id']);
        var_dump($params);
        return db()->query($sql, $params);
    }

    public function setData($data)
    {
        if (!is_array($data))
            return;

        foreach ($data as $col => $datum)
        {
            $this->$col = $datum;
        }
    }

    public static function aLotOfModels($params, $group, $arguments = [], $cols = "*", $order_by = null, $how = "ASC")
    {
        if (is_array($cols))
            $cols = implode(", ", $cols);

        $model = new static(...$arguments);
        $models = [];
        $table = $model->getTable();
        $keys = array_combine(array_keys($params), array_keys($params));
        $data = db()->query(
            "SELECT $cols FROM $table"
            . ($params ? " WHERE " . implode_assoc("=:", " AND ", $keys) : "")
            . ($order_by ? " ORDER BY $order_by $how" : ""),
            $params
        )->fetchAll();

        if (!$data)
            return null;

        foreach ($data as $datum)
        {
            $a_model = $models[$datum['id']] = clone $model;

            foreach ($datum as $col => $value)
                $a_model->$col = $value;

            UnderGround::getGroup($group)->addModel($a_model);
        }

        return $models;
    }

    abstract public function getTable();
}