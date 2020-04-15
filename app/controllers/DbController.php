<?php


namespace app\controllers;


use app\UnderGround;

class DbController extends Controller
{
    private $connection;

    public function __construct()
    {
        $this->connection = UnderGround::searchModel("Connection", [], true);
    }

    /**
     * @param $sql string
     * @param $params array|null
     * @return \PDOStatement|bool
     */
    public function query($sql, $params = null)
    {
        try
        {
            if (!$params)
                return $this->connection->query($sql);
            else
                return $this->connection->safetyQuery($sql, $params);
        }
        catch (\PDOException $ex)
        {
            var_dump($ex->getMessage());
            return false;
        }
    }
}