<!--Hier ein Beispiel zur Validierung mit HTML:-->
<!--<input type="text" value="" name="test" class="form-control" id="anzahl" value="" required="" pattern="^[0-9][0-9]?$|^100$" title="Bitte wählen Sie eine andere Menge.">-->
<!--Unter den Link sind Beispiele zur Anwendung: https://www.w3schools.com/tags/att_input_pattern.asp
Unter dem Link könnt ihr eure Regex testen: https://www.w3schools.com/tags/tryit.asp?filename=tryhtml5_input_pattern-->

<?php
//$v_lieferant = 0; bei bestehenden lieferantenbestellungen nur die artikelanzahl ändern (bei anzahl 0 artikel löschen), eventuell den lieferanten ändern lassen, wenn er die gleichen artikel liefert.
if (!empty($_GET['loeschen'])) {
    $db = new DB();
    $db->deleteBestellung($_GET['loeschen']);
}

if (!isset($_GET['detail']) && !isset($_GET['LBaendern']) && !isset($_GET['neueBestellung']) && !isset($_GET['artikelHinzufügen']) && !isset($_GET['offeneBestellungen']) && !isset($_GET['bestellungAnlegen']) && !isset($_GET['LBbestellungGeaendert'])) {

    echo "<div><a class='btn btn-default' href='index.php?neueBestellung=TRUE' role='button'>Lieferantenbestellung anlegen</a> &ensp;"
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
} else if (isset($_GET['detail'])) {
    $db = new DB();
    $id = $_GET['detail'];
    $bestellung = $db->getLieferantenbestellung($id);
    //$lieferant = $db->getLieferant($id); //$id ist die id von der Lieferantenbestellung
    ?>

    <h3>Lieferantenbestellungen</h3>

    <br>
    <a class="btn btn-default" href="index.php?LBaendern=<?php echo $id; ?>">Bearbeiten</a>
    <br>
    <br>
    <form class="form-horizontal">
        <div class="form-group">
            <label for="lieferantenbestellungsid" class="col-sm-3 control-label">LieferantenBestelungsID</label>
            <div class="col-sm-7">
                <input type="text" value="<?php echo $bestellung->getLieferantenbestellungsId(); ?>" name="lieferantenbestellungsid" class="form-control" id="lieferantenbestellungsid" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="lieferantenid" class="col-sm-3 control-label">LieferantID</label>
            <div class="col-sm-7">
                <input type="text" value="<?php echo $bestellung->getLieferantId(); ?>" name="lieferantenid" class="form-control" id="lieferantenid" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="lieferantname" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-7">
                <input type="text" value="<?php echo $bestellung->getLieferantName(); ?>" name="lieferantname" class="form-control" id="lieferantname" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="zahlungsmethodeid" class="col-sm-3 control-label">ZahlungsmethodeID</label>
            <div class="col-sm-7">
                <input type="text" value="<?php echo $bestellung->getZahlungsmethodeId(); ?>" name="zahlungsmethodeid" class="form-control" id="zahlungsmethodeid" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="zahlungsmethode" class="col-sm-3 control-label">Zahlungsmethode</label>
            <div class="col-sm-7">
                <input type="text" value="<?php echo $bestellung->getZahlungsmethode(); ?>" name="zahlungsmethode" class="form-control" id="zahlungsmethode" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="abgeschlossen" class="col-sm-3 control-label">Abgeschlossen</label>
            <div class="col-sm-7">
                <input type="text" value="<?php if($bestellung->getAbgeschlossen() == 1){echo "Ja";}else{echo "Nein";}?>" name="abgeschlossen" class="form-control" id="abgeschlossen" readonly="">
                
            </div>
        </div>
        <br>
        <h4>Lieferantenartikel zu dieser Bestellung</h4>
        <?php
        $lieferantenartikel = $db->getLieferantenartikel($bestellung->getLieferantenbestellungsId());
        if (count($lieferantenartikel) > 0) {
            foreach ($lieferantenartikel as $value) {
                ?>
                <div class="form-group">
                    <label for="artikelid" class="col-sm-3 control-label">ArtikelId</label>
                    <div class="col-sm-7">
                        <input type="text" value="<?php echo $value->getArtikelId() ?>" name="artikelid" class="form-control" id="artikelid" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="artikelname" class="col-sm-3 control-label">Artikelname</label>
                    <div class="col-sm-7">
                        <input type="text" value="<?php echo $value->getArtikelname() ?>" name="artikelname" class="form-control" id="artikelname" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="anzahl" class="col-sm-3 control-label">Anzahl</label>
                    <div class="col-sm-7">
                        <input type="text" value="<?php echo $value->getAnzahl() ?>" name="anzahl" class="form-control" id="anzahl" readonly="">
                    </div>
                </div>
                <br>
                <?php
            }
        } else {
            echo '<p>Zu dieser Lieferantenbestellung gibt es keine Artikel.</p>';
        }
        ?>


    </form>

    <?php
} else if (isset($_GET['offeneBestellungen'])) {
    $db = new DB();
    $offeneBestellung = $db->getOffeneBestellungen();

    echo "<h3>Offene Lieferantenbestellungen</h3>";
    echo "<br>";

    echo "<div>";
    echo '<table class="table table-striped">';
    echo "<tr><th>LieferantenbestellungsID</th><th>LieferantID</th><th>Name</th><th>Zahlungsmethode</th></tr>";

    foreach ($offeneBestellung as $b) {
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
} else if (isset($_GET['neueBestellung'])) {
    $db = new DB();
    $lieferanten = $db->getLieferanten();
    $zahlungsmethoden = $db->getZahlungsmethode();
    
    echo "<h3>Neue Bestellung anlegen</h3><br>";
    ?>
    <form class="form-horizontal" method="POST" action="index.php?artikelHinzufügen=TRUE">
        <div class="form-group">
            <label for="lieferant" class="col-sm-2 control-label">Lieferant</label>
            <div class="div col-sm-10"> 
                <select name="lieferant" class="form-control" id="lieferant">
                    <?php
                    //echo "<option value=" . 0 . " disabled>Bitte Lieferant wählen</option>";
                    foreach ($lieferanten as $lieferant) {
                        if ($lieferant->getAktiv() == 1) {
                            echo "<option value=" . $lieferant->getLieferantid() . ">" . $lieferant->getName() . "</option>";
                        } else {
                            echo "<option value=" . $lieferant->getLieferantid() . " disabled>" . $lieferant->getName() . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label for="zahlungsmethode" class="col-sm-2 control-label">Zahlungsmethode</label>
            <div class="col-sm-10">
                <select name="zahlungsmethode" class="form-control" id="zahlungsmethode">
                    <?php
                    //echo "<option value=" . 0 . " disabled>Bitte Lieferant wählen</option>";
                    foreach ($zahlungsmethoden as $zahlungsmethode) {
                        echo "<option value=" . $zahlungsmethode->getZahlungsmethodeid() . ">" . $zahlungsmethode->getZahlungsmethodename() . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <!--        <br>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Abgeschlossen</label>
                    
                        <div>
                            <input type="radio" name="Ja" value="1"/> Ja<br>
                            <input type="radio" name="Nein" value="0"/> Nein<br>
                        </div>
                </div>-->
        <br>


        <div>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" >Artikel hinzufügen</button>
            </div>
        </div>
    </form>


    <?php
} else if (isset($_GET['artikelHinzufügen'])) {

    $db = new DB();
    $artikel = $db->getArtikelByLieferant($_POST['lieferant']);
    $lieferant = $db->getLieferant($_POST['lieferant']);
    $zahlungsmethode = $db->getZahlungsmethodeById($_POST['zahlungsmethode']);
    $v_lieferant = $_POST['lieferant'];

    
    if(isset($_GET['bestellungAnlegen'])){
            //$alleArtikel = array();
            //$db = new DB();
            $alleArtikel = $db->getArtikelByLieferant($_POST['lieferant']);
            $anzahlArtikel = 0;
            foreach($alleArtikel as $arti){
                $anzahlArtikel ++;
            }
            
            //echo "anzahl artikel: " . $anzahlArtikel;
            //$db->testTabelle(98); //fügt in "testtab" die anzahl der artikelIDs des ausgewählten lieferanten ein.
    }
    
//    if(isset($_POST['zahlungsmethode'])){
//        echo "da is sie: " . $_POST['zahlungsmethode'];
//    }
//    if(isset($_POST['Lieferant'])){
//        echo "da is er: " . $_POST['lieferant'];
//    }
    ?>
    <h3>Artikelmengen erfassen</h3>
    <br>

    
    <form class="form-horizontal" method="POST" action="index.php?bestellungAnlegen=TRUE">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Lieferant</label>
            <div class="col-sm-10">
                <input type="text"  name="lieferant" value="<?php echo $lieferant->getName(); ?>" class="form-control" id="inputEmail3" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">LieferantenID</label>
            <div class="col-sm-10">
                <input type="text"  name="lieferantid" value="<?php echo $lieferant->getLieferantId(); ?>" class="form-control" id="inputEmail3" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Zahlungsbedingungen</label>
            <div class="col-sm-10">
                <input type="text"  name="zahlungsbedingungen" value="<?php echo $zahlungsmethode->getZahlungsmethodename(); ?>" class="form-control" id="inputEmail3" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">ZahlungsbedingungID</label>
            <div class="col-sm-10">
                <input type="text"  name="zahlungsbedingungenid" value="<?php echo $zahlungsmethode->getZahlungsmethodeid(); ?>" class="form-control" id="inputEmail3" readonly="">
            </div>
        </div>
        <h3>Artikel der <?php echo $lieferant->getName(); ?>:</h3>
        <br>
        <?php
        //$v_lieferant = $_POST['lieferant'];
        if(empty($artikel)){
            echo "<br>";
            echo "<div class='alert alert-danger' role='alert'>Für den Lieferanten ".$lieferant->getName()." sind keine Artikel vorhanden.</div>";
            echo "<br>";
            echo "<div class='col-sm-offset-2 col-sm-10'>
                    <a href='index.php?neueBestellung=TRUE' class='btn btn-default'>zurück</a>
                  </div>";

        }else{
        //hier eventuell mit else und zusätzlichem button erweitern
        foreach ($artikel as $a) {
            echo "<div class='form-group'><label for='artikelname' class='col-sm-2 control-label'>" . $a->getArtikelname() . "</label><div class='col-sm-10'><input type='number' name='" . $a->getArtikelid() . "' class='form-control' id='artikelname'  min='0' title='Bitte wählen Sie eine andere Menge.'></div></div>";
        }
        ?>

        <div>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" >Bestellung anlegen</button>
            </div>
        </div>
    </form>

    <?php
        }
//    if(isset($_GET['bestellungAnlegen'])){
//            //$alleArtikel = array();
//            $db = new DB();
//            $alleArtikel = $db->getArtikelByLieferant($_POST['lieferant']);
//            $anzahlArtikel = 0;
//            foreach($alleArtikel as $arti){
//                $anzahlArtikel ++;
//            }
//            
//            //echo "anzahl artikel: " . $anzahlArtikel;
//            $db->testTabelle(99); //fügt in "testtab" die anzahl der artikelIDs des ausgewählten lieferanten ein.
//    }
    
//        if(isset($_GET['bestellungAnlegen'])){
//            $alleArtikel = getArtikelByLieferant($_POST['lieferant']);
//            $anzahlArtikel = 0;
//            foreach($alleArtikel as $artikel){
//                $anzahlArtikel ++;
//            }
//            
//            echo "anzahl artikel: " . $anzahlArtikel;

//            $artikelarray = array();
//            $artikelarray = 
//            $db = new DB();
//            $anlegen = $db->lieferantenbestellungErfassen($_POST['lieferant'], $artikelarray, $_POST['zahlungsmethode']);
            
            
        //}
    ?>
    
    <?php
} else if(isset($_GET['bestellungAnlegen'])){
            $db = new DB();
            $alleArtikel = $db->getArtikelByLieferant($_POST['lieferantid']);
            $artikelMengeArray = array();
            
            $anzahlArtikel = 0;
            foreach($alleArtikel as $arti){
                
                $artikelMengeArray[] = $_POST[$alleArtikel[$anzahlArtikel]->getArtikelId()];
                $anzahlArtikel ++;
            }
            
            $intArrayMenge = array_map(
            function($value) { return (int)$value; },
            $artikelMengeArray);
            //$lastid = getLieferantenbestellungsIdLast() + 1;
            

            //array erstellen mit artikelid und der zugehörigen menge, und dieses der funktion übergeben.
            $angelegtBoolean = FALSE;
            if($anzahlArtikel > 0){
                $angelegtBoolean = $db->lieferantenbestellungErfassen($_POST['lieferantid'], $alleArtikel, $intArrayMenge, $_POST['zahlungsbedingungenid']);
                //echo '<div class="alert alert-success" role="alert">Lieferantenbestellung angelegt!</div>';
                
            }
            
            if($angelegtBoolean == TRUE){
                echo '<div class="alert alert-success" role="alert">Lieferantenbestellung angelegt!</div>';
            }else{
                echo '<div class="alert alert-danger" role="alert">Lieferantenbestellung wurde nicht angelegt!</div>';
            }
            
            
            
            

    //$db->testTabelle($anzahlArtikel);

    ?>
    
    
    <?php
    echo "<br>";
            echo "<div class='col-sm-offset-2 col-sm-10'>
                    <a href='index.php?neueBestellung=TRUE' class='btn btn-default'>zurück</a>
                  </div>";
            
    ?>
<!--    hier vielleicht noch abfragen ob die anzahl der artikel der lieferanten kleiner 1 sind, dann ein rotes aler mit nicht angelegt.-->
    <?php
    }else if (isset($_GET['LBaendern'])) {
        $db = new DB();
        $LBbestellung = $db->getLieferantenbestellung($_GET['LBaendern']);
        $zahlungsmethoden = $db->getZahlungsmethode();
        
    if($LBbestellung->getAbgeschlossen() == 1){
        echo "<br>";
            echo "<div class='alert alert-danger' role='alert'>Die Lieferantenbestellung ".$LBbestellung->getLieferantenbestellungsId()." ist bereits abgeschlossen.</div>";
            echo "<br>";
            echo "<div class='col-sm-offset-2 col-sm-10'>
                    <a href='index.php?menu=bestellungen' class='btn btn-default'>zurück</a>
                  </div>";
    }else{
        ?>
        <h3>Lieferantenbestellung <?php echo $_GET['LBaendern']?> bearbeiten</h3>
        <br>
        <form class="form-horizontal" method="POST" action="index.php?LBbestellungGeaendert=TRUE">
            <br>
                <div class="form-group">
                    <label for="lieferantenbestellungsid" class="col-sm-3 control-label">LieferantenBestelungsID</label>
                    <div class="col-sm-7">
                        <input type="text" value="<?php echo $LBbestellung->getLieferantenbestellungsId(); ?>" name="lieferantenbestellungsid" class="form-control" id="lieferantenbestellungsid" readonly="">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="lieferantname" class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-7">
                        <input type="text" value="<?php echo $LBbestellung->getLieferantName(); ?>" name="lieferantname" class="form-control" id="lieferantname" readonly="">
                    </div>
                </div>
            
                <div class="form-group">
                <label for="zahlungsmethode" class="col-sm-3 control-label">Zahlungsmethode</label>
                <div class="col-sm-7">
                    <select name="zahlungsmethodeNeu" class="form-control" id="zahlungsmethode">
                        <?php
                        //echo "<option value=" . 0 . " disabled>Bitte Lieferant wählen</option>";
                        foreach ($zahlungsmethoden as $zahlungsmethode) {
                            echo "<option value=" . $zahlungsmethode->getZahlungsmethodeid() . ">" . $zahlungsmethode->getZahlungsmethodename() . "</option>";
                        }
                        ?>
                    </select>
                </div>
                </div>
            
            <h4>Artikel</h4>
            <br>
            <?php
            $lieferantenartikel = $db->getLieferantenartikel($LBbestellung->getLieferantenbestellungsId());
            $Bestellung = $db->getLieferantenbestellung($_GET['LBaendern']);
            $Artikel = $db->getArtikelByLieferant($Bestellung->getLieferantId());
            
            
                foreach ($Artikel as $value) {
                    ?>
                    <div class="form-group">
                        <label for="artikelid" class="col-sm-3 control-label">ArtikelId</label>
                        <div class="col-sm-7">
                            <input type="text" value="<?php echo $value->getArtikelId() ?>" name="<?php echo $value->getArtikelId() ?>" class="form-control" id="artikelid" placeholder="" readonly="">
                        </div>
                    </div>
            
            
                    <div class="form-group">
                        <label for="artikelname" class="col-sm-3 control-label">Artikelname</label>
                        <div class="col-sm-7">
                            <input type="text" value="<?php echo $value->getArtikelname() ?>" name="artikelname" class="form-control" id="artikelname" placeholder="" readonly="">
                        </div>
                    </div>
            
            
                    <div class="form-group">
                        <label for="anzahl" class="col-sm-3 control-label">Anzahl</label>
                        <div class="col-sm-7">
                            <input type="text" value="" name="<?php echo $value->getArtikelId() ?>" class="form-control" id="anzahl" value="" required="" pattern="^[0-9][0-9]?$|^100$" title="Bitte wählen Sie eine andere Menge.">
                        </div>
                    </div>
            <br>
            <?php
                }
            ?>
            <br>
            
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default" name="LBbestellungGeaendert">Lieferantenbestellung ändern</button>
                        </div>
                    </div>
                    
                    
                    <?php
                //}
    }
        ?>


    </form>
    <?php
}else if(isset($_GET['LBbestellungGeaendert'])){
    $db = new DB();
    $lieferantenBestellungsId = $db->getLieferantenbestellung($_POST['lieferantenbestellungsid']);
    $LieferantID = $lieferantenBestellungsId->getLieferantId();
    $alleArtikel = $db->getArtikelByLieferant($LieferantID);//alle artikelIDs einer lieferantenbestellung
    
    
    $MengenArray = array();
            
            $anzahlArtikel = 0;
            foreach($alleArtikel as $arti){
                
                $MengenArray[] = $_POST[$alleArtikel[$anzahlArtikel]->getArtikelId()];//die anzahl wird aus dem formular in ein array gespeichert.
                $anzahlArtikel ++;
            }
            
            $intMengenArray = array_map(
            function($value) { return (int)$value; },
            $MengenArray);
            
    $angelegtBoolean = $db->updateLieferantenbestellung($_POST['zahlungsmethodeNeu'], $_POST['lieferantenbestellungsid'], $alleArtikel, $intMengenArray);
            
            
//    echo "neue anzahl: ".$_POST['anzahlNeu'];
//    echo "<br>";
//    echo "die neue zahlungsmethode: ".$_POST['zahlungsmethodeNeu'];
//    echo "<br>";
    
    if($angelegtBoolean == TRUE){
        echo "<div class='alert alert-success' role='alert'>Lieferantenbestellung ". $_POST['lieferantenbestellungsid']." bearbeitet!</div>";
        echo "<br>";
        echo "<div class='col-sm-offset-2 col-sm-10'>
              <a href='index.php?menu=bestellungen' class='btn btn-default'>zurück</a>
              </div>";
    }else{
        echo "<div class='alert alert-info' role='alert'>Lieferantenbestellung ". $_POST['lieferantenbestellungsid']." wurde gelöscht!</div>";
        echo "<br>";
        echo "<div class='col-sm-offset-2 col-sm-10'>
              <a href='index.php?menu=bestellungen' class='btn btn-default'>zurück</a>
              </div>";
    }
}
?>