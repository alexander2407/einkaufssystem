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
            echo '<select class="form-control" id="zahlungsbedingungen">';
            foreach ($zahlungsbedingungen as $value) {
                ?>
            <option value="<?php echo $zahlungsbedingungen->getZahlungsbedingungenId(); ?>">
            <?php
                echo 'Skonto: '.$zahlungsbedingungen->getSkonto().', Rabatt: '.$zahlungsbedingungen->getRabatt().", Zahlungsziel: ".$zahlungsbedingungen->getZahlungszieltage();
            ?>
            </option>
            <?php
            }
            echo '</select>';
            ?>
        </div>
    </div>
    <!--<div class="form-group">
        <label for="aufschlag" class="col-sm-2 control-label">Aufschlag</label>
        <div class="col-sm-10">
            <input type="text" name="aufschlag" class="form-control" id="aufschlag" required="">
        </div>
    </div>-->
    <!--<div class="form-group">
        <label for="lagerstand" class="col-sm-2 control-label">Lagerstand</label>
        <div class="col-sm-10">
            <input type="text" name="lagerstand" class="form-control" id="lagerstand" required="">
        </div>
    </div>-->
    <div class="form-group">
        <label for="lagerort" class="col-sm-2 control-label">Lagerort</label>
        <div class="col-sm-10">
            <input type="text" name="lagerort" class="form-control" id="lagerort" required="">
        </div>
    </div>
    <div class="form-group">
        <label for="umsatzsteuer" class="col-sm-2 control-label">Umsatzsteuer</label>
        <div class="col-sm-10">
            <select class="form-control" name="umsatzsteuer"  id="umsatzsteuer" required="">
                <?php
                $db = new DB();
                $array = $db->getUmsatzsteuer();
                foreach ($array as $eintrag) {
                    $value = $eintrag->getId();
                    echo "<option value='$value'>";
                    echo $eintrag->getSteuersatz();
                    echo "</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Artikel anlegen</button>
        </div>
    </div>

</form>

