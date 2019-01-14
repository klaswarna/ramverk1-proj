<?php

namespace KW\Inlagg;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class TaggarController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    public function indexActionGet()
    {
        $fragehamtaren = new Fragehamtaren($this->di);
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
