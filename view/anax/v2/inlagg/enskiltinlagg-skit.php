<?php
namespace KW\Inlagg;

$textFilter = new TextFilter();

namespace Anax\View;

$base=$this->di->request->getBaseUrl();
$end=$this->di->request->getCurrentUrl();
$retursida= url() . str_replace($base,"", $end);

$sortSv = $this->di->request->getGet("sortsv");
$andratypenSv = ($sortSv == "rankning" ? "published" : "rankning");
$enanamnetSv = ($sortSv == "rankning" ? "rankning" : "datum");
$andranamnetSv = ($sortSv == "rankning" ? "datum" : "rankning");

$sortKo = $this->di->request->getGet("sortko");
$andratypenKo = ($sortKo == "rankning" ? "published" : "rankning");
$enanamnetKo = ($sortKo == "rankning" ? "rankning" : "datum");
$andranamnetKo = ($sortKo == "rankning" ? "datum" : "rankning");

$grund = explode("?", $retursida);

?>


<b>Svar</b> är sorterade efter <b><?=$enanamnetSv?>.</b> <a class="sidolank" href='<?=($grund[0] . "?sortsv" . "=" . $andratypenSv . "&sortko=" . $sortKo)?>'>Sortera istället efter <?=$andranamnetSv?>. </a><br>
<b>Kommentarer</b> är sorterade efter <b><?=$enanamnetKo?>.</b> <a class="sidolank" href='<?=($grund[0] . "?sortsv" . "=" . $sortSv . "&sortko=" . $andratypenKo)?>'>Sortera istället efter <?=$andranamnetKo?>. </a>
<br><br>

<?php if($sortSv == "rankning") { ?>
    <b>Svar</b> sorteras efter: <b>rankning</b> <a class="sidolank" href='<?=($grund[0] . "?sortsv" . "=" . "published" . "&sortko=" . $sortKo)?>'>datum</a>
<?php  } ?>
<?php if($sortSv == "published") { ?>
    <b>Svar</b> sorteras efter: <a class="sidolank" href='<?=($grund[0] . "?sortsv" . "=" . "rankning" . "&sortko=" . $sortKo)?>'>rankning </a><b>datum</b>
<?php  } ?>
<br>
<?php if($sortKo == "rankning") { ?>
    <b>Kommentarer</b> sorteras efter: <b>rankning</b> <a class="sidolank" href='<?=($grund[0] . "?sortsv" . "=" . $sortSv . "&sortko=" . "published")?>'>datum</a>
<?php  } ?>
<?php if($sortKo == "published") { ?>
    <b>Kommentarer</b> sorteras efter: <a class="sidolank" href='<?=($grund[0] . "?sortsv" . "=" . $sortSv . "&sortko=" . "rankning")?>'>rankning </a><b>datum</b>
<?php  } ?>





        <?php foreach ($res as $row) : ?>
        <?php if ($row->type =="fraga") { ?>
            <div class="fragefalt">


                <img src='https://www.gravatar.com/avatar/<?php echo(md5(strtolower(trim($row->email)))) ?>?s=60&d=mp'>
                <i>Postat <?=$row->published?> av <?=$row->anvandarnamn?></i>
                <br>
                <?php foreach ($taggar as $tags){ ?>
                    <div class="taggruta"><?=$tags->tagg?></div>
                <?php } ?>
                <p><b><?=$row->title?></b></p>
                <p><?=$textFilter->parse($row->data, "markdown")?></p>

                <?php if (null!=($this->di->session->get("anvandarnamn"))) { ?>


                    <div id="svarknapp" class="skrivsvar">
                    Skriv eget SVAR på frågan
                    </div>
                    <div id="svarform" class="osynlig">
                        <form id="svarformen" action='<?=url("inlagg/postasvar")?>' method="post">
                            <textarea form="svarformen" name="data">Skriv ditt svar här...</textarea>
                            <input type="hidden" name="userid" value="<?=$this->di->session->get("anvandarid")?>">
                            <input type="hidden" name="tillhor" value="<?=$row->id?>">
                            <input type="hidden" name="type" value="svar">
                            <input type="hidden" name="retursida" value="<?=$retursida?>">
                            <input type="submit" name="knapp" value="Posta svar">
                        </form>
                    </div>
                    <script>
                        var knapp = document.getElementById("svarknapp").addEventListener("click", function() {
                            document.getElementById("svarform").classList.toggle("osynlig");
                        })
                    </script>



                    <div id="kommknapp<?=$row->id?>" class="skrivkommentar">
                    KOMMENTERA frågan
                    </div>
                    <div id="form<?=$row->id?>" class="osynlig">
                        <form id="formen<?=$row->id?>" action='<?=url("inlagg/postakommentar")?>' method="post">
                            <textarea form="formen<?=$row->id?>" name="data">Skriv kommentar här...</textarea>
                            <input type="hidden" name="userid" value="<?=$this->di->session->get("anvandarid")?>">
                            <input type="hidden" name="tillhor" value="<?=$row->id?>">
                            <input type="hidden" name="type" value="kommentar">
                            <input type="hidden" name="retursida" value="<?=$retursida?>">
                            <input type="submit" name="knapp" value="Posta kommentar">
                        </form>
                    </div>
                    <script>
                        var knapp<?=$row->id?> = document.getElementById("kommknapp<?=$row->id?>").addEventListener("click", function() {
                            document.getElementById("form<?=$row->id?>").classList.toggle("osynlig");
                        })
                    </script>


                <?php } ?>


            </div>
        <?php } ?>

        <?php if ($row->type =="kommentar") { ?>
            <div class="kommentarfalt">
                <img src='https://www.gravatar.com/avatar/<?php echo(md5(strtolower(trim($row->email)))) ?>?s=30&d=mp'>
                <i>Postat <?=$row->published?> av <?=$row->anvandarnamn?></i>
                <p><b><?=$row->title?></b></p>
                <p><?=$textFilter->parse($row->data, "markdown")?></p>
            </div>
        <?php } ?>

        <?php if ($row->type =="svar") { ?>
            <div class="svarfalt">
                <img src='https://www.gravatar.com/avatar/<?php echo(md5(strtolower(trim($row->email)))) ?>?s=50&d=mp'>
                <i>Postat <?=$row->published?> av <?=$row->anvandarnamn?></i>

                <div class="rank"> <?=$row->rankning?></div>
                <p><b><?=$row->title?></b></p>
                <p><?=$textFilter->parse($row->data, "markdown")?></p>

                <?php if (null!=($this->di->session->get("anvandarnamn"))) { ?>
                    <div id="kommknapp<?=$row->id?>" class="skrivkommentar">
                    Kommentera inlägg
                    </div>
                    <div id="form<?=$row->id?>" class="osynlig">
                        <form id="formen<?=$row->id?>" action='<?=url("inlagg/postakommentar")?>' method="post">

                            <textarea form="formen<?=$row->id?>" name="data">Skriv kommentar här...</textarea>
                            <input type="hidden" name="userid" value="<?=$this->di->session->get("anvandarid")?>">
                            <input type="hidden" name="tillhor" value="<?=$row->id?>">
                            <input type="hidden" name="type" value="kommentar">
                            <input type="hidden" name="retursida" value="<?=$retursida?>">
                            <input type="submit" name="knapp" value="Posta kommentar">
                        </form>
                    </div>
                    <script>
                        var knapp<?=$row->id?> = document.getElementById("kommknapp<?=$row->id?>").addEventListener("click", function() {
                            document.getElementById("form<?=$row->id?>").classList.toggle("osynlig");
                        })
                    </script>
                <?php } ?>

            </div>
        <?php } ?>



        <?php endforeach; ?>
