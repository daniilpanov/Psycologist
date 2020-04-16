<?php


namespace app\models\crud;


class Review extends CRUDModel
{
    public static $limit = null, $auto_limit = true;


    public $title, $content, $rating,
        $user_id, $user, $created,
        $modified, $uploads, $page_id;

    public $page_name, $user_name;

    public function __construct($id = null)
    {
        if ($id)
            $this->getOne($id);
    }

    public static function getForAdmin($id = null, $cols = "*", $group = 'default', $where = null)
    {
        if (trim($cols) !== "*")
        {
            if (!is_array($cols))
                $cols = explode(", ", $cols);

            foreach ($cols as $index => $col)
                $cols[$index] = "reviews.$col";

            $cols = implode(", ", $cols);
        }
        else
            $cols = "reviews.*";

        if ($id)
        {
            $review = new self();
            $data = db()->query(
                "SELECT $cols, pages.name AS page_name, users.name AS user_name FROM reviews, pages, users
 WHERE pages.id = page_id AND reviews.id = :id AND users.id = user_id",
                ['id' => $id]
            )->fetch();

            if ($data && is_array($data))
            {
                $review->setData($data);
                return $review;
            }
            else
            {
                $data = db()->query(
                    "SELECT $cols, users.name AS user_name FROM reviews, users
 WHERE reviews.id = :id AND users.id = user_id",
                    ['id' => $id]
                )->fetch();

                if (!$data || !is_array($data))
                    return null;

                $review->setData($data);
                return $review;
            }
        }
        else
        {
            $where_str = "";
            $params = [];

            if ($where && is_array($where))
            {
                foreach ($where as $col => $val)
                {
                    $params[$col] = $val;
                    $where_str = "$col=:$col AND ";
                }
            }

            $instances = [];
            $data = db()->query(
                "SELECT $cols, pages.name AS page_name, users.name AS user_name FROM reviews, pages, users
WHERE $where_str pages.id = page_id AND users.id = user_id", $params
            )->fetchAll();

            if (!$data || !is_array($data))
            {
                $data = db()->query(
                    "SELECT $cols, users.name AS user_name FROM reviews, users
WHERE $where_str users.id = user_id", $params
                )->fetchAll();
                if (!$data || !is_array($data))
                    return null;
            }

            foreach ($data as $datum)
            {
                $object = $instances[] = new self();
                $object->setData($datum);
            }

            return $instances;
        }
    }

    public function getDate()
    {
        return date("d M Y", $this->created);
    }

    public function getTable()
    {
        return "reviews";
    }
}