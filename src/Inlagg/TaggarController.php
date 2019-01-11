<?php

namespace KW\Inlagg;


use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;



//use KW\Inlagg\TextFilter;
//use KW\Inlagg\Slugify;
//use KW\Inlagg\Hamtaren;
use KW\Inlagg\Fragehamtaren;


class TaggarController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    //private $textFilter;
    //private $fragehamtaren;


    public function __construct()
    {
         //$this->fragehamtaren = new Fragehamtaren($this->di);
    }

    public function indexActionGet()
    {

        $fragehamtaren = new \KW\Inlagg\Fragehamtaren($this->di);
        $res = $fragehamtaren->allaTaggar();

        $page = $this->di->get("page");
        $page->add("anax/v2/taggar/taggar", [
                "res" => $res,
            ]);

        return $page->render([
            "title"=>"Taggar"
        ]);

    }




}
