<h3>Neuen Artikel anlegen</h3>
<?php
//if (!empty($_GET['lieferantid']) && !empty($_GET['artikelid'])) {
 //   $db = new DB();
 //   if($db->lieferant_liefert_artikel()){
   //     echo"Artikel zu Lieferant erfolgreich zugeordnet";
  //  }else{
  //      echo"Error";
 //   }
 //   $_SESSION['neuerArtikel'] = FALSE;
//}

if (!empty($_GET['artikelname'])) {
    $db = new DB();
    $db->artikelAnlegen();
    echo "<h2> Artikel zu Lieferant zuordnen </h2>";
    
    ?>

    <form class="form-horizontal" method="GET" action="index.php">
        <div class="form-group">
            <label for="artikel" class="col-sm-2 control-label">Artikel</label>
            <div class="col-sm-10">
                <select class="form-control" name="artikelid"  id="artikelid" required="">
                    <?php
                    $db = new DB();
                    $array = $db->getArtikel();
                    foreach ($array as $eintrag) {
                        $value = $eintrag->getArtikelId();
                        echo "<option value='$value'>";
                        echo $value;
                        echo "-";
                        echo $eintrag->getArtikelname();
                        echo "</option>";
                    }
                    ?>

                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="lieferant" class="col-sm-2 control-label">Lieferant</label>
            <div class="col-sm-10">
                <select class="form-control" name="lieferantid"  id="lieferantid" required="">
                    <?php
                    $db = new DB();
                    $array = $db->getLieferanten();
                    foreach ($array as $eintrag) {
                        $value = $eintrag->getLieferantId();
                        echo "<option value='$value'>";
                        echo $value;
                        echo "-";
                        echo $eintrag->getName();
                        echo "</option>";
                    }
                    ?>

                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Zuordnen</button>
            </div>
        </div>

    </form>

    <?php
} else {
    ?>   
    <br>
    <br>
    <form class="form-horizontal" method="GET" action="index.php">
        <div class="form-group">
            <label for="artikelname" class="col-sm-2 control-label">Artikelname</label>
            <div class="col-sm-10">
                <input type="text" name="artikelname" class="form-control" id="artikelname"  required="" >
            </div>
        </div>
        <div class="form-group">
            <label for="einkaufspreis" class="col-sm-2 control-label">Einkaufspreis</label>
            <div class="col-sm-10">
                <input type="text"  name="einkaufspreis" class="form-control" id="einkaufspreis"  required="">
            </div>
        </div>
        <!--<div class="form-group">
            <label for="verkaufspreis" class="col-sm-2 control-label">Verkaufspreis</label>
            <div class="col-sm-10">
                <input type="text"  name="verkaufspreis" class="form-control" id="verkaufspreis"  required="">
            </div>
        </div> -->
        <div class="form-group">
            <label for="mindestbestand" class="col-sm-2 control-label">Mindestbestand</label>
            <div class="col-sm-10">
                <input type="text" name="mindestbestand" class="form-control" id="mindestbestand"  required="">
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
        $value = $eintrag->getUstId();
        echo "<option value='$value'>";
        echo $eintrag->getSteuersatz();
        echo "</option>";
    }
    ?>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-default">Artikel anlegen</button>

    </form>

    <?php
}
?>