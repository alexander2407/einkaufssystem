<?php
$db = new DB();

if (isset($_GET['artikel']) && isset($_GET['menge'])) {
    $artikelId = $_GET['artikel'];
    $menge = $_GET['menge'];
    $zahlungsmethodeId = $db->getFirstZahlungsmethodeId();
    $lieferantId = $db->getFirstLieferantIdToArtikel($artikelId);
    $artikel = $db->getArtikelWithId($artikelId);

    $newBestellung = new Lieferantenbestellung(null, $lieferantId, null, $zahlungsmethodeId, null, false);
    $lieferantenbestellungsId = $db->insertLieferantenbestellung($newBestellung);
    if ($lieferantenbestellungsId != null) {
        $lieferantenartikel = new Lieferantenartikel($lieferantenbestellungsId, null, $artikelId, null, $lieferantId, null, $menge);
        $val = $db->insertLieferantenartikel($lieferantenartikel);
        if ($val) {
            echo "<div class='alert alert-success' role='alert'>Lieferantenbestellung für Artikel " . $artikel->getArtikelname() . " mit ID " . $artikel->getArtikelId() . " wurde erfolgreich angelegt. Nachbestellte Menge:" . $menge . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Lieferantenbestellung für Artikel " . $artikel->getArtikelname() . " mit ID " . $artikel->getArtikelId() . " konnte nicht angelegt werden. Es gibt keinen Lieferanten für diesen Artikel</div>";
    }
}

$artikelUnterBestand = $db->getArtikelUnterMindestbestand();

if (count($artikelUnterBestand) > 0) {
    foreach ($artikelUnterBestand as $artikel) {
        if ($db->countOffeneBestellungenToArtikel($artikel) == 0) {
            $menge = $artikel->getMindestbestand() - $artikel->getLagerstand();
            echo "<div class='alert alert-danger' role='alert'><b>Artikel " . $artikel->getArtikelname() . " mit ID " . $artikel->getArtikelId() . "</b> hat Mindestbestand unterschritten! Nachzubestellende Menge:" . $menge . "<br><a href='index.php?artikel=" . $artikel->getArtikelId() . "&menge=$menge'>Lieferantenbestellung erzeugen</a></div>";
        }
        else{
            echo "<div class='alert alert-warning' role='alert'><b>Artikel " . $artikel->getArtikelname() . " mit ID " . $artikel->getArtikelId() . "</b> hat Mindestbestand unterschritten! Es liegt eine offene Lieferantenbestellung zu diesem Artikel vor.</div>";
        }
    }
} else {
    ?>
    <div class="alert alert-success" role="alert">Alle Artikel über Mindestbestand!</div>
    <?php
}
?>
