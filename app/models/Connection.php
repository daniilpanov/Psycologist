<?php


namespace app\models;


class Connection extends Model
{
    public $pdo, $connected = false;

    public function __construct($host, $dbname, $user, $password = null, $charset = "utf8", $options = [
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION
    ])
    {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        if ($this->pdo = new \PDO($dsn, $user, $password, $options))
        {
            $this->connected = true;
            if ($this->safetyQuery("SET NAMES :ch", ['ch' => $charset]))
                return true;
            $this->connected = false;
        }

        return false;
    }

    public function query($sql)
    {
        return ($this->connected) ? $this->pdo->query($sql) : false;
    }

    public function safetyQuery($sql, $params)
    {
        if (!$this->connected)
            return false;

        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);

        return $sth;
    }
}