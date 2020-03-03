<?php


namespace App\Libs;


class Printer
{
    public static function pr($mixed_data = array())
    {
        print "<pre style='color: green;'>";
        print_r($mixed_data);
        print "</pre>";
    }
}
