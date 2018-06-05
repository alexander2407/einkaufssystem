<?php
$db = new DB();
$artikelUnterBestand = $db->getArtikelUnterMindestbestand();

if (count($artikelUnterBestand) > 0) {
    foreach ($artikelUnterBestand as $artikel) {
        $menge = $artikel->getMindestbestand() - $artikel->getLagerstandVerfuegbar();
        echo "<div class='alert alert-danger' role='alert'>Artikel <b>".$artikel->getArtikelname()."</b> mit ID <b>".$artikel->getArtikelId()."</b> hat Mindestbestand unterschritten! Nachzubestellende Menge:".$menge."</div>";
    }
    
} else {
    ?>
    <div class="alert alert-success" role="alert">Alle Artikel über Mindestbestand!</div>
    <?php
}
?>
