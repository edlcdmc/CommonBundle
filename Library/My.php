<?php

namespace Edlcdmc\Bundle\CommonBundle\Library;
/**
 * Created by JetBrains PhpStorm.
 * User: Limak
 * Date: 07.10.12
 * Time: 23:18
 * To change this template use File | Settings | File Templates.
 */
class My
{
    static public function createListOfTable($array)
    {
        $list = '  ';
        foreach($array as $value) {
            $list .= $value.', ';
        }
        return substr($list, 0, -2);
    }

    static public function createNoPolishText($text)
    {
//        $text = iconv("UTF-8", "ISO-8859-2//TRANSLIT", $text);
//        $text = ereg_replace(' +', ' ', $text);
        $text = str_replace("ł", "l", $text);
        $text = str_replace("ż", "z", $text);
        $text = str_replace("ź", "z", $text);
        $text = str_replace("ś", "s", $text);
        $text = str_replace("ń", "n", $text);
        $text = str_replace("ó", "o", $text);
        $text = str_replace("ę", "e", $text);
        $text = str_replace("ą", "a", $text);
        $text = str_replace("ć", "c", $text);
        $text = str_replace("Ł", "L", $text);
        $text = str_replace("Ż", "Z", $text);
        $text = str_replace("Ź", "Z", $text);
        $text = str_replace("Ś", "S", $text);
        $text = str_replace("Ń", "N", $text);
        $text = str_replace("Ó", "O", $text);
        $text = str_replace("Ę", "E", $text);
        $text = str_replace("Ą", "A", $text);
        $text = str_replace("Ć", "C", $text);
//        $text = iconv("ISO-8859-2","UTF-8", $text);
        return $text;
    }
}
