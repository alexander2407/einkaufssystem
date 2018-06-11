<?php
//echo 'amk';


    $db = new DB();
    $offeneBestellung = $db->getOffeneBestellungen();

    echo "<div>";
    echo '<table class="table table-striped">';
    echo "<tr><th>BestellungsID</th><th>LieferantID</th><th>Name</th><th>Zahlungsmethode</th></tr>";

    foreach ($offeneBestellung as $b) {
        echo "<tr>";
        echo "<td>" . $b->getLieferantenbestellungsId() . "</td>";
        echo "<td>" . $b->getLieferantId() . "</td>";
        echo "<td>" . $b->getLieferantName() . "</td>";
        echo "<td>" . $b->getZahlungsmethode() . "</td>";
        if ($b->getAbgeschlossen() == 1) {
            echo "<td>" . "Ja" . "</td>";
        } else {
            echo "<td>" . "Nein" . "</td>";
        }
        //echo "<td>" . $b->getAbgeschlossen() . "</td>";
        echo "<td><a href='index.php?detail=" . $b->getLieferantenbestellungsId() . "'>Detail</a></td>";
        echo "<td><a href='index.php?loeschen=" . $b->getLieferantenbestellungsId() . "'>Löschen</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";

    ?>