<?php
namespace KW\Inlagg;

$textFilter = new TextFilter();

namespace Anax\View;

?>


<div class="wrap-sidebar region-sidebar-left has-sidebar-right has-sidebar has-sidebar-left mindrebred" role="complementary">

<div class="paddahoger">

<h4 class="cooloverskrift">Senaste frågor</h4>
<?php
foreach ($res as $row) {
    if ($row->type =="fraga") { ?>
    <a class="sidolank" href='<?=url("inlagg/enskiltinlagg")?>/<?=$row->slug?>?sortsv=rankning&sortko=published'>
        <p>
            <b><?=$row->title?></b>
            <br>
            <i>Postat <?=$row->published?> av <?=$row->anvandarnamn?></i>
        </p>
    </a>
<?php
    }
}
?>
</div>
</div>
