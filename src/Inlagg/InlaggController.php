<?php

namespace KW\Inlagg;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

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

        $sorteraren = new Sorteraren($this->di);
        $hamtaren   = new Hamtaren($this->di);

        $res    = $sorteraren->sorteraFragorOchSvar($slug, $sortsv, $sortko);
        $taggar = $hamtaren->hamtataggar($res[0]->id);

        $page = $this->di->get("page");
                $page->add("anax/v2/inlagg/enskiltinlagg", [
                    "res"   => $res,
                    "taggar"=> $taggar
                    ]);
                return $page->render([
                    "title"=>"Frågor"
                    ]);
    }

    public function postakommentarActionPost()
    {
        $rankning   = new Rankning($this->di);
        $posta      = new Posta($this->di);
        $data       = $this->di->get("request")->getPost("data");
        $userid     = $this->di->get("request")->getPost("userid");
        $tillhor    = $this->di->get("request")->getPost("tillhor");
        $type       = $this->di->get("request")->getPost("type");
        $retursida  = $this->di->get("request")->getPost("retursida");

        $posta->postaNyKommentar($data, $userid, $tillhor, $type);
        $rankning->uppdatera($userid, "kommentar", 1);

        return $this->di->get("response")->redirect($retursida)->send();
    }

    public function postasvarActionPost()
    {
        $rankning   = new Rankning($this->di);
        $posta      = new Posta($this->di);
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
        $rankning = new Rankning($this->di);
        $retursida = $this->di->get("request")->getPost("retursida");

        $rankning->upp($id);
        $inlagg = $rankning->vemsInlagg($id);
        $rankning->uppdatera($inlagg->userid, "r" .$inlagg->type, 1);
        return $this->di->get("response")->redirect($retursida)->send();
    }

    public function rankaNerInlaggActionPost($id)
    {
        $rankning = new Rankning($this->di);
        $retursida = $this->di->get("request")->getPost("retursida");

        $rankning->ner($id);
        $inlagg = $rankning->vemsInlagg($id);
        $rankning->uppdatera($inlagg->userid, "r" . $inlagg->type, -1);

        return $this->di->get("response")->redirect($retursida)->send();
    }

    public function accepteraActionPost($id)
    {
        $rankning   = new Rankning($this->di);
        $retursida  = $this->di->get("request")->getPost("retursida");

        $rankning->acceptera($id);

        return $this->di->get("response")->redirect($retursida)->send();
    }

    public function postafragaActionPost()
    {
        $hamtaren   = new Hamtaren($this->di);
        $posta      = new Posta($this->di);
        $rankning   = new Rankning($this->di);

        $retursida      = $this->di->get("request")->getPost("retursida");
        $valdataggar    = $this->di->get("request")->getPost("tag");
        $nyataggar      = $this->di->get("request")->getPost("nyataggar");
        $title          = $this->di->get("request")->getPost("title");
        $data           = $this->di->get("request")->getPost("data");
        $taggar = [];

        $userid         = $this->di->session->get("anvandarid");
        $nastaTaggId    = intval($hamtaren->nastaAutoInc("taggar")->auto_increment);
        $nastaInlaggId  = intval($hamtaren->nastaAutoInc("inlagg")->auto_increment);
        $sluggarna      = $hamtaren->befintligaSluggar();

        $rankning->uppdatera($userid, "fraga", 1);

        if ($valdataggar!=null) {
            foreach ($valdataggar as $value) {
                array_push($taggar, $value);
            }
        }

        if ($nyataggar!=null) {
            $nyataggar = explode(",", $nyataggar);
            $posta->nyaTaggar($nyataggar);
            $i = 0;
            foreach ($nyataggar as $value) {
                array_push($taggar, $i + intval($nastaTaggId));
                $i++;
            }
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
