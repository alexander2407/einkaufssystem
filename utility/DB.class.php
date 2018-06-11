<?php

class DB {

    private $host = "wi-projectdb.technikum-wien.at:3306";
    private $user = "s18-bvz2-fst-31";
    private $pwd = "DbPass4v831";
    private $dbname = "s18-bvz2-fst-30";
    private $conn = null;

    function doConnect() {
        $this->conn = new mysqli($this->host, $this->user, $this->pwd, $this->dbname);
    }

    //returned eine Liste aller (inaktiven und aktiven) Lieferanten
    function getLieferanten() {
        $this->doConnect();
        $resultArray = array();
        $query = "SELECT lieferantId, name, telefonnummer, strasse, hausnummer, plz, Ort.bezeichnung, Land.bezeichnung, aktiv "
                . "FROM lieferant "
                . "join ort using(ortid) "
                . "join land using(landid) "
                . "order by lieferantId;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($lieferantId, $name, $telefonnummer, $strasse, $hausnummer, $plz, $ort, $land, $aktiv);
        while ($stmt->fetch()) {
            $lieferant = new Lieferant($lieferantId, $name, $telefonnummer, $strasse, $hausnummer, $plz, $ort, $land, $aktiv);
            array_push($resultArray, $lieferant);
        }
        $this->conn->close();
        return $resultArray;
    }

    //setzt einen Lieferanten aktiv
    function setLieferantAktiv($id) {
        $this->doConnect();
        $query = "UPDATE lieferant SET Aktiv=1 where lieferantid = ?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->conn->close();
    }

    //setzt einen Lieferanten inaktiv
    function setLieferantInaktiv($id) {
        $this->doConnect();
        $query = "UPDATE lieferant SET Aktiv=0 where lieferantid = ?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->conn->close();
    }

    //gibt einen Lieferanten nach Id zurück
    function getLieferant($lieferantId) {
        $this->doConnect();
        $query = "SELECT lieferantId, name, lieferant.Telefonnummer, strasse, hausnummer, ortId, plz, Ort.bezeichnung, landId, Land.bezeichnung, kennzeichen, aktiv, zahlungsbedingungId, skonto, rabatt, zahlungszieltage, lieferbedingungId, kosten, typ, transportart, kontaktpersonId, vorname, nachname, LieferantenKontaktperson.telefonnummer "
                . "FROM lieferant "
                . "JOIN ort USING(ortid) "
                . "JOIN land USING(landid) "
                . "JOIN lieferbedingungen USING(lieferbedingungid) "
                . "JOIN zahlungsbedingungen USING(zahlungsbedingungid) "
                . "LEFT JOIN lieferantenkontaktperson USING(lieferantid) "
                . "JOIN incoterms USING(incotermsid) "
                . "JOIN transportart USING(transportartid) "
                . "WHERE lieferantid=?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $lieferantId);
        $stmt->execute();
        $stmt->bind_result($lieferantId, $name, $telefonnummer, $strasse, $hausnummer, $ortId, $plz, $ort, $landId, $land, $land_kennzeichen, $aktiv, $zahlungsbedingungsId, $skonto, $rabatt, $zahlungsziel, $lieferbedingungsId, $lieferkosten, $incoterms, $transportart, $kontaktpersonId, $kontakt_vorname, $kontakt_nachname, $kontakt_telefonnummer);
        while ($stmt->fetch()) {
            $lieferant = new LieferantDetail($lieferantId, $name, $telefonnummer, $strasse, $hausnummer, $ortId, $plz, $ort, $landId, $land, $land_kennzeichen, $aktiv, $zahlungsbedingungsId, $skonto, $rabatt, $zahlungsziel, $lieferbedingungsId, $lieferkosten, $incoterms, $transportart, $kontaktpersonId, $kontakt_vorname, $kontakt_nachname, $kontakt_telefonnummer);
        }
        $this->conn->close();
        return $lieferant;
    }

    function insertLieferant($lieferantDetail) {
        $this->doConnect();
        $query = "INSERT INTO lieferant(Name, Telefonnummer, ZahlungsbedingungId, LieferbedingungId, Strasse, Hausnummer, OrtId, Aktiv) VALUES(?,?,?,?,?,?,?,?);";
        $stmt = $this->conn->prepare($query);
        $name = $lieferantDetail->getName();
        $telefonnummer = $lieferantDetail->getTelefonnummer();
        $zahlungsbedingungId = $lieferantDetail->getZahlungsbedingungId();
        $lieferbedingungsId = $lieferantDetail->getLieferbedingungsId();
        $strasse = $lieferantDetail->getStrasse();
        $hausnummer = $lieferantDetail->getHausnummer();
        $ortId = $lieferantDetail->getOrtId();
        $aktiv = $lieferantDetail->getAktiv();
        $stmt->bind_param("ssiisiii", $name, $telefonnummer, $zahlungsbedingungId, $lieferbedingungsId, $strasse, $hausnummer, $ortId, $aktiv);
        $stmt->execute();
        $id = $this->conn->insert_id;
        $this->conn->close();
        return $id;
    }

    function updateLieferant($lieferantDetail) {
        $this->doConnect();
        $query = "update lieferant set Name=?, Telefonnummer=?, ZahlungsbedingungId=?, LieferbedingungId=?, Strasse=?, Hausnummer=?, OrtId=?, Aktiv=? where lieferantId=?;";
        $stmt = $this->conn->prepare($query);
        $name = $lieferantDetail->getName();
        $telefonnummer = $lieferantDetail->getTelefonnummer();
        $zahlungsbedingungId = $lieferantDetail->getZahlungsbedingungId();
        $lieferbedingungsId = $lieferantDetail->getLieferbedingungsId();
        $strasse = $lieferantDetail->getStrasse();
        $hausnummer = $lieferantDetail->getHausnummer();
        $ortId = $lieferantDetail->getOrtId();
        $aktiv = $lieferantDetail->getAktiv();
        $lieferantId = $lieferantDetail->getLieferantId();
        $stmt->bind_param("ssiisiiii", $name, $telefonnummer, $zahlungsbedingungId, $lieferbedingungsId, $strasse, $hausnummer, $ortId, $aktiv, $lieferantId);
        $stmt->execute();
        $err = $this->conn->errno;
        $this->conn->close();
        return $err == 0;
    }

    function insertLieferantLiefert($lieferantliefert) {
        $this->doConnect();
        $query = "INSERT INTO lieferantliefert VALUES(?,?);";
        $stmt = $this->conn->prepare($query);
        $lieferantid = $lieferantliefert->getLieferantId();
        $artikelid = $lieferantliefert->getArtikelId();
        $stmt->bind_param("ii", $lieferantid, $artikelid);
        $stmt->execute();
        $errno = $this->conn->insert_id;
        $this->conn->close();
        return $errno;
    }

    //gibt den ersten Lieferant zu einem Artikel zurück
    function getFirstLieferantIdToArtikel($artikelId) {
        $this->doConnect();
        $query = "SELECT lieferantId "
                . "FROM lieferantliefert "
                . "WHERE artikelid=? "
                . "LIMIT 1;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $artikelId);
        $stmt->execute();
        $stmt->bind_result($lieferantId);
        $id = null;
        while ($stmt->fetch()) {
            $id = $lieferantId;
        }
        $this->conn->close();
        return $id;
    }

    //gibt eine Liste der Artikel welche von einem Lieferant geliefert werden können zurück, in Form eines LieferantLiefert Objektes
    function getArtikelByLieferant($lieferantId) {
        $this->doConnect();
        $resultArray = array();
        $query = "SELECT lieferantId, name, artikelId, artikelname "
                . "FROM lieferantliefert "
                . "JOIN lieferant using(lieferantid) "
                . "JOIN artikel using(artikelid) "
                . "WHERE lieferantid=?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $lieferantId);
        $stmt->execute();
        $stmt->bind_result($lieferantId, $name, $artikelId, $artikelname);
        while ($stmt->fetch()) {
            $lieferantliefert = new LieferantLiefert($lieferantId, $artikelId, $name, $artikelname);
            array_push($resultArray, $lieferantliefert);
        }
        $this->conn->close();
        return $resultArray;
    }

    //Funktion returned ein Array bestehend aus allen Artikeln
    function getArtikel() {
        $this->doConnect();
        $resultArray = array();
        $query = "SELECT artikelId, artikelname, einkaufspreis, verkaufspreis, mindestbestand, aufschlag, lagerstand, lagerort, steuersatz, aktiv "
                . "FROM artikel JOIN umsatzsteuer using(umsatzsteuerid)"
                . "order by artikelId;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($artikelId, $artikelname, $einkaufspreis, $verkaufspreis, $mindestbestand, $aufschlag, $lagerstand, $lagerort, $steuersatz, $aktiv);
        while ($stmt->fetch()) {
            $artikel = new Artikel($artikelId, $artikelname, $einkaufspreis, $verkaufspreis, $mindestbestand, $aufschlag, $lagerstand, $lagerort, $steuersatz, $aktiv);
            array_push($resultArray, $artikel);
        }
        $this->conn->close();
        return $resultArray;
    }

    //Funktion returned ein Array bestehend aus allen Artikeln die Mindestbestand unterschreiten
    function getArtikelUnterMindestbestand() {
        $this->doConnect();
        $resultArray = array();
        $query = "SELECT artikelId, artikelname, einkaufspreis, verkaufspreis, mindestbestand, aufschlag, lagerstand, lagerort, steuersatz, aktiv "
                . "FROM artikel join umsatzsteuer using(umsatzsteuerid) "
                . "WHERE mindestbestand > lagerstand "
                . "ORDER BY artikelId;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($artikelId, $artikelname, $einkaufspreis, $verkaufspreis, $mindestbestand, $aufschlag, $lagerstand, $lagerort, $steuersatz, $aktiv);
        while ($stmt->fetch()) {
            $artikel = new Artikel($artikelId, $artikelname, $einkaufspreis, $verkaufspreis, $mindestbestand, $aufschlag, $lagerstand, $lagerort, $steuersatz, $aktiv);
            array_push($resultArray, $artikel);
        }
        $this->conn->close();
        return $resultArray;
    }

    //gibt einen Artikel nach Id zurück
    function getArtikelWithId($artikelId) {
        $this->doConnect();
        $query = "SELECT artikelId, artikelname, einkaufspreis, verkaufspreis, mindestbestand, aufschlag, lagerstand, lagerort, steuersatz, aktiv "
                . "FROM artikel join umsatzsteuer using(umsatzsteuerid)"
                . "WHERE artikelId = ?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $artikelId);
        $stmt->execute();
        $stmt->bind_result($artikelId, $artikelname, $einkaufspreis, $verkaufspreis, $mindestbestand, $aufschlag, $lagerstand, $lagerort, $steuersatz, $aktiv);
        while ($stmt->fetch()) {
            $artikel = new Artikel($artikelId, $artikelname, $einkaufspreis, $verkaufspreis, $mindestbestand, $aufschlag, $lagerstand, $lagerort, $steuersatz, $aktiv);
        }
        $this->conn->close();
        return $artikel;
    }

    function getLieferantByArtikel($artikelId) {
        $this->doConnect();
        $resultArray = array();
        $query = "SELECT lieferantId, name, artikelId, artikelname "
                . "FROM lieferantliefert "
                . "JOIN lieferant using(lieferantid) "
                . "JOIN artikel using(artikelid) "
                . "WHERE artikelid=?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $artikelId);
        $stmt->execute();
        $stmt->bind_result($lieferantId, $name, $artikelId, $artikelname);
        while ($stmt->fetch()) {
            $lieferantliefert = new LieferantLiefert($lieferantId, $artikelId, $name, $artikelname);
            array_push($resultArray, $lieferantliefert);
        }
        $this->conn->close();
        return $resultArray;
    }

    function deleteArtikel($id) {
        $this->doConnect();
        $query = "DELETE FROM lieferantliefert WHERE artikelid=?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $query = "DELETE FROM artikel WHERE artikelid=?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->conn->close();
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    //es muss nur aus der Tabelle lieferantenbestellung gelöscht werden
    function deleteBestellung($id) {
        $this->doConnect();
        $query = "DELETE FROM lieferantenbestellung WHERE lieferantenbestellungsid=?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $query = "DELETE FROM lieferantenartikel WHERE lieferantenbestellungsid=?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $this->conn->close();
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    //gibt alle Lieferantenbestellungen zurück
    function getLieferantenbestellungen() {
        $this->doConnect();
        $resultArray = array();
        /* $query = "SELECT lieferantenbestellungsid, lieferantid, bestellschein, zahlungsmethodeid "
          . "FROM lieferantenbestellung; ";
         * 
         */
        $query = "SELECT lieferantenbestellungsid, lieferantid, name, zahlungsmethode, abgeschlossen "
                . "FROM lieferantenbestellung "
                . "join lieferant using(lieferantid) "
                . "join zahlungsmethode using(zahlungsmethodeid) "
                . "order by lieferantenbestellungsId;";


        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($lieferantenbestellungsId, $lieferantId, $lieferantName, $zahlungsmethode, $abgeschlossen);
        while ($stmt->fetch()) {
            $lieferantenbestellung = new Lieferantenbestellung($lieferantenbestellungsId, $lieferantId, $lieferantName, null, $zahlungsmethode, $abgeschlossen);
            array_push($resultArray, $lieferantenbestellung);
        }
        $this->conn->close();
        return $resultArray;
    }

    function getLieferantenbestellung($lieferantenbestellungsid) {
        $this->doConnect();
        $query = "SELECT lieferantenbestellungsid, lieferantid, name, zahlungsmethodeid, zahlungsmethode, abgeschlossen "
                . "FROM lieferantenbestellung "
                . "JOIN lieferant using(lieferantid) "
                . "JOIN zahlungsmethode using(zahlungsmethodeid) "
                . "WHERE lieferantenbestellungsId = ?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $lieferantenbestellungsid);
        $stmt->execute();
        $stmt->bind_result($lieferantenbestellungsId, $lieferantId, $lieferantName, $zahlungsmethodeid, $zahlungsmethode, $abgeschlossen);
        while ($stmt->fetch()) {
            $lieferantenbestellung = new Lieferantenbestellung($lieferantenbestellungsId, $lieferantId, $lieferantName, $zahlungsmethodeid, $zahlungsmethode, $abgeschlossen);
        }
        $this->conn->close();
        return $lieferantenbestellung;
    }

    function insertLieferantenbestellung($lieferantenbestellung) {
        $this->doConnect();
        $query = "INSERT INTO lieferantenbestellung(LieferantId, ZahlungsmethodeId, abgeschlossen) VALUES(?,?,?);";
        $stmt = $this->conn->prepare($query);
        $lieferantId = $lieferantenbestellung->getLieferantId();
        $zahlungsmethodeId = $lieferantenbestellung->getZahlungsmethodeId();
        $abgeschlossen = $lieferantenbestellung->getAbgeschlossen();
        $stmt->bind_param("iii", $lieferantId, $zahlungsmethodeId, $abgeschlossen);
        $stmt->execute();
        $id = $this->conn->insert_id;
        $this->conn->close();
        return $id;
    }

    //gibt alle Positionen zu einer übergebenen Lieferantenbestellung als array zurück
    function getLieferantenartikel($lieferantenbestellungsId) {
        $this->doConnect();
        $resultArray = array();
        $query = "SELECT lieferantenbestellungsid, artikelId, artikelname, lieferantId, name, anzahl "
                . "FROM lieferantenartikel "
                . "join lieferantenbestellung using(lieferantenbestellungsID)"
                . "join lieferant using(lieferantid) "
                . "join artikel using(artikelid) "
                . "where lieferantenbestellungsid = ?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $lieferantenbestellungsId);
        $stmt->execute();
        $stmt->bind_result($lieferantenbestellungsId, $artikelId, $artikelName, $lieferantId, $lieferantName, $anzahl);
        while ($stmt->fetch()) {
            $lieferantenartikel = new Lieferantenartikel($lieferantenbestellungsId, null, $artikelId, $artikelName, $lieferantId, $lieferantName, $anzahl);
            array_push($resultArray, $lieferantenartikel);
        }
        $this->conn->close();
        return $resultArray;
    }

    function insertLieferantenartikel($lieferantenartikel) {
        $this->doConnect();
        $query = "INSERT INTO lieferantenartikel VALUES(?,?,?);";
        $stmt = $this->conn->prepare($query);
        $anzahl = $lieferantenartikel->getAnzahl();
        $artikelId = $lieferantenartikel->getArtikelId();
        $lieferantenbestellungsId = $lieferantenartikel->getLieferantenbestellungsId();
        $stmt->bind_param("iii", $anzahl, $artikelId, $lieferantenbestellungsId);
        $stmt->execute();
        $return = $this->conn->errno;
        $this->conn->close();
        if ($return == 0) {
            return true;
        }
        return false;
    }

    function getOffeneBestellungen() {
        $this->doConnect();
        $resultArray = array();
        $query = "select lieferantenbestellungsID, lieferantid, name, zahlungsmethode "
                . "from lieferantenbestellung join lieferant using(lieferantid) join zahlungsmethode using(zahlungsmethodeid)"
                . " where abgeschlossen = 0 "
                . "order by lieferantenbestellungsId;";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        $stmt->bind_result($lieferantenbestellungsId, $lieferantId, $lieferantName, $zahlungsmethode);
        while ($stmt->fetch()) {
            $offeneBestellungen = new Lieferantenbestellung($lieferantenbestellungsId, $lieferantId, $lieferantName, null, $zahlungsmethode, null);
            array_push($resultArray, $offeneBestellungen);
        }
        //die klasse "Lieferantenbestellung" kann eigentlich auch dafür verwendet werden.
        $this->conn->close();
        return $resultArray;
    }

    function countOffeneBestellungenToArtikel($artikel) {
        $this->doConnect();
        $query = "select count(*) "
                . "from artikel "
                . "inner join lieferantenartikel using(artikelid) "
                . "inner join lieferantenbestellung using(lieferantenbestellungsId) "
                . "where artikelid=? and abgeschlossen = 0;";
        $stmt = $this->conn->prepare($query);
        $artikelId = $artikel->getArtikelId();
        $stmt->bind_param("i", $artikelId);
        $stmt->execute();
        $stmt->bind_result($count);
        while ($stmt->fetch()) {
            $number = $count;
        }
        $this->conn->close();
        return $number;
    }

    //muss noch angepasst werden
    function artikelAnlegen() {
        $this->doConnect();
        $artikelname = $_GET['artikelname'];
        $einkaufspreis = $_GET['einkaufspreis'];
        $mindestbestand = $_GET['mindestbestand'];
        $aufschlag = 0;
        $umsatzsteuerid = $_GET['umsatzsteuer'];
        $query = "SELECT Aufschlag "
                . "FROM aufschlag;";
        //echo $query;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($aufschlag1);
        while ($stmt->fetch()) {
            $aufschlag = $aufschlag1;
        }
        //echo $aufschlag;
        //echo $query;
        // $stmt=$this->conn->prepare($query);
        //$stmt->execute();
        //$stmt->bind_result($id);
        //while($stmt->fetch()){
        // $artikelid=$id+1;  
        //}


        $verkaufspreis = $einkaufspreis * $aufschlag + $einkaufspreis;
        $lagerstand = 0;
        $lagerort = $_GET['lagerort'];
        $aktiv = 1;


        $sql = "Insert INTO `artikel` (`Artikelname`, `Einkaufspreis`, `Verkaufspreis`, `Mindestbestand`, `Aufschlag`, `Lagerstand`, `Lagerort`, `UmsatzsteuerId`, `Aktiv`) VALUES (?,?,?,?,?,?,?,?,?);";
        //echo $sql;
        //echo "<br>";
        //echo $artikelname.",".$einkaufspreis.",".$verkaufspreis.",".$mindestbestand.",".$aufschlag.",".$lagerstand.",".$lagerort.",".$umsatzsteuerid.",".$aktiv;
        $eintrag = $this->conn->prepare($sql);

        $eintrag->bind_param("sddidisii", $artikelname, $einkaufspreis, $verkaufspreis, $mindestbestand, $aufschlag, $lagerstand, $lagerort, $umsatzsteuerid, $atkiv);
        //echo "<br>";
        //var_dump($eintrag);


        $eintrag->execute();


        echo "<br>";
        echo "Artikel erfolgreich angelegt";

        $this->conn->close();
    }

    function updateArtikel() {
        $this->doConnect();
        $artikelid = $_POST['artikelid'];
        $artikelname = $_POST['artikelname'];
        $einkaufspreis = $_POST['einkaufspreis'];
        $mindestbestand = $_POST['mindestbestand'];
        $aufschlag = 0;
        $umsatzsteuerid = $_POST['umsatzsteuer'];
        $query = "SELECT Aufschlag "
                . "FROM aufschlag;";
        //echo $query;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($aufschlag1);
        while ($stmt->fetch()) {
            $aufschlag = $aufschlag1;
        }

        $verkaufspreis = $einkaufspreis * $aufschlag + $einkaufspreis;
        $lagerstand = 0;
        $lagerort = $_POST['lagerort'];
        $aktiv = 1;

        $sql = "update artikel set Artikelname=?, Einkaufspreis=?, Verkaufspreis=?, Mindestbestand=?, Lagerstand=?, Lagerort=?, UmsatzsteuerId=? where artikelID=?;";
        $eintrag = $this->conn->prepare($sql);

        $eintrag->bind_param("sddisii", $artikelname, $einkaufspreis, $verkaufspreis, $mindestbestand, $lagerort, $umsatzsteuerid, $artikelid);

        $eintrag->execute();
        echo "<br>";
        echo "Artikel erfolgreich aktualisiert";

        $this->conn->close();
    }

    function getUmsatzsteuer() {
        $this->doConnect();
        $resultArray = array();
        $query = "SELECT * from umsatzsteuer";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $steuersatz);
        $i = 0;
        while ($stmt->fetch()) {
            $ust = new Ust($id, $steuersatz); //wo ist die klasse "Ust" ?
            array_push($resultArray, $ust);
        }

        $this->conn->close();
        return $resultArray; //reihenfolge der beiden vertauscht
    }

    function getZahlungsmethode() {
        $this->doConnect();
        $resultArray = array();
        $query = "SELECT zahlungsmethodeid, zahlungsmethode from zahlungsmethode";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($zahlungsmethodeid, $zahlungsmethodename);
        while ($stmt->fetch()) {
            $zahlungsmethode = new Zahlungsmethode($zahlungsmethodeid, $zahlungsmethodename);
            array_push($resultArray, $zahlungsmethode);
        }
        $this->conn->close();
        return $resultArray;
    }

    function getZahlungsmethodeById($id) {
        $this->doConnect();
        //$resultArray = array();
        $query = "SELECT zahlungsmethodeid, zahlungsmethode from zahlungsmethode where zahlungsmethodeid = ?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($zahlungsmethodeid, $zahlungsmethodename);
        while ($stmt->fetch()) {
            $zahlungsmethode = new Zahlungsmethode($zahlungsmethodeid, $zahlungsmethodename);
            //array_push($resultArray, $zahlungsmethode);
        }
        $this->conn->close();
        return $zahlungsmethode;
    }

    function getFirstZahlungsmethodeId() {
        $this->doConnect();
        $query = "SELECT zahlungsmethodeid "
                . "FROM zahlungsmethode "
                . "LIMIT 1;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($zahlungsmethodeId);
        while ($stmt->fetch()) {
            $id = $zahlungsmethodeId;
        }
        $this->conn->close();
        return $id;
    }

    function lieferantenbestellungErfassen($lieferantenid, $artikelArray, $artikelMengeArray, $zahlungsmethodeid) {
        //im artikelarray sind lieferantId, name, artikelId, artikelname, man darf aber nur artikelid verwenden!
        $this->doConnect();
        $abgeschlossen = 1;
        $artikelid = array();

        foreach ($artikelArray as $a) {
            $artikelid[] = $a->getArtikelId();
        }
        $intArtikelArray = array_map(
                function($value) {
            return (int) $value;
        }, $artikelid);
        //zuerst insert in lieferbestellung dann in lieferantenartikel (mit foreach)
        $query = "Insert INTO lieferantenbestellung (LieferantId, ZahlungsmethodeId, abgeschlossen) VALUES (?,?,?);";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iii", $lieferantenid, $zahlungsmethodeid, $abgeschlossen);
        $stmt->execute();
        //insert in lieferantenartikel vornehmen, abfragen ob anzahl > 0
        $cnt = 0;
        $lastId = $this->getLieferantenbestellungsIdLast();
        foreach ($intArtikelArray as $x) {
            if ($artikelMengeArray[$cnt] > 0) {
                $this->doConnect();
                $query1 = "Insert into lieferantenartikel (Anzahl, ArtikelID, LieferantenbestellungsID) values (?,?,?);";
                $stmt1 = $this->conn->prepare($query1);
                $stmt1->bind_param("iii", $artikelMengeArray[$cnt], $x, $lastId); //wie krieg ich die lieferantenbestellungsid? kompliziert und fehleranfällig gelöst
                $stmt1->execute();
                $this->conn->close();
            }
            $cnt ++;
        }
        //$this->conn->close();
    }

    function getLieferantenbestellungsIdLast() {
        $this->doConnect();
        $query = "select max(lieferantenbestellungsid) from lieferantenbestellung;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($maxid);
        while ($stmt->fetch()) {
            $id = $maxid;
        }
        $this->conn->close();
        return $id;
    }

    function getZahlungsbedingungen() {
        $this->doConnect();
        $resultArray = array();
        $query = "select * from zahlungsbedingungen;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($zahlungsbedingungenId, $skonto, $rabatt, $zahlungszieltage);
        while ($stmt->fetch()) {
            $zahlungsbedingung = new Zahlungsbedingungen($zahlungsbedingungenId, $skonto, $rabatt, $zahlungszieltage);
            array_push($resultArray, $zahlungsbedingung);
        }
        $this->conn->close();
        return $resultArray;
    }

    function getLieferbedingungen() {
        $this->doConnect();
        $resultArray = array();
        $query = "select lieferbedingungId, kosten, typ, transportart "
                . "from lieferbedingungen "
                . "inner join incoterms using(incotermsid) "
                . "inner join transportart using(transportartid);";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($lieferbedingungenId, $kosten, $incoterms, $transportart);
        while ($stmt->fetch()) {
            $lieferbedingungen = new Lieferbedingungen($lieferbedingungenId, $kosten, $incoterms, $transportart);
            array_push($resultArray, $lieferbedingungen);
        }
        $this->conn->close();
        return $resultArray;
    }

    function getOrt() {
        $this->doConnect();
        $resultArray = array();
        $query = "select ortid, plz, ort.bezeichnung, land.kennzeichen, land.bezeichnung "
                . "from ort "
                . "inner join land using(landid);";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($ortId, $plz, $bezeichnung, $landKennzeichen, $landBezeichnung);
        while ($stmt->fetch()) {
            $ort = new Ort($ortId, $plz, $bezeichnung, $landKennzeichen, $landBezeichnung);
            array_push($resultArray, $ort);
        }
        $this->conn->close();
        return $resultArray;
    }

    function testTabelle($anzahl) {
        $this->doConnect();
        $query = "INSERT INTO testtab VALUES(?);";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $anzahl);
        $stmt->execute();
        $this->conn->close();
    }

    function getKontaktperson($id) {
        $this->doConnect();
        $query = "select kontaktpersonId, vorname, nachname, telefonnummer, lieferantid "
                . "from kontaktperson "
                . "where kontaktpersonid = ?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($kontaktpersonid, $vorname, $nachname, $telefonnummer, $lieferantid);
        while ($stmt->fetch()) {
            $person = new LieferantenKontaktperson($kontaktpersonId, $vorname, $nachname, $telefonnummer, $lieferantId);
        }
        $this->conn->close();
        return $person;
    }

    function insertKontaktperson($lieferantenkontaktperson) {
        $this->doConnect();
        $query = "insert into lieferantenkontaktperson(vorname, nachname, telefonnummer, lieferantid) values(?,?,?,?);";
        $stmt = $this->conn->prepare($query);
        $vorname = $lieferantenkontaktperson->getVorname();
        $nachname = $lieferantenkontaktperson->getNachname();
        $telefonnummer = $lieferantenkontaktperson->getTelefonnummer();
        $lieferantId = $lieferantenkontaktperson->getLieferantId();
        $stmt->bind_param("sssi", $vorname, $nachname, $telefonnummer, $lieferantId);
        $stmt->execute();
        $id = $this->conn->insert_id;
        $this->conn->close();
        return $id;
    }

    function updateKontaktperson($kontaktperson) {
        $this->doConnect();
        $query = "update lieferantenkontaktperson set vorname=?, nachname=?, telefonnummer=? where kontaktpersonId=?;";
        $stmt = $this->conn->prepare($query);
        $vorname = $kontaktperson->getVorname();
        $nachname = $kontaktperson->getNachname();
        $telefonnummer = $kontaktperson->getTelefonnummer();
        $kontaktpersonId = $kontaktperson->getKontaktpersonId();
        $stmt->bind_param("sssi", $vorname, $nachname, $telefonnummer, $kontaktpersonId);
        $stmt->execute();
        $err = $this->conn->errno;
        $this->conn->close();
        if ($err == 0) {
            return true;
        }
        return false;
    }

    /* function writeMitarbeiter($mitarbeiter) {
      $this->doConnect();
      $query = "INSERT INTO mitarbeiter VALUES(?,?,?,?,?)";
      $stmt = $this->conn->prepare($query);
      $id = $mitarbeiter->getPersonalid();
      $vorname = $mitarbeiter->getVorname();
      $nachname = $mitarbeiter->getNachname();
      $geburtsdatum = $mitarbeiter->getGeburtsdatum();
      $beruf = $mitarbeiter->getBeruf();
      $stmt->bind_param("issss", $id, $vorname, $nachname, $beruf, $geburtsdatum);
      $stmt->execute();
      $this->conn->close();
      } */
}

?>
