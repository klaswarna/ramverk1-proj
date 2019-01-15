<?php
namespace Anax\View;

$base=$this->di->request->getBaseUrl();
$end=$this->di->request->getCurrentUrl();
$retursida= url() . str_replace($base, "", $end);

?>




<form id="frageform" action='<?=url("inlagg/postafraga")?>' method="post">
<div class="nyfraga">
<h2>Skriv ny fråga</h2>
<input onfocus="sudda(this);" type="text" name="title" value="Skriv titel här..."><br><br>
    <textarea onfocus="sudda(this);" form="frageform" name="data">Skriv din fråga här...</textarea>
<br>Koppla befintliga taggar:<br>
<div class="klicktaggarna">
<?php foreach ($alltags as $key => $tag) { ?>
    <input type="checkbox" name="tag[]" value="<?=$key + 1?>"><div class="taggruta"><?=$tag->tagg?></div>
<?php } ?>
</div>


<input type="hidden" name="retursida" value="<?=$retursida?>">
<br><br>Lägg till helt nya taggar, separera med kommatecken:<br>
<input type="text" name="nyataggar">
<br><br>
<input type="submit" value="Posta fråga">
</div>
</form>

<script>
    function sudda(element) {
        if (element.value == 'Skriv din fråga här...' || element.value == 'Skriv titel här...') {
            element.value = '';
        }
    }
</script>
