<?php

namespace KW\Inlagg;

/**
 * Slygifies titles
 *
 */
class Sorteraren
{

    public function __construct($di)
    {
        $this->di = $di;
        $this->hamtaren = new Hamtaren($this->di);
    }

    //samla fråga kommentarer, svar kommentarer i en tabell
    public function SorteraFragorOchSvar($slug, $sortsv, $sortko)
    {
        $res = [];

        $fragan = $this->hamtaren->hamtaEnFraga($slug);

        array_push($res, $fragan);

        //kommentarer till frågan
        $ktf = $this->hamtaren->hamtaKommentarer($res[0]->id, $sortko);
        foreach ($ktf as $value) {
            array_push($res, $value);
        }

        //olika svar och kommentarer till Dessa
        $svaren = $this->hamtaren->hamtaSvar($res[0]->id, $sortsv);

        //loopa i svaren och adda alla eventuella kommentarer
        foreach ($svaren as $value) {
            array_push($res, $value);//lägger till själva svaren ett och ett
            $kommentarerna = $this->hamtaren->hamtaKommentarer($value->id, $sortko);
            foreach($kommentarerna as $komvalue) {
                array_push($res, $komvalue);//lägger till kommentarer ett och ett
            }
        }

        return $res;
    }
}
