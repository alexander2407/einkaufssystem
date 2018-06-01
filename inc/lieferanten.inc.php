<?php


if (!isset($_GET['aendern'])) {
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
        echo "<td><a href='index.php?aendern=" . $lieferant->getLieferantenId() . "'>Ändern</a></td>";
        echo "<td><a href='index.php?loeschen=" . $lieferant->getLieferantenId() . "'>Deaktivieren</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
} else {
    $db = new DB();
    $lieferant = $db->getLieferant($_GET['aendern']);
    ?>

    <form class="form-horizontal">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Telefonnummer</label>
            <div class="col-sm-10">
                <input type="number" name="telefonnummer" class="form-control" id="inputEmail3" placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Strasse</label>
            <div class="col-sm-10">
                <input type="text" name="strasse" class="form-control" id="inputEmail3" placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">PLZ</label>
            <div class="col-sm-10">
                <input type="number" name="plz" class="form-control" id="inputEmail3" placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Ort (ID eingeben)</label>
            <div class="col-sm-10">
                <input type="text" name="ort" class="form-control" id="inputEmail3" placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Land (ID eingeben)</label>
            <div class="col-sm-10">
                <input type="text" name="land" class="form-control" id="inputEmail3" placeholder="Email">
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Änderungen übernehmen</button>
            </div>
        </div>
    </form>
    <?php
}
?>


