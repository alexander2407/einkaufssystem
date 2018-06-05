<?php
$db = new DB();
$artikelUnterBestand = $db->getArtikelUnterMindestbestand();

if (count($artikelUnterBestand) > 0) {
    foreach ($artikelUnterBestand as $artikel) {
        echo "<div class='alert alert-danger' role='alert'>Artikel ".$artikel->getArtikelname()." mit ID ".$artikel->getArtikelId()." hat Mindestbestand unterschritten</div>";
    }
    
} else {
    ?>
    <div class="alert alert-success" role="alert">Alle Artikel über Mindestbestand!</div>
    <?php
}
?>
