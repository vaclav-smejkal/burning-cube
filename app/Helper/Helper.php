<?php

namespace App\Helper;

class Helper
{
    public static function instance()
    {
        return new Helper();
    }

    public function friendly_url($text)
    {
        $url = $text;
        $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
        $url = trim($url, "-");
        $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
        $url = strtolower($url);
        $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
        return $url;
    }
}
