<?php

if (!empty($_GET['loeschen'])) {
    $db = new DB();
    $db->deleteArtikel($_GET['loeschen']);
}

if (!isset($_GET['detail']) && !isset($_GET['aendern']) && !isset($_GET['neuerArtikel'])) {

    echo "<div><a class='btn btn-default' href='index.php?neuerArtikel=TRUE' role='button'>Artikel anlegen</a></div><br>";

    $db = new DB();
    $artikel = $db->getArtikel();

    echo "<div>";
    echo '<table class="table table-striped">';
    echo "<tr><th>ID</th><th>Name</th><th>Einkaufspreis</th><th>Verkaufspreis</th><th>Mindestbestand</th><th>Verfügbar</th><th>Lagerbestand</th><th>Aufschlag</th></tr>";

    foreach ($artikel as $art) {
            echo "<tr>";
            echo "<td>" . $art->getArtikelId() . "</td>";
            echo "<td>" . $art->getArtikelname() . "</td>";
            echo "<td>" . $art->getEinkaufspreis() . "</td>";
            echo "<td>" . $art->getVerkaufspreis() . "</td>";
            echo "<td>" . $art->getMindestbestand() . "</td>";
            echo "<td>" . $art->getLagerstandVerfuegbar() . "</td>";
            echo "<td>" . $art->getLagerstandAktuell() . "</td>";
            echo "<td>" . $art->getAufschlag()*100 . " %" . "</td>";
            echo "<td><a href='index.php?aendern=" . $art->getArtikelId() . "'>Bearbeiten</a></td>";
            echo "<td><a href='index.php?loeschen=" . $art->getArtikelId() . "'>Löschen</a></td>";
            echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
}
