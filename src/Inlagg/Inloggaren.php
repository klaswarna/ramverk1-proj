<?php

namespace KW\Inlagg;


use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;



class Inloggaren implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    public function __construct($di)
    {
        $this->di = $di;
    }

    public function loggain($anvandarnamn, $losenord)
    {

        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT anvandarid, anvandarnamn, email FROM anvandare WHERE anvandarnamn=? AND losenord=?;";
        $res = $db->executeFetch($sql, [$anvandarnamn, MD5($losenord)]);

        if (is_null($res)) {
            return FALSE;
        }
        $this->di->get("session")->set("anvandarid", $res->anvandarid);
        $this->di->get("session")->set("anvandarnamn", $res->anvandarnamn);
        $this->di->get("session")->set("email", $res->email);
        return TRUE;
    }


    public function anvandarnamnUpptaget($anvandarnamn)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT * FROM anvandare WHERE anvandarnamn=?;";
        $res = $db->executeFetch($sql, [$anvandarnamn]);
        if ($res == null) {
            return FALSE;
        }
        return TRUE;
    }



    public function skapaNyanvandare($anvandarnamn, $losenord, $email)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "INSERT INTO `anvandare` (`anvandarnamn`, `losenord`, `email`, `fraga`, `svar`, `kommentar`, `rfraga`, `rsvar`, `rkommentar`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $db->execute($sql, [$anvandarnamn, MD5($losenord), $email, 0, 0 ,0 ,0 ,0 ,0]);
        return;
    }

    public function uppdateraInlogg($typ, $varde)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = 'UPDATE anvandare SET ' . $typ . ' = "'  . $varde . '" WHERE anvandarid = ?;';
        $db->execute($sql, [$this->di->session->get("anvandarid")]);
        return;
    }



//$this->di->get("response")->redirect("book")->send();


//$this->di->get("response")->redirectSelf()->send();




}
