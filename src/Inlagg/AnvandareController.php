<?php

namespace KW\Inlagg;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class AnvandareController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexActionGet()
    {
        $anvandare = new Anvandare($this->di);
        $res = $anvandare->allaAnvandare();
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
        $anvandare      = new Anvandare($this->di);
        $taggar         = new Taggar($this->di);
        $fragehamtaren  = new Fragehamtaren($this->di);
        $hamtaren       = new Hamtaren($this->di);

        $taggarna   = [];
        $antalsvar  = [];
        $sluggar    = [];

        $res    = $anvandare->enAnvandare($id);
        $res2   = $anvandare->anvandarensFragor($id);
        $page   = $this->di->get("page");
        $page->add("anax/v2/anvandare/anvandarid", [
            "res" => $res,
        ]);


        foreach ($res2 as $rad) {
            $tags   = $taggar->hamtaTaggar($rad->id);
            $nrsvar = $fragehamtaren->raknaSvar($rad->id);
            array_push($taggarna, $tags);
            array_push($antalsvar, $nrsvar);
        }

        $page->add("anax/v2/anvandare/anvandarensfragor", [
            "res"       => $res,
            "res2"      => $res2,
            "taggarna"  => $taggarna,
            "antalsvar" => $antalsvar
        ]);

        $res3 = $anvandare->anvandarensSvar($id);

        foreach ($res3 as $rad) {
            $slugg = $hamtaren->inlaggetHarSluggen($rad->tillhor);
            array_push($sluggar, $slugg);
        }

        $page->add("anax/v2/anvandare/anvandarenssvar", [
            "res"       => $res,
            "sluggar"   => $sluggar,
            "res3"      => $res3,
        ]);
        return $page->render([
            "title"=>"Användare",
        ]);
    }
}
