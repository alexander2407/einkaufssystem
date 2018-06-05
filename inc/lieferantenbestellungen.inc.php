<?php
//echo 'amk';
if (!empty($_GET['loeschen'])) {
    $db = new DB();
    $db->deleteBestellung($_GET['loeschen']);//löschen funktioniert
}

if (!isset($_GET['detail']) && !isset($_GET['aendern']) && !isset($_GET['neueBestellung']) && !isset($_GET['offeneBestellungen'])) {

    echo "<div><a class='btn btn-default' href='index.php?neueBestellung=TRUE' role='button'>Bestellung anlegen</a> &ensp;"
    . "<a class='btn btn-default' href='index.php?offeneBestellungen=TRUE' role='button'>offene Bestellungen anzeigen</a></div><br>";

    $db = new DB();
    $bestellung = $db->getLieferantenbestellungen();

    echo "<div>";
    echo '<table class="table table-striped">';
    echo "<tr><th>BestellungsID</th><th>LieferantID</th><th>Name</th><th>Zahlungsmethode</th></tr>";

    foreach ($bestellung as $b) {
        echo "<tr>";
        echo "<td>" . $b->getLieferantenbestellungsId() . "</td>";
        echo "<td>" . $b->getLieferantId() . "</td>";
        echo "<td>" . $b->getLieferantName() . "</td>";
        echo "<td>" . $b->getZahlungsmethode() . "</td>";
        echo "<td><a href='index.php?detail=" . $b->getLieferantenbestellungsId() . "'>Detail</a></td>";
        echo "<td><a href='index.php?loeschen=" . $b->getLieferantenbestellungsId() . "'>Löschen</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
} else if (isset($_GET['detail'])) {
    $db = new DB();
    $id = $_GET['detail'];
    $bestellung = $db->getLieferantenbestellung($id);
    //$lieferant = $db->getLieferant($id); //$id ist die id von der Lieferantenbestellung
    ?>

<h3>Bestellungen</h3>

    <br>
    <a class="btn btn-default" href="index.php?aendern=<?php echo $id; ?>">Bearbeiten</a>
    <br>
    <br>
    <form class="form-horizontal">
        <div class="form-group">
            <label for="lieferantenbestellungsid" class="col-sm-2 control-label">LieferantenBestelungsID</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $bestellung->getLieferantenbestellungsId(); ?>" name="lieferantenbestellungsid" class="form-control" id="lieferantenbestellungsid" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="lieferantenid" class="col-sm-2 control-label">LieferantID</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $bestellung->getLieferantId(); ?>" name="lieferantenid" class="form-control" id="lieferantenid" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="lieferantname" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $bestellung->getLieferantName(); ?>" name="lieferantname" class="form-control" id="lieferantname" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="bestellschein" class="col-sm-2 control-label">Bestellschein</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $bestellung->getBestellschein(); ?>" name="bestellschein" class="form-control" id="bestellschein" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="zahlungsmethodeid" class="col-sm-2 control-label">ZahlungsmethodeID</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $bestellung->getZahlungsmethodeId(); ?>" name="zahlungsmethodeid" class="form-control" id="zahlungsmethodeid" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="zahlungsmethode" class="col-sm-2 control-label">Zahlungsmethode</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $bestellung->getZahlungsmethode(); ?>" name="zahlungsmethode" class="form-control" id="zahlungsmethode" readonly="">
            </div>
        </div>
        
    </form>
    
<?php
}else if (isset($_GET['offeneBestellungen'])) {
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
}
?>



