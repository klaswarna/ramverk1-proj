<?php

namespace KW\Inlagg;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class Posta implements ContainerInjectableInterface
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
    public function postaNyKommentar($data, $userid, $tillhor, $type)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "INSERT INTO inlagg (`data`, `userid`, `tillhor`, `type`, `rankning`) VALUES (?, ?, ?, ?, ?);";
        $db->execute($sql, [$data, $userid, $tillhor, $type, 0]);

        return;
    }

    public function postaSvar($data, $userid, $tillhor, $type)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "INSERT INTO inlagg (`data`, `userid`, `tillhor`, `type`, `rankning`) VALUES (?, ?, ?, ?, ?);";
        $db->execute($sql, [$data, $userid, $tillhor, $type, 0]);

        return;
    }

    public function nyaTaggar($nyataggar)
    {
        $db = $this->di->get("db");
        $db->connect();
        foreach ($nyataggar as $value) {
            $sql = "INSERT INTO taggar (`tagg`) VALUES (?);";
            $db->execute($sql, [$value]);
        }
    }

    public function postaFraga($title, $data, $slug, $userid)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "INSERT INTO inlagg (`title`, `data`, `type`, `slug`, `rankning`, `userid`) VALUES (?, ?, ?, ?, ?, ?);";
        $db->execute($sql, [$title, $data, "fraga", $slug, 0, $userid]);

        return;
    }

    public function kopplaFragaTaggar($id, $valdataggar)
    {
        $db = $this->di->get("db");
        $db->connect();
        foreach ($valdataggar as $value) {
            $sql = "INSERT INTO inlaggtagg (`inlagg`, `tagg`) VALUES (?, ?);";
            $db->execute($sql, [$id, $value]);
        }
        return;
    }
}
