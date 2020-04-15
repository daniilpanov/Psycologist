<?php


namespace app\models\crud;


use app\UnderGround;

abstract class CRUDModel
{
    public $id;

    public function getOne($id)
    {
        $this->setData(db()->query("SELECT * FROM " . $this->getTable() . " WHERE id=:id", ['id' => $id])->fetch());
    }

    public function delete()
    {
        if (!$this->id)
            return false;

        if (!$this->shiftPosition("-"))
            (new static($this->id))->shiftPosition("-");

        if (!db()->query("DELETE FROM " . $this->getTable() . " WHERE id=:id", ['id' => $this->id]))
            return false;

        return true;
    }

    public function save($timestamp = true)
    {
        //
        if ($timestamp)
        {
            if ($this->id)
                $this->modified = time();
            else
                $this->created = time();
        }
        //
        $params = get_object_vars($this);
        $keys = [];
        //
        foreach ($params as $col => $value)
        {
            if ($value === null)
                unset($params[$col]);
            else
                $keys[] = $col;
        }
        //
        $this->id = (isset($params['id']) ? $params['id'] : null);
        //
        $this->shiftPosition();

        if ($this->id)
        {
            //
            (new static($this->id))->shiftPosition("-");
            //
            $sql = "UPDATE " . $this->getTable() . " SET "
                . implode_assoc("=:", ", ", array_combine($keys, $keys))
                . " WHERE id=:id";
        }
        else
        {
            //
            $sql = "INSERT INTO " . $this->getTable() . "("
                . implode(", ", $keys)
                . ") VALUE( "
                . ":" . implode(", :", $keys) . ")";
            //
            unset($params['id']);
        }

        return db()->query($sql, $params);
    }

    public static function getAll($params, $group, $arguments = [], $cols = "*", $order_by = null, $how = "ASC")
    {
        if (is_array($cols))
            $cols = implode(", ", $cols);

        $model = new static(...$arguments);
        $models = [];
        $table = $model->getTable();
        $keys = array_combine(array_keys($params), array_keys($params));

        $data = db()->query(
            "SELECT $cols FROM $table"
            . ($params ? " WHERE "
                . implode_assoc("=:", " AND ", $keys)
                : "")
            . ($order_by ? " ORDER BY $order_by $how" : "")
            . (isset(static::$limit) && static::$limit
                && isset(static::$auto_limit) && static::$auto_limit === true
                ? " LIMIT " . (is_array(static::$limit)
                    ? static::$limit[1] . ", " . static::$limit[0]
                    : static::$limit)
                : ""),
            $params
        )->fetchAll();

        if (!$data)
            return null;
        if (!UnderGround::getGroup($group))
            UnderGround::addGroup(new UnderGround\ModelGroups($group));

        foreach ($data as $datum)
        {
            $a_model = $models[$datum['id']] = clone $model;

            foreach ($datum as $col => $value)
                $a_model->$col = $value;

            UnderGround::getGroup($group)->addModel($a_model);
        }

        return $models;
    }

    public function shiftPosition($op = "+")
    {
        if (!isset($this->position))
            return null;

        return db()->query(
            "UPDATE " . $this->getTable() . " SET position=position $op 1 WHERE position >= {$this->position}"
        );
    }

    public function setData($data)
    {
        if (!is_array($data))
            return;

        foreach ($data as $col => $datum)
            $this->$col = $datum;
    }

    abstract public function getTable();
}