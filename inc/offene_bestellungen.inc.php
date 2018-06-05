<?php
//echo 'amk';


    $db = new DB();
    $offeneBestellung = $db->getOffeneBestellungen();

    echo "<div>";
    echo '<table class="table table-striped">';
    echo "<tr><th>BestellungsID</th><th>LieferantID</th><th>Name</th><th>Zahlungsmethode</th></tr>";

    foreach ($offeneBestellung as $ob) {
        echo "<tr>";
        echo "<td>" . $ob->getLieferantenbestellungsId() . "</td>";
        echo "<td>" . $ob->getLieferantId() . "</td>";
        echo "<td>" . $ob->getLieferantName() . "</td>";
        echo "<td>" . $ob->getZahlungsmethode() . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";

    ?>