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
        $query = "SELECT lieferantId, name, telefonnummer, strasse, plz, Ort.bezeichnung, Land.bezeichnung, aktiv "
                . "FROM lieferant "
                . "join ort using(ortid) "
                . "join land using(landid);";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($lieferantId, $name, $telefonnummer, $strasse, $plz, $ort, $land, $aktiv);
        while ($stmt->fetch()) {
            $lieferant = new Lieferant($lieferantId, $name, $telefonnummer, $strasse, $plz, $ort, $land, $aktiv);
            array_push($resultArray, $lieferant);
        }
        $this->conn->close();
        return $resultArray;
    }

    //Funktion returned ein Array bestehend aus allen Artikeln
    function getArtikel() {
        $this->doConnect();
        $resultArray = array();
        $query = "SELECT artikelId, artikelname, einkaufspreis, verkaufspreis, mindestbestand, lagerstandverfügbar, lagerstandaktuell FROM artikel";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($artikelId, $einkaufspreis, $verkaufspreis, $mindestbestand, $lagerstandVerfuegbar, $lagerstandAktuell);
        while ($stmt->fetch()) {
            $artikel = new Artikel($artikelId, $einkaufspreis, $verkaufspreis, $mindestbestand, $lagerstandVerfuegbar, $lagerstandAktuell);
            array_push($resultArray, $artikel);
        }
        $this->conn->close();
        return $resultArray;
    }
    
    //gibt alle Lieferantenbestellungen zurück
    function getLieferantenbestellung() {
        $this->doConnect();
        $resultArray = array();
        $query = "SELECT lieferantenbestellungsid, lieferantid, name, zahlungsmethode "
                . "FROM lieferantenbestellung "
                . "join lieferant using(lieferantid) "
                . "join zahlungsmethode using(zahlungsmethodeid);";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($lieferantenbestellungsId, $lieferantId, $lieferantName, $zahlungsmethode);
        while ($stmt->fetch()) {
            $lieferantenbestellung = new Lieferantenbestellung($lieferantenbestellungsId, $lieferantId, $lieferantName, $zahlungsmethode);
            array_push($resultArray, $lieferantenbestellung);
        }
        $this->conn->close();
        return $resultArray;
    }
    
    //gibt alle Positionen zu einer übergebenen Lieferantenbestellung als array zurück
    function getLieferantenartikel($lieferantenbestellungsId) {
        $this->doConnect();
        $resultArray = array();
        $query = "SELECT lieferantenbestellungsid, artikelId, artikelname, lieferantId, name, anzahl "
                . "FROM lieferantenartikel "
                . "join lieferant using(lieferantid) "
                . "join artikel using(artikelid) "
                . "where lieferantenbestellungid = ?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $lieferantenbestellungsId);
        $stmt->execute();
        $stmt->bind_result($lieferantenbestellungsId, $artikelId, $artikelName, $lieferantId, $lieferantName, $anzahl);
        while ($stmt->fetch()) {
            $lieferantenartikel = new Lieferantenbestellung($lieferantenbestellungsId, $lieferantId, $lieferantName, $zahlungsmethode);
            array_push($resultArray, $lieferantenartikel);
        }
        $this->conn->close();
        return $resultArray;
    }
    
    function getMitarbeiter($id) {
        $this->doConnect();
        $query = "SELECT * FROM mitarbeiter WHERE personalID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($personalid, $vorname, $nachname, $beruf, $geburtsdatum);
        $stmt->fetch();
        if ($personalid == null && $vorname == null && $nachname == null && $geburtsdatum == null && $beruf == null) {
            $this->conn->close();
            return false;
        }
        $mitarbeiter = new Mitarbeiter($personalid, $vorname, $nachname, $geburtsdatum, $beruf);
        $this->conn->close();
        return $mitarbeiter;
    }

    function writeMitarbeiter($mitarbeiter) {
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
    }

}

?>