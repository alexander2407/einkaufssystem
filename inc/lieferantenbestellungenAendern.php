<?php
$db = new DB();
$LBbestellung = $db->getLieferantenbestellung($_GET['LBaendern']);

if (isset($_GET['LBaendern'])) {
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

            <h4>Lieferantenartikel zu dieser Bestellung</h4>
            <?php
            $lieferantenartikel = $db->getLieferantenartikel($LBbestellung->getLieferantenbestellungsId());
            //if (count($lieferantenartikel) > 0) {
                foreach ($lieferantenartikel as $value) {
                    ?>
                    <div class="form-group">
                        <label for="artikelid" class="col-sm-3 control-label">ArtikelId</label>
                        <div class="col-sm-7">
                            <input type="text" value="" name="artikelid" class="form-control" id="artikelid" readonly="" placeholder="<?php echo $value->getArtikelId() ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="artikelname" class="col-sm-3 control-label">Artikelname</label>
                        <div class="col-sm-7">
                            <input type="text" value="" name="artikelname" class="form-control" id="artikelname" readonly="" placeholder="<?php echo $value->getArtikelname() ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="anzahl" class="col-sm-3 control-label">Anzahl</label>
                        <div class="col-sm-7">
                            <input type="text" value="" name="anzahl" class="form-control" id="anzahl" readonly="" placeholder="<?php echo $value->getAnzahl() ?>">
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" name="LBbestellungGeaendert">Lieferantenbestellung ändern</button>
                    </div>
                    </div>
                    <br>
                    
                    <?php
                }
//            } else {
//                echo '<p>Zu dieser Lieferantenbestellung gibt es keine Artikel.</p>';
//            }
    }
        ?>


    </form>
    <?php
}
?>

