<?php
namespace KW\Inlagg;

$textFilter = new TextFilter();

namespace Anax\View;

?>


<article class="article">

<h1>Taggar</h1>

<p>Grammatikgrottan tar upp en mängd grammatikfrågor. För att få en lättare överblick är varje fråga kopplad till en
    eller flera taggar. Nedan ser du alla taggar i forumet. Klicka på en tagg för att lista de frågor som är knutna till
    den.
</p>


<?php foreach ($res as $tags){ ?>
    <a class="sidolank2" href="<?=url("fragor/tagg/" . $tags->tagg)?>"><div class="taggruta litestorre"><?=$tags->tagg?></div></a>
<?php } ?>



</article>
