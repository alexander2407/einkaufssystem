<?php
if (!empty($_GET['loeschen'])) {
    $db = new DB();
    $db->setLieferantInaktiv($_GET['loeschen']);
}

if (!empty($_GET['aktivieren'])) {
    $db = new DB();
    $db->setLieferantAktiv($_GET['aktivieren']);
}

if (!isset($_GET['detail']) && !isset($_GET['aendern']) && !isset($_GET['neuerLieferant'])) {

    echo "<div><a class='btn btn-default' href='index.php?neuerLieferant=TRUE' role='button'>Lieferanten anlegen</a></div><br>";

    $db = new DB();
    $lieferanten = $db->getLieferanten();

    echo "<div>";
    echo '<table class="table table-striped">';
    echo "<tr><th>ID</th><th>Name</th><th>Telefonnummer</th><th>Strasse</th><th>Hausnummer</th><th>PLZ</th><th>Ort</th><th>Land</th><th>aktiv</th></tr>";

    foreach ($lieferanten as $lieferant) {
        if ($lieferant->getAktiv() == 1) {
            echo "<tr>";
        } else {
            echo "<tr style='background-color: #ff4d4d'>";//ein bissl heller is lesbarer
        }
        echo "<td>" . $lieferant->getLieferantId() . "</td>";
        echo "<td>" . $lieferant->getName() . "</td>";
        echo "<td>" . $lieferant->getTelefonnummer() . "</td>";
        echo "<td>" . $lieferant->getStrasse() . "</td>";
        echo "<td>" . $lieferant->getHausnummer() . "</td>";
        echo "<td>" . $lieferant->getPlz() . "</td>";
        echo "<td>" . $lieferant->getOrt() . "</td>";
        echo "<td>" . $lieferant->getLand() . "</td>";
        $aktivText;
        if ($lieferant->getAktiv() == 1) {
            $aktivText = "Ja";
        } else {
            $aktivText = "Nein";
        }
        echo "<td>" . $aktivText . "</td>";
        echo "<td><a href='index.php?detail=" . $lieferant->getLieferantId() . "'>Detail</a></td>";
        if ($lieferant->getAktiv() == 1) {
            echo "<td><a href='index.php?loeschen=" . $lieferant->getLieferantId() . "'>Deaktivieren</a></td>";
        } else {
            echo "<td><a href='index.php?aktivieren=" . $lieferant->getLieferantId() . "'>Aktivieren</a></td>";
        }
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
} else if (isset($_GET['detail'])) {
    $db = new DB();
    $id = $_GET['detail'];
    $lieferant = $db->getLieferant($id);
    $artikelliste = $db->getArtikelByLieferant($id);
    ?>

    <h3>Lieferantendetails</h3>
    <br>
    <a class="btn btn-default" href="index.php?aendern=<?php echo $id; ?>">Bearbeiten</a>
    <br>
    <br>
    <form class="form-horizontal">
        <h4>Allgemein</h4>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getName(); ?>" name="name" class="form-control" id="name" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="tel" class="col-sm-2 control-label">Telefonnummer</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getTelefonnummer(); ?>" name="telefonnummer" class="form-control" id="tel" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="aktiv" class="col-sm-2 control-label">Aktiv</label>
            <div class="col-sm-10">
                <input type="text" value="<?php
                if ($lieferant->getAktiv()) {
                    echo "Ja";
                } else {
                    echo "Nein";
                }
                ?>" name="telefonnummer" class="form-control" id="aktiv" readonly="">
            </div>
        </div>
        <br>
        <h4>Adresse</h4>
        <div class="form-group">
            <label for="strasse" class="col-sm-2 control-label">Strasse</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getStrasse(); ?>" name="strasse" class="form-control" id="strasse" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="hausnummer" class="col-sm-2 control-label">Hausnummer</label>
            <div class="col-sm-10">
                <input type="number" value="<?php echo $lieferant->getHausnummer(); ?>" name="hausnummer" class="form-control" id="hausnummer" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="plz" class="col-sm-2 control-label">PLZ</label>
            <div class="col-sm-10">
                <input type="number" value="<?php echo $lieferant->getPlz(); ?>" name="plz" class="form-control" id="plz" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="ort" class="col-sm-2 control-label">Ort</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getOrt(); ?>" name="ort" class="form-control" id="ort" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="land" class="col-sm-2 control-label">Land Kennzeichen</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getLand() . " " . $lieferant->getLand_kennzeichen(); ?>" name="land" class="form-control" id="land" readonly="">
            </div>
        </div>
        <br>
        <h4>Zahlungsbedingungen</h4>
        <div class="form-group">
            <label for="skonto" class="col-sm-2 control-label">Skonto</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getSkonto() . "%"; ?>" name="skonto" class="form-control" id="skonto" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="rabatt" class="col-sm-2 control-label">Rabatt</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getRabatt() . "%"; ?>" name="rabatt" class="form-control" id="rabatt" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="zahlungsziel" class="col-sm-2 control-label">Zahlungsziel</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getZahlungsziel() . " Tage"; ?>" name="zahlungsziel" class="form-control" id="land" readonly="">
            </div>
        </div>
        <br>
        <h4>Lieferbedingungen</h4>
        <div class="form-group">
            <label for="lf" class="col-sm-2 control-label">Lieferkosten</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getLieferkosten() . "€"; ?>" name="lieferkosten" class="form-control" id="lf" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="incoterms" class="col-sm-2 control-label">Incoterms</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getIncoterms(); ?>" name="incoterms" class="form-control" id="incoterms" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="transportart" class="col-sm-2 control-label">Transportart</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getTransportart(); ?>" name="transportart" class="form-control" id="transportart" readonly="">
            </div>
        </div>
        <br>
        <h4>Kontaktperson</h4>
        <div class="form-group">
            <label for="vorname" class="col-sm-2 control-label">Vorname</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getKontakt_vorname(); ?>" name="vorname" class="form-control" id="vorname" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="nachname" class="col-sm-2 control-label">Nachname</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getKontakt_nachname(); ?>" name="nachname" class="form-control" id="nachname" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="kontakt_tel" class="col-sm-2 control-label">Telefonnummer</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getKontakt_telefonnummer(); ?>" name="kontakt_tel" class="form-control" id="kontakt_tel" readonly="">
            </div>
        </div>
        <br>
        <h4>Angebotene Artikel</h4>
        <?php
        if (count($artikelliste) > 0) {
            foreach ($artikelliste as $value) {
                ?>
                <div class="form-group">
                    <label for="artikelid" class="col-sm-2 control-label">ArtikelID</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $value->getArtikelId() ?>" name="artikelid" class="form-control" id="artikelid" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="artikelname" class="col-sm-2 control-label">Artikelname</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $value->getArtikelname() ?>" name="artikelname" class="form-control" id="artikelname" readonly="">
                    </div>
                </div>
                <br>
                <?php
            }
        } else {
            echo '<p>Zu diesem Lieferanten gibt es keine Artikel.</p>';
        }
        ?>
    </form>

    <?php
} else if (isset($_GET['aendern'])) {
    $db = new DB();
    $id = $_GET['aendern'];
    $lieferant = $db->getLieferant($id);
    ?>
    <h3>Lieferanten ändern</h3>
    <br>

    <form class="form-horizontal" method="POST" action="index.php?lieferantAendern=TRUE">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getName(); ?>" name="name" class="form-control" id="inputEmail3" >
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Telefonnummer</label>
            <div class="col-sm-10">
                <input type="number" value="<?php echo $lieferant->getTelefonnummer(); ?>" name="telefonnummer" class="form-control" id="inputEmail3" >
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Strasse</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getStrasse(); ?>" name="strasse" class="form-control" id="inputEmail3" >
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Hausnummer</label>
            <div class="col-sm-10">
                <input type="number" value="<?php echo $lieferant->getHausnummer(); ?>" name="hausnummer" class="form-control" id="inputEmail3" >
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">PLZ</label>
            <div class="col-sm-10">
                <input type="number" value="<?php echo $lieferant->getPlz(); ?>" name="plz" class="form-control" id="inputEmail3">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Ort (ID eingeben)</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getOrtId(); ?>" name="ort" class="form-control" id="inputEmail3">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Land (ID eingeben)</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $lieferant->getLandId(); ?>" name="land" class="form-control" id="inputEmail3">
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Änderungen übernehmen</button>
            </div>
        </div>
    </form>
    <?php
} else if(isset($_GET['neuerLieferant'])) {
    echo "<h3>Neuen Lieferanten anlegen</h3><br>";
    include './lieferantAnlegen.inc.php';
}
?>


