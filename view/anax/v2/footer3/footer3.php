<?php
namespace Anax\View;

if (null==($this->di->session->get("anvandarnamn"))) { ?>
        <p>Du är inte inloggad</p>


        <div id="loginknapp" class="uppeinavbaren"> <i class="fa fa-sign-in-alt" aria-hidden="true"></i> Logga in</div>
<?php
} else {
?>
        <p>Du är inloggad som <b><?= $this->di->session->get("anvandarnamn") ?></b></p>
        <div class="uppeinavbaren">
            <a href="<?=url("minsida")?>" class="notextdec" >
                <img   src='https://www.gravatar.com/avatar/<?php echo(md5(strtolower(trim($this->di->session->get("email"))))) ?>?s=40&d=mp'>
            </a>

            <a href='<?=url("inlogg/loggaut")?>' class="logutknapp upplite">&nbsp; Logga ut  &nbsp; <i class="fa fa-sign-out-alt" aria-hidden="true"></i></a></div>

<?php
}
?>



<div id="inmatalosen" class="osynlig inmatning">

    <div id="inloggnings-topp-rad">
        &nbsp;INLOGGING
        <div id="stang" class="stangkryss">
            &#10060;
        </div>
    </div>


<div class="padding">



    <form method="post" action='<?=url("inlogg/loggain")?>'>
        <br>Användarnamn:<br>
        <input id="anvandarnamn" type="text" name="anvandarnamn"><br>
        <br>Lösenord:<br>
        <input id="losen" type="password" name="losen"><br>
        <br>Email:* <br>
        <input id="email" type="text" name="email"><br>

        <br>
        <input class="button loginknapp" name="loggain" type="submit" value="Logga in" id="doit">

        <input class="button nyanvandarknapp" name="nyanvandare" type="submit" value="Skapa ny användare" id="doit">
        <br> &nbsp;
        <br>(*anges endast vid ny användare)
    </form>
</div>

</div>


<script>
    var loginknapp = window.document.getElementById("loginknapp");

    if (loginknapp != null) {
        loginknapp.addEventListener("click", function() {
            window.document.getElementById("inmatalosen").classList.remove("osynlig");
        });
    }

    var stang = window.document.getElementById("stang");

    stang.addEventListener("click", function() {
        window.document.getElementById("inmatalosen").classList.add("osynlig");
    });
</script>
