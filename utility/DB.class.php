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
                . "join land using(landid);";
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
        $query = "SELECT lieferantId, name, lieferant.Telefonnummer, strasse, hausnummer, plz, Ort.bezeichnung, Land.bezeichnung, kennzeichen, aktiv, skonto, rabatt, zahlungszieltage, kosten, typ, transportart, vorname, nachname, LieferantenKontaktperson.telefonnummer "
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
        $stmt->bind_result($lieferantId, $name, $telefonnummer, $strasse, $hausnummer, $plz, $ort, $land, $land_kennzeichen, $aktiv, $skonto, $rabatt, $zahlungsziel, $lieferkosten, $incoterms, $transportart, $kontakt_vorname, $kontakt_nachname, $kontakt_telefonnummer);
        while ($stmt->fetch()) {
            $lieferant = new LieferantDetail($lieferantId, $name, $telefonnummer, $strasse, $hausnummer, null, $plz, $ort, null, $land, $land_kennzeichen, $aktiv, null, $skonto, $rabatt, $zahlungsziel, null, $lieferkosten, $incoterms, $transportart, null, $kontakt_vorname, $kontakt_nachname, $kontakt_telefonnummer);
        }
        $this->conn->close();
        return $lieferant;
    }
    
    //gibt den ersten Lieferant zu einem Artikel zurück
    function getFirstLieferantIdToArtikel($artikelId){
        $this->doConnect();
        $query = "SELECT lieferantId "
                . "FROM lieferantliefert "
                . "WHERE artikelid=? "
                . "LIMIT 1;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i",$artikelId);
        $stmt->execute();
        $stmt->bind_result($lieferantId);
        while($stmt->fetch()){
            $id = $lieferantId;
        }
        $this->conn->close();
        return $id;
    }
    
    //gibt eine Liste der Artikel welche von einem Lieferant geliefert werden können zurück, in Form eines LieferantLiefert Objektes
    function getArtikelByLieferant($lieferantId){
        $this->doConnect();
        $resultArray = array();
        $query = "SELECT lieferantId, name, artikelId, artikelname "
                . "FROM lieferantliefert "
                . "JOIN lieferant using(lieferantid) "
                . "JOIN artikel using(artikelid) "
                . "WHERE lieferantid=?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i",$lieferantId);
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
        $query = "SELECT artikelId, artikelname, einkaufspreis, verkaufspreis, mindestbestand, aufschlag, lagerstand, lagerort, steuersatz, aktiv FROM artikel JOIN"
                . " umsatzsteuer using(umsatzsteuerid);";
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
                . "FROM artikel join umsatzsteuer using(umsatzsteuerid) WHERE mindestbestand > lagerstand;";
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
    
    function getLieferantByArtikel($artikelId){
        $this->doConnect();
        $resultArray = array();
        $query = "SELECT lieferantId, name, artikelId, artikelname "
                . "FROM lieferantliefert "
                . "JOIN lieferant using(lieferantid) "
                . "JOIN artikel using(artikelid) "
                . "WHERE artikelid=?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i",$artikelId);
        $stmt->execute();
        $stmt->bind_result($lieferantId, $name, $artikelId, $artikelname);
        while ($stmt->fetch()) {
            $lieferantliefert = new LieferantLiefert($lieferantId, $artikelId, $name, $artikelname);
            array_push($resultArray, $lieferantliefert);
        }
        $this->conn->close();
        return $resultArray;
    }
    
    function deleteArtikel($id){
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
        if($stmt){
           return true; 
        }
        else{
            return false;
        }
    }
     //es muss nur aus der Tabelle lieferantenbestellung gelöscht werden
    function deleteBestellung($id){
        $this->doConnect();
        $query = "DELETE FROM lieferantenbestellung WHERE lieferantenbestellungsid=?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->conn->close();
        if($stmt){
           return true; 
        }
        else{
            return false;
        }
        
    }

    //gibt alle Lieferantenbestellungen zurück
    function getLieferantenbestellungen() {
        $this->doConnect();
        $resultArray = array();
        /*$query = "SELECT lieferantenbestellungsid, lieferantid, bestellschein, zahlungsmethodeid "
                . "FROM lieferantenbestellung; ";
         * 
         */
        $query = "SELECT lieferantenbestellungsid, lieferantid, name, zahlungsmethode, abgeschlossen "
                . "FROM lieferantenbestellung "
                . "join lieferant using(lieferantid) "
                . "join zahlungsmethode using(zahlungsmethodeid);";
        
         
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
    
    function insertLieferantenbestellung($lieferantenbestellung){
        $this->doConnect();
        $query = "INSERT INTO lieferantenbestellung(LieferantId, ZahlungsmethodeId, abgeschlossen) VALUES(?,?,?);";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iii", $lieferantenbestellung->getLieferantId(), $lieferantenbestellung->getZahlungsmethodeId(), $lieferantenbestellung->getAbgeschlossen());
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
                . "join lieferant using(lieferantid) "
                . "join artikel using(artikelid) "
                . "where lieferantenbestellungid = ?;";
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
    
    function insertLieferantenartikel($lieferantenartikel){
        $this->doConnect();
        $query = "INSERT INTO lieferantenartikel VALUES(?,?,?);";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iii", $lieferantenartikel->getAnzahl(), $lieferantenartikel->getArtikelId(), $lieferantenartikel->getLieferantenbestellungsId());
        $stmt->execute();
        $return = $this->conn->errno;
        $this->conn->close();
        if($return == 0){
            return true;
        }
        return false;
    }
    
    function getOffeneBestellungen(){
        $this->doConnect();
        $resultArray = array();
        $query = "select lieferantenbestellungsID, lieferantid, name, zahlungsmethode "
                . "from lieferantenbestellung join lieferant using(lieferantid) join zahlungsmethode using(zahlungsmethodeid)"
                . " where abgeschlossen = 1;";
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
    
    //muss noch angepasst werden
    function artikelAnlegen(){
        $this->doConnect();
        $artikelname=$_GET['artikelname'];
        $einkaufspreis=$_GET['einkaufspreis'];
        $mindestbestand=$_GET['mindestbestand'];
        $aufschlag=0;
        $artikelid=0;
        $query = "SELECT Aufschlag "
                . "FROM aufschlag;";
        //echo $query;
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($aufschlag1);
        while($stmt->fetch()){
          $aufschlag=$aufschlag1;  
        }
        //echo $aufschlag;
        
        $query = "SELECT max(ArtikelID) "
                . "FROM Artikel;";
        //echo $query;
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id);
        while($stmt->fetch()){
          $artikelid=$id+1;  
        }
        
        
        $verkaufspreis=$einkaufspreis*$aufschlag+$einkaufspreis;
        $lagerstandVerfuegbar=0;
        $lagerstandAktuell=0;
        
        
        
        $sql="Insert INTO `artikel` (`ArtikelID`, `Artikelname`, `Einkaufspreis`, `Verkaufspreis`, `Mindestbestand`, `Aufschlag`, `LagerstandVerfuegbar`, `LagerstandAktuell`) VALUES (?,?,?,?,?,?,?,?)";
        $eintrag = $this->conn->prepare($sql);
        
        $eintrag->bind_param("isddidii",$artikelid,$artikelname,$einkaufspreis,$verkaufspreis,$mindestbestand,$aufschlag,$lagerstandVerfuegbar,$lagerstandAktuell);
        
        $eintrag->execute();
        
        echo "Artikel erfolgreich angelegt";
        
        $this->conn->close();
        
        
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
        $resultArray = array();
        $query = "SELECT zahlungsmethodeid, zahlungsmethode from zahlungsmethode where zahlungsmethodeid = ?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($zahlungsmethodeid, $zahlungsmethodename);
        while ($stmt->fetch()) {
            $zahlungsmethode = new Zahlungsmethode($zahlungsmethodeid, $zahlungsmethodename);
            array_push($resultArray, $zahlungsmethode);
        }
        $this->conn->close();
        return $resultArray;
    }
    
    function getFirstZahlungsmethodeId(){
        $this->doConnect();
        $query = "SELECT zahlungsmethodeid "
                . "FROM zahlungsmethode "
                . "LIMIT 1;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($zahlungsmethodeId);
        while($stmt->fetch()){
            $id = $zahlungsmethodeId;
        }
        $this->conn->close();
        return $id;
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
