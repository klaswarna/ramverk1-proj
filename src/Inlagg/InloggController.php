<?php

namespace KW\Inlagg;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class InloggController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function loggainActionPost()
    {
        $inloggaren     = new Inloggaren($this->di);
        $anvandarnamn   = $this->di->get("request")->getPost("anvandarnamn");
        $losen          = $this->di->get("request")->getPost("losen");
        $email          = $this->di->get("request")->getPost("email");
        $loggain        = $this->di->get("request")->getPost("loggain");

        //Att man vill logga in och inte skapa nytt
        if ($loggain != null) {
            //försök logga in
            $res = $inloggaren->loggain($anvandarnamn, $losen);

            //om felaktiga uppgifter matats in
            if (!$res) {
                return $this->di->get("response")->redirect("inlogg/felinlogg")->send(); //denna funkar inte
            } else {
                return $this->di->get("response")->redirect("minsida")->send();
            }
        }

        //ny användare  MD5

        //om användarnamnet upptaget
        if ($inloggaren->anvandarnamnUpptaget($anvandarnamn)) {
            return $this->di->get("response")->redirect("inlogg/finnsredan")->send();
        }

        if ($email=="" || $losen=="" || $anvandarnamn =="") {
            return $this->di->get("response")->redirect("inlogg/felaktigauppgifter")->send();
        }

        //skapa ny användare
        $inloggaren->skapaNyanvandare($anvandarnamn, $losen, $email);
        //logga in ny användare därefter
        $inloggaren->loggain($anvandarnamn, $losen);
        return $this->di->get("response")->redirect("minsida")->send();
    }


    public function felinloggActionGet()
    {
        $page = $this->di->get("page");
                $page->add("anax/v2/inlogg/felinlogg", [
                    ]);
                return $page->render([
                    "title"=>"Felinlogg"
                ]);
    }

    public function finnsredanActionGet()
    {
        $page = $this->di->get("page");
                $page->add("anax/v2/inlogg/finnsredan", [
                    ]);
                return $page->render([
                    "title"=>"Felinlogg"
                ]);
    }

    public function felaktigauppgifterActionGet()
    {
        $page = $this->di->get("page");
                $page->add("anax/v2/inlogg/felaktigauppgifter", [
                    ]);
                return $page->render([
                    "title"=>"Felaktiga uppgifter"
                ]);
    }

    public function loggautActionGet()
    {
        $this->di->session->destroy();
        return $this->di->get("response")->redirect("")->send();
    }
}
