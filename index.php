<?php
session_start();

include './model/Artikel.php';
include './model/Lieferant.php';
include './model/LieferantDetail.php';
include './model/Lieferantenbestellung.php';
include './model/Lieferantenartikel.php';
include './model/LieferantLiefert.php';
include './model/Zahlungsmethode.php';

include './model/Zahlungsbedingungen.php';
include './model/Lieferbedingungen.php';
include './model/Ort.php';
include './model/Ust.php';
include './model/LieferantenKontaktperson.php';

include './utility/DB.class.php';

$active = "";

if (isset($_GET['menu'])) {
    $active = $_GET['menu'];
    $_SESSION['menu'] = $active;
}
if (!isset($_SESSION['menu'])){
    $_SESSION['menu'] = "start";
}
if (isset($_SESSION['menu'])) {
    $active = $_SESSION['menu'];
}
if(isset($_GET['neuerArtikel'])){
    $_SESSION['neuerArtikel']=TRUE;
}



?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>HiFi Einkaufssystem</title>
        <link rel="icon" href="favicon.png" type="image/png"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="style/stylesheet.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <h1>HiFi Einkaufssystem</h1>
            </div>
            <div class="col-md-2">
<!--                col-md-2-->
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" <?php if($active=="start"){ echo 'class="active"';}?>><a href="index.php?menu=start">Startseite</a></li>
                    <li role="presentation" <?php if($active=="lieferanten"){ echo 'class="active"';}?>><a href="index.php?menu=lieferanten">Lieferanten</a></li>
                    <li role="presentation" <?php if($active=="artikel"){ echo 'class="active"';}?>><a href="index.php?menu=artikel">Artikel</a></li>
                    <li role="presentation" <?php if($active=="bestellungen"){ echo 'class="active"';}?>><a href="index.php?menu=bestellungen">Lieferantenbestellungen</a></li>
                    <!-- <li role="presentation" <?php //if($active=="offene_bestellungen"){ echo 'class="active"';}?>><a href="index.php?menu=offene_bestellungen">Offene Bestellungen</a></li>-->
                    <li role="presentation"><a href="http://wi-project.technikum-wien.at/s18/s18-bvz2-fst-32/">Lagersystem</a></li>
                    <li role="presentation"><a href="http://wi-project.technikum-wien.at/s18/s18-bvz2-fst-33">Verkaufssystem</a></li>
                    
                    
                </ul>
            </div>
            <div class="col-md-10" id="content">
                <main>
                    <!-- Standardmäßig wird hier mittels if abgefragt in welchem Menüeintrag (Session[menu]) der 
                         Benutzer gerade ist und abhängig davon eine andere php datei inkludiert 
                         Im Falle eines Detailaufrufs soll das gesamte Main durch die Rückgabe von ajax überschrieben werden
                         (wie beim Web Test)-->
                    <?php
                            if ($_SESSION['menu'] == "lieferanten") {
                                include './inc/lieferanten.inc.php';
                            }
                            if ($_SESSION['menu'] == "artikel") {
                                include './inc/artikel.inc.php';
                            }
                            if ($_SESSION['menu'] == "bestellungen") {
                                include './inc/lieferantenbestellungen.inc.php';
                            }
//                            if ($_SESSION['menu'] == "offene_bestellungen") {
//                                include './inc/offene_bestellungen.inc.php';
//                            }
                            if ($_SESSION['menu'] == "start") {
                                include './inc/startseite.inc.php';
                            }                            
                        
                    ?>
                </main>
            </div>			
        </div>
    </body>
</html>
