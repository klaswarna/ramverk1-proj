<?php

namespace KW\Inlagg;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class Fragehamtaren implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function __construct($di)
    {
        $this->di = $di;
    }


    public function hamtaSenasteInlagg()
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT * FROM inlagg JOIN anvandare2 ON anvandare2.anvandarid=inlagg.userid WHERE type='fraga' ORDER BY published DESC LIMIT 3;";
        $res = $db->executeFetchAll($sql);

        return $res;
    }

    public function allaInlagg($sort)
    {
        $db = $this->di->get("db");
        $db->connect();
        if ($sort == "published") {
            $sql = "SELECT * FROM inlagg JOIN anvandare2 ON anvandare2.anvandarid=inlagg.userid WHERE type='fraga' ORDER BY published ASC;";
        } else {
            $sql = "SELECT * FROM inlagg JOIN anvandare2 ON anvandare2.anvandarid=inlagg.userid WHERE type='fraga' ORDER BY rankning DESC;";
        }

        $res = $db->executeFetchAll($sql);

        return $res;
    }

    //hämtar taggar knutna till id på viss fråga
    public function hamtaTaggar($id)
    {
        $db = $this->di->get("db");
        $sql = "SELECT tagg FROM (SELECT taggid, taggar.tagg, inlagg FROM taggar JOIN inlaggtagg ON inlaggtagg.tagg = taggar.taggid) AS a WHERE inlagg = ?;";
        $tags = $db->executeFetchAll($sql, [$id]);
        return $tags;
    }

    public function allaTaggar()
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT * FROM taggar;";
        $alltags = $db->executeFetchAll($sql);
        return $alltags;
    }

    public function fragorMedTaggen($tagg, $sort)
    {

        $db = $this->di->get("db");
        $db->connect();
        if ($sort == "published") {
            $sql = "SELECT * FROM ((inlaggtagg JOIN taggar ON inlaggtagg.tagg = taggar.taggid) JOIN inlagg ON inlagg.id = inlaggtagg.inlagg) JOIN anvandare2 ON inlagg.userid = anvandare2.anvandarid WHERE taggar.tagg=? ORDER BY published ASC;";
        } else {
            $sql = "SELECT * FROM ((inlaggtagg JOIN taggar ON inlaggtagg.tagg = taggar.taggid) JOIN inlagg ON inlagg.id = inlaggtagg.inlagg) JOIN anvandare2 ON inlagg.userid = anvandare2.anvandarid WHERE taggar.tagg=? ORDER BY rankning DESC;";
        }
        $res = $db->executeFetchAll($sql, [$tagg]);

        return $res;
    }

    public function raknaSvar($id)
    {

        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT COUNT(tillhor) AS nr  FROM inlagg WHERE tillhor=?";
        $res = $db->executeFetch($sql, [$id]);

        return $res;
    }

    public function popularasteTaggar()
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT taggar.tagg, COUNT(*) AS antal FROM inlaggtagg JOIN taggar ON taggar.taggid = inlaggtagg.tagg GROUP BY taggar.tagg ORDER BY antal DESC LIMIT 5;";
        $res = $db->executeFetchAll($sql);
        return $res;
    }

    public function aktivasteAnvandare()
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT fraga + svar + kommentar + rsvar + rfraga + rkommentar AS aktivitet, anvandarid, anvandarnamn, email, datum FROM anvandare2 ORDER BY aktivitet DESC LIMIT 3;";
        $res = $db->executeFetchAll($sql);
        return $res;
    }
}
