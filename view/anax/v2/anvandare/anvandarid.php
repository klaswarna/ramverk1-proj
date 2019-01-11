<?php
namespace KW\Inlagg;

//$textFilter = new TextFilter();

namespace Anax\View;


function max90($tal)
{
    if ($tal <= 85) {
        return $tal;
    }
    return 85;
}

$rank = 2*$res->fraga + 3*$res->svar + $res->kommentar + 2*$res->rfraga + 4*$res->rsvar + $res->rkommentar;


?>


<article class="article">

<h1><?=$res->anvandarnamn?></h1>
<img src='https://www.gravatar.com/avatar/<?php echo(md5(strtolower(trim($res->email)))) ?>?s=100&d=mp'>

<p>Blev medlem <?=$res->datum?></p>

<h3>Statistik</h3>

<div class="diagramgrund">
    Aktivitet (antal inlägg)
    <div class="stapelgrund">
        <div class="stapeltext">
            Frågor
        </div>

        <div class="stapel" style="width: <?=max90(5*$res->fraga)?>%;">
            <?=$res->fraga?>
        </div>

    </div>

    <div class="stapelgrund">
        <div class="stapeltext">
            Svar
        </div>
        <div class="stapel" style="width: <?=max90(5*$res->svar)?>%;">
            <?=$res->svar?>
        </div>
    </div>

    <div class="stapelgrund">
        <div class="stapeltext">
            Kommentar
        </div>
        <div class="stapel" style="width: <?=max90(5*$res->kommentar)?>%;">
            <?=$res->kommentar?>
        </div>
    </div>
    <br>Kvalitet (poäng på inlägg)
    <div class="stapelgrund">
        <div class="stapeltext">
            Frågor
        </div>
        <div class="stapel" style="width: <?=max90(5*$res->rfraga)?>%;">
            <?=$res->rfraga?>
        </div>
    </div>

    <div class="stapelgrund">
        <div class="stapeltext">
            Svar
        </div>
        <div class="stapel" style="width: <?=max90(5*$res->rsvar)?>%;">
            <?=$res->rsvar?>
        </div>
    </div>

    <div class="stapelgrund">
        <div class="stapeltext">
            Kommentar
        </div>
        <div class="stapel" style="width: <?=max90(5*$res->rkommentar)?>%;">
            <?=$res->rkommentar?>
        </div>
    </div>


        <br>Sammantaget rykte (beräknat enligt hemlig formel)
    <div class="stapelgrund">
        <div class="stapeltext">
            Rykte
        </div>
        <div class="stapel" style="width: <?=max90(3*$rank)?>%;">
            <?=$rank?>
        </div>
    </div>


</div>
(staplarna har sinsemellan olika skalor)


</article>
