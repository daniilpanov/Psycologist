<?php


namespace app\models\crud\short_codes;

class ShortCodeWithInnerModel extends ShortCodeModelBase
{
    public function replaceCode($content)
    {
        // Ищем short-codes
        if (preg_match_all(
            "/\[" . $this->code . "( ([^\]]+))?\](.*?)\[\/" . $this->code . "\]/s",
            $content, $codes,
            PREG_SET_ORDER
        ))
        {
            // перебираем то, что нашли
            foreach ($codes as $code)
            {
                // если есть аргументы - получаем их
                if (isset($code[2]) && $code[2])
                {
                    preg_match_all("/([^=^ ]+)=(\"([^'^\"]+?)\"|'(.+?)')/",
                        $code[2], $arguments, PREG_SET_ORDER);

                    // и приводим к ассоциативному массиву
                    foreach ($arguments as $key => $arg)
                    {
                        unset($arguments[$key]);
                        $value = (isset($arg[3]) && $arg[3]) ? $arg[3] : $arg[4];

                        $arguments[$arg[1]] = $value;
                    }
                }

                $arguments = isset($arguments) ? $arguments : [];

                // если есть содержимое short-code - записываем его
                $code_content = (isset($code[3]) && $code[3]) ? $code[3] : null;

                // Заменяем short-codes на их значения в самом контенте
                $content = str_replace(
                    $code[0],
                    "<span class='short_code_replacement'>"
                        . $this->getReplacement(['args' => $arguments, 'content' => $code_content]) . "</span>",
                    $content
                );
            }
        }

        // и возвращаем готовый контент
        return $content;
    }

    public function getReplacement($params = null)
    {
        $init = eval('return (function ($args, $content)
        {
            ' . $this->replacement . '
        });');

        return $init($params['args'], $params['content']);
    }
}