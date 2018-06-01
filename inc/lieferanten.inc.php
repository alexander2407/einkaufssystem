<?php

include '../utility/DB.class.php';
$db = new DB();
$lieferanten = $db->getLieferanten();

echo "<div>";
echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Telefonnummer</th><th>Strasse</th><th>PLZ</th><th>Ort</th><th>Land</th><th>aktiv</th></tr>";

foreach ($lieferanten as $lieferant) {
    echo "<tr>";
    echo "<td>" . $lieferant->getLieferantenId() . "</td>";
    echo "<td>" . $lieferant->getName() . "</td>";
    echo "<td>" . $lieferant->getTelefonnummer() . "</td>";
    echo "<td>" . $lieferant->getStrasse() . "</td>";
    echo "<td>" . $lieferant->getPlz() . "</td>";
    echo "<td>" . $lieferant->getOrt() . "</td>";
    echo "<td>" . $lieferant->getLand() . "</td>";
    echo "<td>" . $lieferant->getAktiv() . "</td>";
    echo "<td><a href='index.php?aendern=".$lieferant->getLieferantenId()."'>Ändern</a></td>";
    echo "<td><a href='index.php?loeschen=".$lieferant->getLieferantenId()."'>Deaktivieren</a></td>";
    echo "</tr>";
}

echo "</table>";
echo "</div>";
?>


