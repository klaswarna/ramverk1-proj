<?php
namespace KW\Inlagg;

$textFilter = new TextFilter();

namespace Anax\View;

$base=$this->di->request->getBaseUrl();
$end=$this->di->request->getCurrentUrl();
$retursida= url() . str_replace($base, "", $end);

$sortFr = $this->di->request->getGet("sortfr");

$grund = explode("?", $retursida);




?>
<h1>Alla frågor

<?php if (isset($tagg)) { ?>
    med taggen "<?=$tagg?>"
<?php } ?>

</h1>

<div class="sortochpen">

<table class="sorttable vanster">
    <tr class="fragtabrad">
<?php if ($sortFr == "rankning" || $sortFr == null) { ?>
    <td>Sortera efter: </td><td class="bredd"><b>poäng</b></td><td class="bredd"> <a class="sidolank" href='<?=($grund[0] . "?sortfr" . "=" . "published")?>'>datum</a></td>
<?php  } ?>

<?php if ($sortFr == "published") { ?>
    <td>Sortera efter:</td><td class="bredd"> <a class="sidolank" href='<?=($grund[0] . "?sortfr" . "=" . "rankning")?>'>poäng </a></td><td class="bredd"> <b>datum</b></td>
<?php  } ?>
</tr>
</table>


<?php if ($this->di->session->get("anvandarid")) { ?>

    <a href="#frageform">
    <div class="hoger sidolank2"> <i class="fa fa-pencil-alt" aria-hidden="true"></i>Skriv ny fråga</div>
    </a>


<?php } ?>


</div>






<?php foreach ($res as $key => $row) { ?>



            <div class="fragefalt">
        <a href="<?=url("anvandare/anvandarid")?>/<?=$row->userid?>">
            <img src='https://www.gravatar.com/avatar/<?php echo(md5(strtolower(trim($row->email)))) ?>?s=60&d=mp'>
        </a>
        <i>Postat <?=$row->published?> av <?=$row->anvandarnamn?></i>
        <br>
        <?php foreach ($taggar[$key] as $tags) { ?>
            <a class="sidolank2" href="<?=url("fragor/tagg/" . $tags->tagg)?>"><div class="taggruta"><?=$tags->tagg?></div></a>

        <?php } ?>
        <br>Antalsvar: <?=$antalsvar[$key]->nr?>

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




        <a class="sidolank2" href='<?=url("inlagg/enskiltinlagg")?>/<?=$row->slug?>?sortsv=rankning&sortko=published'>
        <div>
        <p><b><?=$row->title?></b></p>
        <p><?=$textFilter->parse($row->data, "markdown")?></p>
        </div>
        </a>
        </div>






<?php } ?>
