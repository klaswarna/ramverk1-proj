<?php

namespace KW\Inlagg;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class OmController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

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
