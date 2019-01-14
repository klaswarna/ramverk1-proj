<?php

namespace KW\Inlagg;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class Taggar implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function __construct($di)
    {
        $this->di = $di;
    }

    /**
    * Create a part of a table containing one type, one link, ordered by date or rank
    *
    * @param string $str the string to format as slug.
    *
    * @return str the formatted slug.
    */

    public function hamtaTaggar($inlaggid)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT * FROM inlaggtagg JOIN taggar ON inlaggtagg.tagg=taggar.taggid WHERE inlagg=?;";
        $res = $db->executeFetchAll($sql, [$inlaggid]);

        return $res;
    }
}
