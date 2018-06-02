<?php
session_start();

include './model/Artikel.php';
include './model/Lieferant.php';
include './model/LieferantDetail.php';
include './model/Lieferantenbestellung.php';
include './model/Lieferantenartikel.php';

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
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <h1>HiFi Einkaufssystem</h1>
            </div>
            <div class="col-md-2">        
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" <?php if($active=="start"){ echo 'class="active"';}?>><a href="index.php?menu=start">Startseite</a></li>
                    <li role="presentation" <?php if($active=="lieferanten"){ echo 'class="active"';}?>><a href="index.php?menu=lieferanten">Lieferanten</a></li>
                    <li role="presentation" <?php if($active=="artikel"){ echo 'class="active"';}?>><a href="index.php?menu=artikel">Artikel</a></li>
                    <li role="presentation" <?php if($active=="bestellungen"){ echo 'class="active"';}?>><a href="index.php?menu=bestellungen">Bestellungen</a></li>
                    <li role="presentation" <?php if($active=="offene_bestellungen"){ echo 'class="active"';}?>><a href="index.php?menu=offene_bestellungen">Offene Bestellungen</a></li>
                </ul>
            </div>
            <div class="col-md-10" id="content">
                <main>
                    <!-- Standardmäßig wird hier mittels if abgefragt in welchem Menüeintrag (Session[menu]) der 
                         Benutzer gerade ist und abhängig davon eine andere php datei inkludiert 
                         Im Falle eines Detailaufrufs soll das gesamte Main durch die Rückgabe von ajax überschrieben werden
                         (wie beim Web Test)-->
                    <?php
                        if(isset($_SESSION['menu'])) {
                            if ($_SESSION['menu'] == "lieferanten") {
                                include './inc/lieferanten.inc.php';
                            }
                        }
                    ?>
                </main>
            </div>			
        </div>
    </body>
</html>
