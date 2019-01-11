<?php

namespace KW\Inlagg;


use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;



//use KW\Inlagg\TextFilter;
//use KW\Inlagg\Slugify;
//use KW\Inlagg\Hamtaren;
//use KW\Inlagg\Fragehamtaren;


class MinsidaController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    //private $textFilter;
    //private $slugify;


    // public function __construct()
    // {
    //     $this->textFilter = new TextFilter();
    //     $this->slugify = new Slugify();
    // }

    public function indexActionGet()
    {
        $page = $this->di->get("page");
        $page->add("anax/v2/minsida/minsida", [
            ]);
        return $page->render([
            "title"=>"Min sida"
        ]);
    }

    public function indexActionPost(){
        $typ = $this->di->get("request")->getPost("knapp");
        $inloggaren = new \KW\Inlagg\Inloggaren($this->di);
        if ($typ == "Spara nytt lösenord") {
            $losenord = $this->di->get("request")->getPost("losenord");
            $inloggaren->uppdateraInlogg("losenord", MD5($losenord));
        }
        if ($typ == "Spara ny epostadress") {
            $epost = $this->di->get("request")->getPost("epost");
            $inloggaren->uppdateraInlogg("email", $epost);
            $this->di->session->set("email", $epost);
        }
        return $this->di->get("response")->redirect("minsida")->send();
    }




}
