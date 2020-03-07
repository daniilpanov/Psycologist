<?php


namespace app\controllers;


use app\models\Request;
use app\models\Request as R;
use app\UnderGround;

class RoutingController extends Controller
{
    public function route()
    {
        $url = getUrl()['path'];
        if ($root_path = UnderGround::searchModel("constants.", ['name' => "root-path", 'key' => 'path'], true))
            $url = str_replace($root_path->value, "", $url);

        if ($_POST)
        {
            foreach ($this->getRequests(R::POST) as $request)
            {
                if (!$request->check([
                        'url' => $url,
                        'req' => $_POST
                    ]) === false)
                    break;
            }
        }

        if ($_GET)
        {
            foreach ($this->getRequests(R::GET) as $request)
            {
                if (!$request->check($_GET) === false)
                    break;
            }
        }

        foreach ($this->getRequests(R::URL) as $request)
        {
            if (!$request->check($url) === false)
                break;
        }
    }

    /**
     * @param $type string
     * @return array|Request[]|null
     */
    private function getRequests($type)
    {
        return UnderGround::searchModel(
            "routing.",
            ['type' => $type], false
        );
    }
}