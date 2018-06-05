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
        echo "<td>" . $art->getAufschlag() * 100 . " %" . "</td>";
        echo "<td><a href='index.php?detail=" . $art->getArtikelId() . "'>Detail</a></td>";
        echo "<td><a href='index.php?loeschen=" . $art->getArtikelId() . "'>Löschen</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
} else if (isset($_GET['detail'])) {
    $db = new DB();
    $id = $_GET['detail'];
    $artikel = $db->getArtikelWithId($id);
    $lieferantenliste = $db->getLieferantByArtikel($id);
    ?>

    <h3>Artikeldetails</h3>
    <br>
    <a class="btn btn-default" href="index.php?aendern=<?php echo $id; ?>">Bearbeiten</a>
    <br>
    <br>
    <form class="form-horizontal">
        <div class="form-group">
            <label for="artikelname" class="col-sm-2 control-label">Artikelname</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $artikel->getArtikelname(); ?>" name="artikelname" class="form-control" id="artikelname" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="einkaufspreis" class="col-sm-2 control-label">Einkaufspreis</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $artikel->getEinkaufspreis() . " €"; ?>" name="einkaufspreis" class="form-control" id="einkaufspreis" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="verkaufspreis" class="col-sm-2 control-label">Verkaufspreis</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $artikel->getVerkaufspreis() . " €"; ?>" name="verkaufspreis" class="form-control" id="verkaufspreis" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="mindestbestand" class="col-sm-2 control-label">Mindestbestand</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $artikel->getMindestbestand(); ?>" name="mindestbestand" class="form-control" id="mindestbestand" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="lagerverfuegbar" class="col-sm-2 control-label">Lagerstand Verfügbar</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $artikel->getLagerstandVerfuegbar(); ?>" name="lagerverfuegbar" class="form-control" id="lagerverfuegbar" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="lageraktuell" class="col-sm-2 control-label">Lagerstand Aktuell</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $artikel->getLagerstandAktuell(); ?>" name="lageraktuell" class="form-control" id="lageraktuell" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="aufschlag" class="col-sm-2 control-label">Aufschlag</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $artikel->getAufschlag() * 100 . " %"; ?>" name="aufschlag" class="form-control" id="aufschlag" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="aufschlag" class="col-sm-2 control-label">Lagerartikel</label>
            <div class="col-sm-10">
                <input type="text" value="<?php if ($artikel->getMindestbestand() == 0) {
        echo 'Nein';
    } else {
        echo 'Ja';
    } ?>" name="aufschlag" class="form-control" id="aufschlag" readonly="">
            </div>
        </div>
        <h4>Lieferanten die diesen Artikel liefern</h4>
    <?php
    if (count($lieferantenliste) > 0) {
        foreach ($lieferantenliste as $value) {
            ?>
                <div class="form-group">
                    <label for="lieferantid" class="col-sm-2 control-label">LieferantId</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $value->getLieferantId() ?>" name="lieferantid" class="form-control" id="lieferantid" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lieferantname" class="col-sm-2 control-label">Lieferantname</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $value->getLieferantname() ?>" name="lieferantname" class="form-control" id="lieferantname" readonly="">
                    </div>
                </div>
                <br>
                <?php
            }
        } else {
            echo '<p>Zu diesem Artikel gibt es keine Lieferanten.</p>';
        }
        ?>
    </form>

    <?php
}
?>