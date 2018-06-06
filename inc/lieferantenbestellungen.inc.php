<?php
//echo 'amk';
if (!empty($_GET['loeschen'])) {
    $db = new DB();
    $db->deleteBestellung($_GET['loeschen']);//löschen funktioniert
}

if (!isset($_GET['detail']) && !isset($_GET['aendern']) && !isset($_GET['neueBestellung'])) {

    echo "<div><a class='btn btn-default' href='index.php?neueBestellung=TRUE' role='button'>Bestellung anlegen</a> &ensp;"
    . "<a class='btn btn-default' href='index.php?offeneBestellungen=TRUE' role='button'>offene Lieferantenbestellungen anzeigen</a></div><br>";

    $db = new DB();
    $bestellung = $db->getLieferantenbestellungen();

    echo "<div>";
    echo '<table class="table table-striped">';
    echo "<tr><th>LieferantenbestellungsID</th><th>LieferantID</th><th>Name</th><th>Zahlungsmethode</th><th>Abgeschlossen</th></tr>";

    foreach ($bestellung as $b) {
        echo "<tr>";
        echo "<td>" . $b->getLieferantenbestellungsId() . "</td>";
        echo "<td>" . $b->getLieferantId() . "</td>";
        echo "<td>" . $b->getLieferantName() . "</td>";
        echo "<td>" . $b->getZahlungsmethode() . "</td>";
        if($b->getAbgeschlossen() == 1){
            echo "<td>" . "Ja" . "</td>";
        }else{
            echo "<td>" . "Nein" . "</td>";
        }
        //echo "<td>" . $b->getAbgeschlossen() . "</td>";
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

<h3>Lieferantenbestellungen</h3>

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
        <div class="form-group">
            <label for="abgeschlossen" class="col-sm-2 control-label">Abgeschlossen</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $bestellung->getAbgeschlossen(); ?>" name="abgeschlossen" class="form-control" id="abgeschlossen" readonly="">
            </div>
        </div>
        
    </form>
    
<?php
}else if (isset($_GET['offeneBestellungen'])) {
    $db = new DB();
    $offeneBestellung = $db->getOffeneBestellungen();
    
    echo "<h3>Offene Lieferantenbestellungen</h3>";
    echo "<br>";

    echo "<div>";
    echo '<table class="table table-striped">';
    echo "<tr><th>LieferantenbestellungsID</th><th>LieferantID</th><th>Name</th><th>Zahlungsmethode</th></tr>";

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
} else if(isset($_GET['neueBestellung'])){
    
    $db = new DB();
    $lieferanten = $db->getLieferanten();
    $zahlungsmethoden = $db->getZahlungsmethode();
    $artikel = $db->getArtikel();
    
    
    echo "<h3>Neue Bestellung anlegen</h3><br>";
    ?>
    <form class="form-horizontal" method="POST" action="index.php?bestellungNeu=TRUE">

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Lieferant</label>
            
                <div>
                    <select name=“lieferant” class="dropdown">
                        <?php
                            //echo "<option value=" . 0 . " disabled>Bitte Lieferant wählen</option>";
                            foreach($lieferanten as $lieferant){
                                if($lieferant->getAktiv() == 1){
                                    echo "<option value=" . $lieferant->getLieferantid() . ">" . $lieferant->getName() . "</option>";
                                }else{
                                    echo "<option value=" . $lieferant->getLieferantid() . " disabled>" . $lieferant->getName() . "</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
        </div>
        <br>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Zahlungsmethode</label>
            
                <div>
                    <select name=“zahlungsmethode”>
                        <?php
                            //echo "<option value=" . 0 . " disabled>Bitte Lieferant wählen</option>";
                            foreach($zahlungsmethoden as $zahlungsmethode){
                                    echo "<option value=" . $zahlungsmethode->getZahlungsmethodeid() . ">" . $zahlungsmethode->getZahlungsmethodename() . "</option>";
                            }
                        ?>
                    </select>
                </div>
        </div>
        <br>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Abgeschlossen</label>
            
                <div>
                    <input type="radio" name="Ja" value="1"/> Ja<br>
                    <input type="radio" name="Nein" value="0"/> Nein<br>
                </div>
        </div>
        <br>
        
        
        <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Artikel</label>

                    <div>
                        <select name=“artikelAuswahl”>
                            
                            <?php
                                foreach($artikel as $a){
                                    if($a->getAktiv() == 1){
                                        echo "<option value=" . $a->getArtikelid() ."'> " . $a->getArtikelname() . "</option>";

                                    }else{
                                        echo "<option value=" . $a->getArtikelid() ."' disabled> " . $a->getArtikelname();
                                        
                                    }
                                }
                            ?>
                        </select>
                            
                    </div>
        </div>
        <div class="form-group">
                
            <label for="Menge" class="col-sm-2 control-label">Menge</label>
                <div class="col-sm-2"><!--oder 10-->
                    <input type="number" name="menge" class="form-control" id="menge" required="">
                </div>
            <input class="btn btn-default" type="button" value="+">
            
            <?php
            if(isset($_GET['+'])){
                echo "hiiiiieeeer: " . $_GET['+'];
            }else{echo "neinnnnnn!!!!";}
            ?>
        </div>
        
        
        <div>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" >Bestellung anlegen</button>
            </div>
        </div>
    </form>
   <?php
}

    ?>




