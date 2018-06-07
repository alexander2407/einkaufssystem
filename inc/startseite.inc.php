<?php
$db = new DB();

if(isset($_GET['artikel']) && isset($_GET['menge'])){
    $artikelId = $_GET['artikel'];
    $menge = $_GET['menge'];
    $zahlungsmethodeId = $db->getFirstZahlungsmethodeId();
    $lieferantId = $db->getFirstLieferantIdToArtikel($artikelId);
    
    $newBestellung = new Lieferantenbestellung(null, $lieferantId, null, $zahlungsmethodeId, null, false);
    $lieferantenbestellungsId = $db->insertLieferantenbestellung($newBestellung);
    $lieferantenartikel = new Lieferantenartikel($lieferantenbestellungsId, null, $artikelId, null, $lieferantId, null, $menge);
    $val = $db->insertLieferantenartikel($lieferantenartikel);
    $artikel = $db->getArtikelWithId($artikelId);
    if($val){
        echo "<div class='alert alert-success' role='alert'>Bestellung für Artikel ".$artikel->getArtikelname()." mit ID ".$artikel->getArtikelId()." wurde erfolgreich angelegt. Nachbestellte Menge:".$menge."</div>";
    }
}

$artikelUnterBestand = $db->getArtikelUnterMindestbestand();

if (count($artikelUnterBestand) > 0) {
    foreach ($artikelUnterBestand as $artikel) {
        $menge = $artikel->getMindestbestand() - $artikel->getLagerstand();
        echo "<div class='alert alert-danger' role='alert'><b>Artikel ".$artikel->getArtikelname()." mit ID ".$artikel->getArtikelId()."</b> hat Mindestbestand unterschritten! Nachzubestellende Menge:".$menge."<br><a href='index.php?artikel=".$artikel->getArtikelId()."&menge=$menge'>Lieferantenbestellung erzeugen</a></div>";
  
    }
    
} else {
    ?>
    <div class="alert alert-success" role="alert">Alle Artikel über Mindestbestand!</div>
    <?php
}
?>
