<?php
namespace KW\Inlagg;

$textFilter = new TextFilter();

namespace Anax\View;

?>

<div class="wrap-sidebar region-sidebar-right has-sidebar-right has-sidebar has-sidebar-left" role="complementary">
<div class="paddavanster">

<h4 class="cooloverskrift">Våra flitigaste användare</h4>
        <?php foreach ($res3 as $row) { ?>

            <a class="sidolank" href='<?=url("anvandare/anvandarid")?>/<?=$row->anvandarid?>'>
            <div class="anvandare2">
                <b><?=$row->anvandarnamn?></b>
                <br><img src='https://www.gravatar.com/avatar/<?php echo(md5(strtolower(trim($row->email)))) ?>?s=60&d=mp'>
                 <br>Medlem sedan <?=substr($row->datum, 0, 10)?>
            </div>


            </a>

<?php   }?>
</div>
</div>
