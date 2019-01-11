<?php

namespace KW\Inlagg;

/**
 * Slygifies titles
 *
 */
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;



class Hamtaren implements ContainerInjectableInterface
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
    public function hamtaEnFraga($slug)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT * FROM inlagg JOIN anvandare ON anvandare.anvandarid=inlagg.userid WHERE slug=?;";
        $res = $db->executeFetch($sql, [$slug]);

        return $res;
    }

    public function hamtaKommentarer($tillhor, $sortko)
    {
        $db = $this->di->get("db");
        $db->connect();
        if ($sortko == "rankning") {
            $sql = "SELECT * FROM inlagg JOIN anvandare ON anvandare.anvandarid=inlagg.userid WHERE tillhor=? AND type='kommentar' ORDER BY rankning DESC;";
        } else {
            $sql = "SELECT * FROM inlagg JOIN anvandare ON anvandare.anvandarid=inlagg.userid WHERE tillhor=? AND type='kommentar' ORDER BY published ASC;";
        }
        $res = $db->executeFetchAll($sql, [$tillhor]);

        return $res;
    }


    //sortering är rankning eller published
    public function hamtaSvar($tillhor, $sortsv)
    {
        $db = $this->di->get("db");
        $db->connect();
        if ($sortsv == "rankning") {

            $sql = "SELECT * FROM inlagg JOIN anvandare ON anvandare.anvandarid=inlagg.userid WHERE tillhor=? AND type='svar' ORDER BY rankning DESC;";
        } else {
            $sql = "SELECT * FROM inlagg JOIN anvandare ON anvandare.anvandarid=inlagg.userid WHERE tillhor=? AND type='svar' ORDER BY published ASC;";
        }

        $res = $db->executeFetchAll($sql, [$tillhor]);

        return $res;
    }

    public function hamtaTaggar($inlaggid)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT * FROM inlaggtagg JOIN taggar ON inlaggtagg.tagg=taggar.taggid WHERE inlagg=?;";
        $res = $db->executeFetchAll($sql, [$inlaggid]);

        return $res;
    }

    public function nastaAutoInc($tabellnamn)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name=?;";
        $res = $db->executeFetch($sql, [$tabellnamn]);

        return $res;
    }

    public function befintligaSluggar()
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT slug FROM inlagg;";
        $sluggar = $db->executeFetchAll($sql);

        $sluggarna = [];
        foreach ($sluggar as $value) {
            array_push($sluggarna, $value->slug);
        };
        return $sluggarna;
    }

    public function allaAnvandare()
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT * FROM anvandare;";
        $res = $db->executeFetchAll($sql);

        return $res;
    }

    public function enAnvandare($id)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT * FROM anvandare WHERE anvandarid=?;";
        $res = $db->executeFetch($sql,[$id]);

        return $res;
    }

    public function max($tal)
    {
        if ($tal <= 80) {
            return $tal;
        }
        return 80;
    }

    public function anvandarensFragor($userid)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT * FROM inlagg WHERE userid=? AND type='fraga';";
        $res = $db->executeFetchAll($sql,[$userid]);
        return $res;
    }

    public function anvandarensSvar($userid)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT * FROM inlagg WHERE userid=? AND type='svar';";
        $res = $db->executeFetchAll($sql,[$userid]);
        return $res;
    }

    public function inlaggetHarSluggen($id)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT slug, title FROM inlagg WHERE id=?;";
        $res = $db->executeFetch($sql,[$id]);
        return $res;
    }

}
