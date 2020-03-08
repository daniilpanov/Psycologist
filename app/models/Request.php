<?php


namespace app\models;


use app\UnderGround;

class Request extends Model
{
    const URL = "u", GET = "g", POST = "p", PUT = "t", PATCH = "a", DELETE = "d";

    public $type, $request, $controller, $method;

    public function __construct($type, $request, $controller, $method)
    {
        $this->type = $type;
        $this->request = $request;
        $this->controller = $controller;
        $this->method = $method;
    }

    public function check($req)
    {
        $controller = UnderGround::getController($this->controller);
        $method = $this->method;
        switch ($this->type)
        {
            case self::URL:
                if (preg_match(
                    "/^" . str_replace("/", "\/", $this->request) . "$/",
                    $req, $params)
                )
                {
                    array_shift($params);
                    return ($method ? $controller->$method(...$params) : $controller(...$params));
                }
                break;

            case self::GET:
                if (isset($res[$this->request['key']]))
                {
                    if (preg_match(
                        "/^" . $this->request['value'] . "$/",
                        $req[$this->request['key']],
                        $params
                    ))
                    {
                        array_shift($params);
                        return ($method ? $controller->$method(...$params) : $controller(...$params));
                    }
                }
                break;

            case self::POST;
            case self::PUT;
            case self::PATCH;
            case self::DELETE:
                if (preg_match(
                    "/^" . str_replace("/", "\/", $this->request) . "$/",
                    $req['url'], $add_params)
                )
                {
                    array_shift($params);

                    return ($method ? $controller->$method($req['req'], $this->type, $add_params)
                        : $controller($req['req'], $this->type, $add_params)
                    );
                }
                break;
        }

        return null;
    }
}