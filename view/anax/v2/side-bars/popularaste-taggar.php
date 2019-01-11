<?php
namespace KW\Inlagg;

$textFilter = new TextFilter();

namespace Anax\View;

?>

<div class="row">
<div class="region-after-main">



<h4 class="cooloverskrift2">Populäraste taggar</h4>

    <div class="horisontelltaggbar">

        <?php foreach ($res2 as $row) { ?>


            <a class="sidolank" href='<?=url("fragor/tagg")?>/<?=$row->tagg?>?sortsv=rankning&sortko=published'>

                <div class="taggruta2"><?=$row->tagg?></div>

            </a>

<?php    }?>

</div>

</div>
</div>
