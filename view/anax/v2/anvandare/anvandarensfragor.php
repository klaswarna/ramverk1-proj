<?php
namespace KW\Inlagg;

$textFilter = new TextFilter();


namespace Anax\View;

if (count($res2)>0) { ?>


<h3>Följande frågor har skrivits av <?=$res->anvandarnamn?></h3>


<?php   foreach ($res2 as $key => $row) { ?>

                <div class="fragefalt">
            <i>Postat <?=$row->published?></i>
            <br>
            <?php foreach ($taggarna[$key] as $tags) { ?>
                <a class="sidolank2" href="<?=url("fragor/tagg/" . $tags->tagg)?>"><div class="taggruta"><?=$tags->tagg?></div></a>

            <?php } ?>
            <br>Antalsvar: <?=$antalsvar[$key]->nr?>
            <br>Poäng: <?=$row->rankning?>



            <a class="sidolank2" href='<?=url("inlagg/enskiltinlagg")?>/<?=$row->slug?>?sortsv=rankning&sortko=published'>
            <div>
            <p><b><?=$row->title?></b></p>
            <p><?=$textFilter->parse($row->data, "markdown")?></p>
            </div>
            </a>
            </div>

    <?php } ?>
<?php } ?>
