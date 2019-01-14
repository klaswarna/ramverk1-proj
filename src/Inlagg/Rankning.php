<?php

namespace KW\Inlagg;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class Rankning implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function __construct($di)
    {
        $this->di = $di;
    }

    public function upp($id)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "UPDATE inlagg SET rankning = rankning + 1 WHERE id=?;";
        $db->execute($sql, [$id]);

        return;
    }

    public function ner($id)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "UPDATE inlagg SET rankning = rankning - 1 WHERE id=?;";
        $db->execute($sql, [$id]);

        return;
    }

    public function acceptera($id)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "UPDATE inlagg SET godkant = true WHERE id=?;";
        $db->execute($sql, [$id]);

        return;
    }

    public function uppdatera($id, $kategori, $varde)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "UPDATE anvandare2 SET " .$kategori. " = " .$kategori. " + " . $varde . " WHERE anvandarid = ?;";
        $db->execute($sql, [$id]);
        return;
    }

    public function vemsInlagg($id)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT * FROM inlagg WHERE id=?;";
        $res = $db->executeFetch($sql, [$id]);
        return $res;
    }
}
