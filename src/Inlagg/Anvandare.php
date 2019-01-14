<?php

namespace KW\Inlagg;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class Anvandare implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    public function __construct($di)
    {
        $this->di = $di;
    }

    public function allaAnvandare()
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT * FROM anvandare2;";
        $res = $db->executeFetchAll($sql);

        return $res;
    }

    public function enAnvandare($id)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT * FROM anvandare2 WHERE anvandarid=?;";
        $res = $db->executeFetch($sql, [$id]);

        return $res;
    }


    public function anvandarensFragor($userid)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT * FROM inlagg WHERE userid=? AND type='fraga';";
        $res = $db->executeFetchAll($sql, [$userid]);
        return $res;
    }

    public function anvandarensSvar($userid)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT * FROM inlagg WHERE userid=? AND type='svar';";
        $res = $db->executeFetchAll($sql, [$userid]);
        return $res;
    }
}
