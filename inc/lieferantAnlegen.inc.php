<?php
$db = new DB();

if (isset($_GET['neuerLieferant'])) {
    ?>
    <h3>Neuen Lieferanten anlegen</h3>
    <br>
    <form class="form-horizontal" method="POST" action="index.php">
        <div class="form-group">
            <label for="lieferantenname" class="col-sm-2 control-label">Lieferantenname</label>
            <div class="col-sm-10">
                <input type="text" name="lieferantenname" class="form-control" id="lieferantenname"  required="" >
            </div>
        </div>
        <div class="form-group">
            <label for="telefonnummer" class="col-sm-2 control-label">Telefonnummer</label>
            <div class="col-sm-10">
                <input type="text"  name="telefonnummer" class="form-control" id="telefonnummer"  required="">
            </div>
        </div>
        <div class="form-group">
            <label for="zahlungsbedingungen" class="col-sm-2 control-label">Zahlungsbedingungen</label>
            <div class="col-sm-10">
                <?php
                $zahlungsbedingungen = $db->getZahlungsbedingungen();
                echo '<select class="form-control" id="zahlungsbedingungen" name="zahlungsbedingungen">';
                foreach ($zahlungsbedingungen as $value) {
                    ?>
                    <option value="<?php echo $value->getZahlungsbedingungenId(); ?>">
                        <?php
                        $skonto = 0;
                        $rabatt = 0;
                        $zahlungsziel = 0;
                        if ($value->getSkonto() != null) {
                            $skonto = $value->getSkonto();
                        }
                        if ($value->getRabatt() != null) {
                            $rabatt = $value->getRabatt();
                        }
                        if ($value->getZahlungszieltage() != null) {
                            $zahlungsziel = $value->getZahlungszieltage();
                        }
                        echo 'Skonto: ' . $skonto . ', Rabatt: ' . $rabatt . ", Zahlungsziel: " . $zahlungsziel . " Tage";
                        ?>
                    </option>
                    <?php
                }
                echo '</select>';
                ?>
            </div>
        </div>
        <div class="form-group">
            <label for="lieferbedingungen" class="col-sm-2 control-label">Lieferbedingungen</label>
            <div class="col-sm-10">
                <?php
                $lieferbedingungen = $db->getLieferbedingungen();
                echo '<select class="form-control" id="lieferbedingungen" name="lieferbedingungen">';
                foreach ($lieferbedingungen as $value) {
                    ?>
                    <option value="<?php echo $value->getLieferbedingungenId(); ?>">
                        <?php
                        $kosten = 0;
                        if ($value->getKosten() != null) {
                            $kosten = $value->getKosten();
                        }
                        echo 'Kosten: ' . $kosten . ', Incoterms: ' . $value->getIncoterms() . ", Transportart: " . $value->getTransportart();
                        ?>
                    </option>
                    <?php
                }
                echo '</select>';
                ?>
            </div>
        </div>
        <div class="form-group">
            <label for="strasse" class="col-sm-2 control-label">Strasse</label>
            <div class="col-sm-10">
                <input type="text"  name="strasse" class="form-control" id="strasse"  required="">
            </div>
        </div>
        <div class="form-group">
            <label for="hausnummer" class="col-sm-2 control-label">Hausnummer</label>
            <div class="col-sm-10">
                <input type="number" min="1" name="hausnummer" class="form-control" id="hausnummer"  required="">
            </div>
        </div>
        <div class="form-group">
            <label for="ort" class="col-sm-2 control-label">Ort</label>
            <div class="col-sm-10">
                <?php
                $orte = $db->getOrt();
                echo '<select class="form-control" id="ort" name="ort">';
                foreach ($orte as $value) {
                    ?>
                    <option value="<?php echo $value->getOrtId(); ?>">
                        <?php
                        echo 'PLZ: ' . $value->getPlz() . ', ' . $value->getBezeichnung() . ", Land: " . $value->getLandKennzeichen() . " " . $value->getLandBezeichnung();
                        ?>
                    </option>
                    <?php
                }
                echo '</select>';
                ?>
            </div>
        </div>
        <h4>Kontaktperson-Daten</h4>
        <div class="form-group">
            <label for="vorname" class="col-sm-2 control-label">Vorname</label>
            <div class="col-sm-10">
                <input type="text"  name="vorname" class="form-control" id="vorname"  required="">
            </div>
        </div>
        <div class="form-group">
            <label for="nachname" class="col-sm-2 control-label">Nachname</label>
            <div class="col-sm-10">
                <input type="text"  name="nachname" class="form-control" id="nachname"  required="">
            </div>
        </div>
        <div class="form-group">
            <label for="telefonnummer" class="col-sm-2 control-label">Telefonnummer</label>
            <div class="col-sm-10">
                <input type="text"  name="telefonnummer" class="form-control" id="telefonnummer"  required="">
            </div>
        </div>
        <br>
        <h4>Artikel des Lieferanten</h4>
        <?php
        $artikel = $db->getArtikel();
        foreach ($artikel as $value) {
            ?>
            <div class="form-group">
                <label for="artikel<?php echo $value->getArtikelId(); ?>" class="col-sm-2 control-label"><?php echo $value->getArtikelname(); ?></label>
                <div class="col-sm-10">
                    <input type="checkbox" 
                           value="<?php echo $value->getArtikelId(); ?>" 
                           name="<?php echo $value->getArtikelId(); ?>" 
                           class="form-control" 
                           id="artikel<?php echo $value->getArtikelId(); ?>">
                </div>
            </div>
            <?php
        }
        ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" name="submit_anlegen">Lieferant anlegen</button>
            </div>
        </div>

    </form>
    <?php
} 
?>

