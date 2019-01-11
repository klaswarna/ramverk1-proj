<?php

namespace KW\Inlagg;

/**
 * Slygifies titles
 *
 */
class Slugify
{
    /**
    * Create a slug of a string, to be used as url.
    *
    * @param string $str the string to format as slug.
    *
    * @return str the formatted slug.
    */
    public function slugify($str)
    {
        $str = mb_strtolower(trim($str));
        $str = str_replace(array('å','ä','ö'), array('a','a','o'), $str);
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = trim(preg_replace('/-+/', '-', $str), '-');
        return $str;
    }
}
