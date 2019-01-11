<?php
namespace KW\Inlagg;

$textFilter = new TextFilter();


namespace Anax\View;

if (null==($this->di->session->get("anvandarnamn"))) { ?>
<h1>Du måste vara inloggad för att nå denna sida!<br><br><br><br><br></h1>

<?php } else {?>





<h1>Välkommen <?=$this->di->session->get("anvandarnamn")?> </h1>

<img   src='https://www.gravatar.com/avatar/<?php echo(md5(strtolower(trim($this->di->session->get("email"))))) ?>?s=150&d=mp'>


<p>Din epost: <?=$this->di->session->get("email")?></p>

<div id="epostknapp" class="knapplank"><p>Ändra epost <i class="fa fa-pencil-alt" aria-hidden="true"></i></p></div>
<form class="osynlig ram" id="epostformular" method="post">
    Skriv en ny <b>epostadress</b> nedan
    <br><input type="text" name="epost">
    <br><input type="submit" name="knapp" value="Spara ny epostadress">
</form>



<div id="losenknapp" class="knapplank"><p><i class="far fa-edit-alt" aria-hidden="true"></i>Ändra lösenord <i class="fa fa-pencil-alt" aria-hidden="true"></i></p></div>
<form class="osynlig ram" id="losenformular" method="post">
    Skriv ett nytt <b>lösenord</b> nedan
    <br><input type="text" name="losenord">
    <br><input type="submit" name="knapp" value="Spara nytt lösenord">
</form>
</div>

<script>
var epostformular=document.getElementById("epostformular")
var epostknapp=document.getElementById("epostknapp").addEventListener("click", function(){
    epostformular.classList.toggle("osynlig");
});

var losenformular=document.getElementById("losenformular")
var losenknapp=document.getElementById("losenknapp").addEventListener("click", function(){
    losenformular.classList.toggle("osynlig");

})

</script>






<?php } ?>
