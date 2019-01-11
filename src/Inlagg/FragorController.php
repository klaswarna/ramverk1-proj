<?php

namespace KW\Inlagg;


use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;



//use KW\Inlagg\TextFilter;
//use KW\Inlagg\Slugify;
//use KW\Inlagg\Hamtaren;
//use KW\Inlagg\Fragehamtaren;


class FragorController implements ContainerInjectableInterface
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
        $fragehamtaren = new \KW\Inlagg\Fragehamtaren($this->di);
        $sort = $this->di->get("request")->getGet("sortfr");

        $res = $fragehamtaren->allaInlagg($sort);


        $taggar = [];
        $antalsvar = [];
        foreach($res as $rad) {
            $tags = $fragehamtaren->hamtaTaggar($rad->id);
            array_push($taggar, $tags);
            $nrsvar = $fragehamtaren->raknaSvar($rad->id);
            array_push($antalsvar, $nrsvar);
        }


        $alltags = $fragehamtaren->allaTaggar();



        $page = $this->di->get("page");
        $page->add("anax/v2/fragor/allafragor", [
            "res" => $res,
            "taggar"=>$taggar,
            "alltags"=>$alltags,
            "antalsvar"=>$antalsvar
            ]);

        if($this->di->session->get("anvandarid")!=null) {
            $page->add("anax/v2/fragor/nyfraga", [
                "res" => $res,
                "taggar"=>$taggar,
                "alltags"=>$alltags
            ]);
        }

        return $page->render([
            "title"=>"Hem",
        ]);
    }

    public function taggActionGet($tagg)
    {
        $fragehamtaren = new \KW\Inlagg\Fragehamtaren($this->di);
        $sort = $this->di->get("request")->getGet("sortfr");

        $res = $fragehamtaren->fragorMedTaggen($tagg, $sort);
        $taggar = [];
        $antalsvar = [];
        foreach($res as $rad) {
            $tags = $fragehamtaren->hamtaTaggar($rad->id);
            array_push($taggar, $tags);
            $nrsvar = $fragehamtaren->raknaSvar($rad->id);
            array_push($antalsvar, $nrsvar);
        }




        $alltags = $fragehamtaren->allaTaggar();

        $page = $this->di->get("page");
        $page->add("anax/v2/fragor/allafragor", [
            "res" => $res,
            "taggar"=>$taggar,
            "alltags"=>$alltags,
            "antalsvar"=>$antalsvar,
            "tagg"=>$tagg

            ]);

        if($this->di->session->get("anvandarid")!=null) {
            $page->add("anax/v2/fragor/nyfraga", [
                "res" => $res,
                "taggar"=>$taggar,
                "alltags"=>$alltags
            ]);
        }

        return $page->render([
            "title"=>"Hem",
        ]);


    }

}
