<?php

namespace Anax\View;

?>


<article class="article">

<h1>Våra användare</h1>

<p>Dessa personer är medlemmar av grammatikgrottan</p>
<p>Är man medlem kan man ställa frågor och skriva svar. Du kan registrera dig via LOGGA IN > Skapa ny användare</p>


<?php foreach ($res as $row) { ?>
    <a class="sidolank2" href="<?=url("anvandare/anvandarid/" . $row->anvandarid)?>">
        <div class="anvandare">
            <img src='https://www.gravatar.com/avatar/<?php echo(md5(strtolower(trim($row->email)))) ?>?s=60&d=mp'>
            <br><i><?=$row->anvandarnamn?></i> <br>Medlem sedan <?=substr($row->datum, 0, 10)?>
            <?php $rank = 2*$row->fraga + 3*$row->svar + $row->kommentar + 2*$row->rfraga + 4*$row->rsvar + $row->rkommentar; ?>
            <br>Rykte: <?= $rank ?>
        </div>
    </a>
<?php } ?>



</article>
