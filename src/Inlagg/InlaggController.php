<?php

namespace KW\Inlagg;


use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;



use KW\Inlagg\TextFilter;
use KW\Inlagg\Slugify;
use KW\Inlagg\Hamtaren;
use KW\Inlagg\Fragehamtaren;
use KW\Inlagg\Inloggaren; // hanterar in och ut logg samt ny användare


class InlaggController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $textFilter;
    private $slugify;


    public function __construct()
    {
        $this->textFilter = new TextFilter();
        $this->slugify = new Slugify();
    }


    // denna funktion skall förhoppningsvis returnera en fråga + ev kommentarer, därefter svar i sorterad ordning + ev kommentarer till dem
    public function enskiltinlaggActionGet($slug)
    {
        $sortsv = $this->di->get("request")->getGet("sortsv");
        $sortko = $this->di->get("request")->getGet("sortko");
        $sorteraren = new \KW\Inlagg\Sorteraren($this->di);
        $res = $sorteraren->sorteraFragorOchSvar($slug, $sortsv, $sortko);
        $hamtaren = new \KW\Inlagg\Hamtaren($this->di);
        $taggar = $hamtaren->hamtataggar($res[0]->id);

        $page = $this->di->get("page");
                $page->add("anax/v2/inlagg/enskiltinlagg", [
                    "res" => $res,
                    "taggar"=>$taggar
                    ]);
                return $page->render([
                    "title"=>"Fråga"
                    //"title"=>$res[0]->title
                ]);
    }


    public function loggainActionPost() {
        $inloggaren = new \KW\Inlagg\Inloggaren($this->di);
        $anvandarnamn = $this->di->get("request")->getPost("anvandarnamn");
        $losen = $this->di->get("request")->getPost("losen");
        $email = $this->di->get("request")->getPost("email");
        $loggain = $this->di->get("request")->getPost("loggain");

        //Att man vill logga in och inte skapa nytt
        if ($loggain != null) {

            //försök logga in
            $res = $inloggaren->loggain($anvandarnamn, $losen);

            //om felaktiga uppgifter matats in
            if (!$res) {
                return $this->di->get("response")->redirect("inlagg/felinlogg")->send(); //denna funkar inte
            } else {
                return $this->di->get("response")->redirect("minsida")->send();
            }
        }

        //ny användare  MD5

        //om användarnamnet upptaget
        if ($inloggaren->anvandarnamnUpptaget($anvandarnamn)) {
            return $this->di->get("response")->redirect("inlagg/finnsredan")->send();
        }

        if ($email=="" || $losen=="" || $anvandarnamn =="") {
            return $this->di->get("response")->redirect("inlagg/felaktigauppgifter")->send();
        }

        //skapa ny användare
        $inloggaren->skapaNyanvandare($anvandarnamn, $losen, $email);
        //logga in ny användare därefter
        $inloggaren->loggain($anvandarnamn, $losen);
        return $this->di->get("response")->redirect("minsida")->send();
    }


    public function felinloggActionGet()
    {
        $page = $this->di->get("page");
                $page->add("anax/v2/inlagg/felinlogg", [
                    ]);
                return $page->render([
                    "title"=>"Felinlogg"
                ]);
    }

    public function finnsredanActionGet()
    {
        $page = $this->di->get("page");
                $page->add("anax/v2/inlagg/finnsredan", [
                    ]);
                return $page->render([
                    "title"=>"Felinlogg"
                ]);
    }

    public function felaktigauppgifterActionGet()
    {
        $page = $this->di->get("page");
                $page->add("anax/v2/inlagg/felaktigauppgifter", [
                    ]);
                return $page->render([
                    "title"=>"Felaktiga uppgifter"
                ]);
    }

    public function loggautActionGet()
    {
        $this->di->session->destroy();
        return $this->di->get("response")->redirect("")->send();
    }

    public function postakommentarActionPost()
    {
        $rankning   = new \KW\Inlagg\Rankning($this->di);
        $posta      = new \KW\Inlagg\Posta($this->di);
        $data       = $this->di->get("request")->getPost("data");
        $userid     = $this->di->get("request")->getPost("userid");
        $tillhor    = $this->di->get("request")->getPost("tillhor");
        $type       = $this->di->get("request")->getPost("type");
        $retursida  = $this->di->get("request")->getPost("retursida");

        $posta->postaNyKommentar($data, $userid, $tillhor, $type);
        //$rankning->uppdatera($id, $kategori, $varde)
        $rankning->uppdatera($userid, "kommentar", 1);
        return $this->di->get("response")->redirect($retursida)->send();
    }

    public function postasvarActionPost()
    {
        $rankning = new \KW\Inlagg\Rankning($this->di);
        $posta = new \KW\Inlagg\Posta($this->di);
        $data       = $this->di->get("request")->getPost("data");
        $userid     = $this->di->get("request")->getPost("userid");
        $tillhor    = $this->di->get("request")->getPost("tillhor");
        $type       = $this->di->get("request")->getPost("type");
        $retursida  = $this->di->get("request")->getPost("retursida");

        $posta->postaSvar($data, $userid, $tillhor, $type);
        $rankning->uppdatera($userid, "svar", 1);
        return $this->di->get("response")->redirect($retursida)->send();
    }

    public function rankaUppInlaggActionPost($id)
    {
        $rankning = new \KW\Inlagg\Rankning($this->di);
        $retursida = $this->di->get("request")->getPost("retursida");

        $rankning->upp($id);
        $inlagg = $rankning->vemsInlagg($id);
        $rankning->uppdatera($inlagg->userid, "r" .$inlagg->type, 1);
        return $this->di->get("response")->redirect($retursida)->send();
    }

    public function rankaNerInlaggActionPost($id)
    {
        $rankning = new \KW\Inlagg\Rankning($this->di);
        $retursida = $this->di->get("request")->getPost("retursida");

        $rankning->ner($id);
        $inlagg = $rankning->vemsInlagg($id);
        $rankning->uppdatera($inlagg->userid, "r" . $inlagg->type, -1);

        return $this->di->get("response")->redirect($retursida)->send();
    }

    public function accepteraActionPost($id)
    {
        $rankning = new \KW\Inlagg\Rankning($this->di);
        $retursida = $this->di->get("request")->getPost("retursida");

        $rankning->acceptera($id);

        return $this->di->get("response")->redirect($retursida)->send();
    }

    public function postafragaActionPost()
    {
        $hamtaren   = new \KW\Inlagg\Hamtaren($this->di);
        $posta      = new \KW\Inlagg\Posta($this->di);
        $rankning = new \KW\Inlagg\Rankning($this->di);

        $retursida      = $this->di->get("request")->getPost("retursida");
        $valdataggar    = $this->di->get("request")->getPost("tag"); //$valdataggar är nu id på valda taggar tex. 3  4 5
        $nyataggar      = $this->di->get("request")->getPost("nyataggar");
        $title          = $this->di->get("request")->getPost("title");
        $data           = $this->di->get("request")->getPost("data");
        $taggar = [];

        $userid         = $this->di->session->get("anvandarid");
        //inserta i inlägg data, user, rank0, slugg o.s.v. Sen sök på slugen och FÅ id-numret.
        $nastaTaggId    = intval($hamtaren->nastaAutoInc("taggar")->auto_increment); //Det id som nästa inlägg får
        $nastaInlaggId  = intval($hamtaren->nastaAutoInc("inlagg")->auto_increment);//Det id på vilket nya taggar börjar läggas
        $sluggarna      = $hamtaren->befintligaSluggar();

        $rankning->uppdatera($userid, "fraga", 1);

        if ($valdataggar!=null) {
            foreach($valdataggar as $value) {
                array_push($taggar, $value);
            }
        }

        if ($nyataggar!=null) {
            $nyataggar = explode(",", $nyataggar);
            $posta->nyaTaggar($nyataggar);
            $i = 0;
            foreach ($nyataggar as $key=>$value) {
                array_push($taggar, $i + intval($nastaTaggId));
                $i++;
            } // nu finns även de nya taggarna i listan som skall koppla taggar och fråga
        }
        $slug = $this->slugify->slugify($title);


        while (in_array($slug, $sluggarna)) {
            $slug = $slug . "-i";
        }

        $posta->postaFraga($title, $data, $slug, $userid);
        $posta->kopplaFragaTaggar($nastaInlaggId, $taggar);
        return $this->di->get("response")->redirect($retursida)->send();
    }


}
