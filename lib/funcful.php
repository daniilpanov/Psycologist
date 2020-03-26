<?php

function load_class($namespace)
{
    $path = str_replace("\\", DIRECTORY_SEPARATOR, $namespace) . ".php";
    if (is_file($path))
        require_once $path;
}

function implode_assoc($glue1, $glue2, $assoc)
{
    $imp = "";

    foreach ($assoc as $index => $item)
        $imp .= "$index$glue1$item$glue2";

    return substr($imp, 0, -mb_strlen($glue2));
}

function password($password)
{
    return md5(
        md5("sldkfsfk<><KszjAyuko1038`")
        . md5($password)
        . md5("djhsdfjhoak-w=q-w=qemf vc")
    );
}

function fullUrl()
{
    return (@$_SERVER['HTTPS'] ? "https" : "http") . "://"
        . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function getUrl()
{
    return parse_url(fullUrl());
}

function array_spec_diff($arr1, $arr2)
{
    foreach ($arr2 as $key => $value)
    {
        foreach ($arr1 as $index => $item)
        {
            if ($key == $index)
            {
                if (is_array($item))
                {
                    $found = false;

                    foreach ($item as $variants)
                    {
                        if ($value == $variants)
                        {
                            $found = true;
                            break;
                        }
                    }

                    if ($found)
                        unset($arr1[$key]);
                }
                else
                {
                    if ($item == $value)
                        unset($arr1[$key]);
                }
            }
        }
    }

    return $arr1;
}