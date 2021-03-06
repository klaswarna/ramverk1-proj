<?php

namespace KW\Inlagg;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class StartController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexActionGet()
    {
        $fragehamtaren = new Fragehamtaren($this->di);
        $res  = $fragehamtaren->hamtaSenasteInlagg();
        $res2 = $fragehamtaren->popularasteTaggar();
        $res3 = $fragehamtaren->aktivasteAnvandare();

        $page = $this->di->get("page");

        $page->add("anax/v2/side-bars/senaste-fragor", [
            "res" => $res,
            ]);

        $page->add("anax/v2/start/start", [
            ]);

        $page->add("anax/v2/side-bars/aktivaste-anvandare", [
            "res3" => $res3,
            ]);

        $page->add("anax/v2/side-bars/popularaste-taggar", [
            "res2" => $res2,
            ]);

        return $page->render([
            "title"=>"Hem"
        ]);
    }
}
