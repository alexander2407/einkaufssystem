<?php
//echo 'amk';
if (!empty($_GET['loeschen'])) {
    $db = new DB();
    $db->deleteBestellung($_GET['loeschen']);//löschen funktioniert
}

if (!isset($_GET['detail']) && !isset($_GET['aendern']) && !isset($_GET['neueBestellung']) && !isset($_GET['offeneBestellungen'])) {

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
    
    echo "<h3>Neue Bestellung anlegen</h3><br>";
    ?>
    <form class="form-horizontal" method="POST" action="index.php?bestellungNeu=TRUE">
        <div class="form-group">
            <label for="lieferantid" class="col-sm-2 control-label">Lieferant (ID)</label>
            <div class="col-sm-10">
                <input type="number"  name="lieferantid" class="form-control" id="inputEmail3" >
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Zahlungsmethode (ID)</label>
            <div class="col-sm-10">
                <input type="number"  name="zahlungsmethodeid" class="form-control" id="inputEmail3" >
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Abgeschlossen (1/0)</label>
            <div class="col-sm-10">
                <input type="text"  name="abgeschlossen" class="form-control" id="inputEmail3" >
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              tschuksl test
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                //<?php
//                    echo "<li>" . "test" . "</li>";
//                    foreach($lieferanten as $lieferant){
//                        echo "<li>" . $lieferant->getName() . "</li>";
//                    }
//                ?>
                <li><a href="#">test 1</a></li>
                <li><a href="#">test 2</a></li>
                <li><a href="#">test 3</a></li>
              
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Dropdown test 2
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Bestellung anlegen</button>
            </div>
        </div>
    </form>
   <?php
}
?>



