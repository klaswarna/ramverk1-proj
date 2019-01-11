<?php

namespace KW\Inlagg;


use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;



//use KW\Inlagg\TextFilter;
//use KW\Inlagg\Slugify;
//use KW\Inlagg\Hamtaren;
use KW\Inlagg\Fragehamtaren;


class OmController implements ContainerInjectableInterface
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
        $page->add("anax/v2/om/om", [

            ]);


        return $page->render([
            "title"=>"Om"
        ]);




    }


}
