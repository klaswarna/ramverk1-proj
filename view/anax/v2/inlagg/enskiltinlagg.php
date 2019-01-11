<?php
namespace KW\Inlagg;

$textFilter = new TextFilter();


namespace Anax\View;

$base=$this->di->request->getBaseUrl();
$end=$this->di->request->getCurrentUrl();
$retursida= url() . str_replace($base,"", $end);

$sortSv = $this->di->request->getGet("sortsv");
$sortKo = $this->di->request->getGet("sortko");
$grund = explode("?", $retursida);

?>

<h1><?= $res[0]->title ?></h1>
<b>Sortering</b>
<table class="sorttable">
    <tr class="svartabrad">
<?php if($sortSv == "rankning") { ?>
    <td> Svaren: </td><td class="bredd"><b>poäng</b></td><td class="bredd"> <a class="sidolank" href='<?=($grund[0] . "?sortsv" . "=" . "published" . "&sortko=" . $sortKo)?>'>datum</a></td>
<?php  } ?>

<?php if($sortSv == "published") { ?>
    <td>Svaren:</td><td class="bredd"> <a class="sidolank" href='<?=($grund[0] . "?sortsv" . "=" . "rankning" . "&sortko=" . $sortKo)?>'>poäng </a></td><td class="bredd"> <b>datum</b></td>
<?php  } ?>
</tr>
<tr class="komtabrad">
<?php if($sortKo == "rankning") { ?>
    <td>Kommentarer:</td><td class="bredd"> <b>poäng</b></td><td class="bredd"> <a class="sidolank" href='<?=($grund[0] . "?sortsv" . "=" . $sortSv . "&sortko=" . "published")?>'>datum</a></td>
<?php  } ?>
<?php if($sortKo == "published") { ?>
    <td>Kommentarer:</td><td class="bredd"> <a class="sidolank" href='<?=($grund[0] . "?sortsv" . "=" . $sortSv . "&sortko=" . "rankning")?>'>poäng </a></td><td class="bredd"><b>datum</b></td>
<?php  } ?>
</tr>
</table>

<script>
    var akf = "";
    var userminne;
</script>


        <?php foreach ($res as $row) : ?>
        <?php if ($row->type =="fraga") { ?>
            <div class="fragefalt">

                <a href="<?=url("anvandare/anvandarid")?>/<?=$row->userid?>">
                    <img src='https://www.gravatar.com/avatar/<?php echo(md5(strtolower(trim($row->email)))) ?>?s=60&d=mp'>
                </a>
                <i>Postat <?=$row->published?> av <div id="user<?=$row->id?>" class="inl"> <?=$row->anvandarnamn?> </div></i>
                <br>
                <?php foreach ($taggar as $tags){ ?>
                    <a class="sidolank2" href="<?=url("fragor/tagg/" . $tags->tagg)?>"><div class="taggruta"><?=$tags->tagg?></div></a>
                <?php } ?>


                <div class="rankruta">
                    <form method="post" action='<?=url("inlagg/rankauppinlagg")?>/<?=$row->id?>'>
                        <input type="hidden" name="retursida" value="<?=$retursida?>">
                        <input class="tomknapp" type="submit" value="+">
                    </form>

                    <div class="rank"> <?=$row->rankning?><br></div>

                    <form method="post" action='<?=url("inlagg/rankanerinlagg")?>/<?=$row->id?>'>
                        <input type="hidden" name="retursida" value="<?=$retursida?>">
                        <input class="tomknapp" type="submit" value="-">
                    </form>

                </div>




                <p><b><?=$row->title?></b></p>
                <p><?=$textFilter->parse($row->data, "markdown")?></p>

                <?php if (null!=($this->di->session->get("anvandarnamn"))) { ?>


                    <div id="svarknapp" class="skrivsvar">
                    Skriv ett SVAR
                    </div>
                    <div id="svarform" class="skrivarea osynlig">
                        <form id="svarformen" action='<?=url("inlagg/postasvar")?>' method="post">
                            <textarea class="textarea" id="tarea<?=$row->id?>" form="svarformen" name="data">Skriv ditt svar här...</textarea>
                            <input type="hidden" name="userid" value="<?=$this->di->session->get("anvandarid")?>">
                            <input type="hidden" name="tillhor" value="<?=$row->id?>">
                            <input type="hidden" name="type" value="svar">
                            <input type="hidden" name="retursida" value="<?=$retursida?>">
                            <input class="submitknapp" type="submit" name="knapp" value="Posta svar">
                        </form>
                    </div>
                    <script>
                        var knapp = document.getElementById("svarknapp").addEventListener("click", function() {
                            document.getElementById("svarform").classList.toggle("osynlig");
                            akf = document.getElementById("tarea<?=$row->id?>");
                        });
                    </script>



                    <div id="kommknapp<?=$row->id?>" class="skrivkommentar">
                    KOMMENTERA frågan
                    </div>
                    <div id="form<?=$row->id?>" class="skrivarea osynlig">
                        <form id="formen<?=$row->id?>" action='<?=url("inlagg/postakommentar")?>' method="post">
                            <textarea class="textarea" id="tarea<?=$row->id?>" form="formen<?=$row->id?>" name="data">Skriv kommentar här...</textarea>
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
                            akf = document.getElementById("tarea<?=$row->id?>");
                        });
                        var namnknapp = document.getElementById("user<?=$row->id?>").addEventListener("click", function() {
                            userminne = "@<?=$row->anvandarnamn?>";
                            akf.value = akf.value.slice(0, akf.selectionStart) + userminne + akf.value.slice(akf.selectionStart);
                        });
                    </script>


                <?php } ?>


            </div>
        <?php } ?>

        <?php if ($row->type =="kommentar") { ?>
            <div class="kommentarfalt">
                <a href="<?=url("anvandare/anvandarid")?>/<?=$row->userid?>">
                <img src='https://www.gravatar.com/avatar/<?php echo(md5(strtolower(trim($row->email)))) ?>?s=30&d=mp'>
                </a>
                <i>Postat <?=$row->published?> av <div id="user<?=$row->id?>" class="inl"> <?=$row->anvandarnamn?> </div></i>



                <div class="rankruta2">
                    <form method="post" action='<?=url("inlagg/rankauppinlagg")?>/<?=$row->id?>'>
                        <input type="hidden" name="retursida" value="<?=$retursida?>">
                        <input class="tomknapp" type="submit" value="+">
                    </form>

                    <div class="rank2"> <?=$row->rankning?><br></div>

                    <form method="post" action='<?=url("inlagg/rankanerinlagg")?>/<?=$row->id?>'>
                        <input type="hidden" name="retursida" value="<?=$retursida?>">
                        <input class="tomknapp" type="submit" value="-">
                    </form>

                </div>



                <p><b><?=$row->title?></b></p>
                <p><?=$textFilter->parse($row->data, "markdown")?></p>
            </div>
            <script>
            var namnknapp = document.getElementById("user<?=$row->id?>").addEventListener("click", function() {
                userminne = "**@<?=$row->anvandarnamn?>**";
                akf.value = akf.value.slice(0, akf.selectionStart) + userminne + akf.value.slice(akf.selectionStart);
            });
            </script>


        <?php } ?>


        <?php if ($row->type =="svar") { ?>
            <div class="svarfalt">
                <a href="<?=url("anvandare/anvandarid")?>/<?=$row->userid?>">
                    <img src='https://www.gravatar.com/avatar/<?php echo(md5(strtolower(trim($row->email)))) ?>?s=50&d=mp'>
                </a>
                <i>Postat <?=$row->published?> av <div id="user<?=$row->id?>" class="inl"> <?=$row->anvandarnamn?> </div></i>

                <?php if($row->godkant==false && $this->di->session->get("anvandarid")) { ?>
                    <form method="post" action='<?=url("inlagg/acceptera")?>/<?=$row->id?>'>
                        <input type="hidden" name="retursida" value="<?=$retursida?>">
                        <input class="varning tomknapp" type="submit" value="Obs! Detta svar har ännu inte granskats och godkänts. Inloggad kan du klicka här om du accepterar svaret.">
                    </form>

                <?php } ?>

                <?php if($row->godkant==false && $this->di->session->get("anvandarid")==null) { ?>


                        <div class="varning">Obs! Detta svar har ännu inte granskats och godkänts. Inloggad kan du klicka här om du accepterar svaret.</div>


                <?php } ?>



                <?php if($row->godkant==true) { ?>
                    <br><div class="ok">Svaret är GODKÄNT</div>
                <?php } ?>

                <?php if($row->godkant==true) { ?>
                <div class="rankruta">
                    <form method="post" action='<?=url("inlagg/rankauppinlagg")?>/<?=$row->id?>'>
                        <input type="hidden" name="retursida" value="<?=$retursida?>">
                        <input class="tomknapp" type="submit" value="+">
                    </form>

                    <div class="rank"> <?=$row->rankning?><br></div>

                    <form method="post" action='<?=url("inlagg/rankanerinlagg")?>/<?=$row->id?>'>
                        <input type="hidden" name="retursida" value="<?=$retursida?>">
                        <input class="tomknapp" type="submit" value="-">
                    </form>
                </div>
            <?php } ?>
                <p><b><?=$row->title?></b></p>
                <p><?=$textFilter->parse($row->data, "markdown")?></p>

                <?php if (null!=($this->di->session->get("anvandarnamn"))) { ?>
                    <div id="kommknapp<?=$row->id?>" class="skrivkommentar">
                    Kommentera
                    </div>
                    <div id="form<?=$row->id?>" class="osynlig">
                        <form id="formen<?=$row->id?>" action='<?=url("inlagg/postakommentar")?>' method="post">

                            <textarea class="textarea" id="tarea<?=$row->id?>"form="formen<?=$row->id?>" name="data">Skriv kommentar här...</textarea>
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
                            akf = document.getElementById("tarea<?=$row->id?>");
                        });
                        var knapp2 = document.getElementById("user<?=$row->id?>").addEventListener("click", function() {
                            userminne = "**@<?=$row->anvandarnamn?>**";
                            akf.value = akf.value.slice(0, akf.selectionStart) + userminne + akf.value.slice(akf.selectionStart);
                        });
                    </script>
                <?php } ?>

            </div>
        <?php } ?>



        <?php endforeach; ?>
