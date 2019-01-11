<?php

namespace KW\Inlagg;


use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;



//use KW\Inlagg\TextFilter;
//use KW\Inlagg\Slugify;
//use KW\Inlagg\Hamtaren;
//use KW\Inlagg\Fragehamtaren;
//use KW\Inlagg\Hamtaren;

class AnvandareController implements ContainerInjectableInterface
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
        $hamtaren = new Hamtaren($this->di);

        $res = $hamtaren->allaAnvandare();

        $page = $this->di->get("page");
        $page->add("anax/v2/anvandare/anvandare", [
            "res" => $res,
        ]);

        return $page->render([
            "title"=>"Användare",
        ]);
    }

    public function anvandaridActionGet($id)
    {
        $hamtaren = new Hamtaren($this->di);
        $fragehamtaren = new Fragehamtaren($this->di);
        $res = $hamtaren->enAnvandare($id);
        $res2 = $hamtaren->anvandarensFragor($id);
        $page = $this->di->get("page");
        $page->add("anax/v2/anvandare/anvandarid", [
            "res" => $res,
        ]);





        $taggar = [];
        $antalsvar = [];
        foreach($res2 as $rad) {
            $tags = $fragehamtaren->hamtaTaggar($rad->id);
            array_push($taggar, $tags);
            $nrsvar = $fragehamtaren->raknaSvar($rad->id);
            array_push($antalsvar, $nrsvar);
        }

        $page->add("anax/v2/anvandare/anvandarensfragor", [
            "res" => $res,
            "res2"=>$res2,
            "taggar"=>$taggar,
            "antalsvar"=>$antalsvar
        ]);

        $res3 = $hamtaren->anvandarensSvar($id);

        $sluggar = [];

        foreach($res3 as $rad) {
            $slugg = $hamtaren->inlaggetHarSluggen($rad->tillhor);
            array_push($sluggar, $slugg);
        }


        $page->add("anax/v2/anvandare/anvandarenssvar", [
            "res" => $res,
            "sluggar"=>$sluggar,
            "res3"=>$res3,
        ]);

        return $page->render([
            "title"=>"Användare",
        ]);
    }


}
