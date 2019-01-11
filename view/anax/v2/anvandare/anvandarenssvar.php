<?php
namespace KW\Inlagg;

$textFilter = new TextFilter();


namespace Anax\View; ?>



<?php
if (count($res3)>0) { ?>

<h3>Följande svar har skrivits av <?=$res->anvandarnamn?></h3>

<?php

    foreach ($res3 as $key=>$row) { ?>

        <a class="sidolank2" href='<?=url("inlagg/enskiltinlagg")?>/<?=$sluggar[$key]->slug?>?sortsv=rankning&sortko=published'>
                <div class="svarfalt2">
            <i>Postat <?=$row->published?></i>
            <br>Svar på frågan:<b><?=$sluggar[$key]->title?></b>
            <br>Poäng: <?=$row->rankning?>



            <div>
            <p><b><?=$row->title?></b></p>
            <p><?=$textFilter->parse($row->data, "markdown")?></p>
            </div>

            </div>
            </a>

    <?php }
} ?>
