<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Lieferantenbestellung
 *
 * @author AlexB
 */
class Lieferantenbestellung {
    private $lieferantenbestellungsId;   //id   
    private $lieferantId;               //lieferantenId
    private $bestellschein;             //für die Eingabe in die Datenbank
    private $lieferantName;             //Lieferantenname
    private $zahlungsmethodeId;
    private $zahlungsmethode;           //Zahlungsmethode String
    
    function getZahlungsmethodeId() {
        return $this->zahlungsmethodeId;
    }

    function setZahlungsmethodeId($zahlungsmethodeId) {
        $this->zahlungsmethodeId = $zahlungsmethodeId;
    }

        
    function getLieferantenbestellungsId() {
        return $this->lieferantenbestellungsId;
    }

    function getLieferantId() {
        return $this->lieferantId;
    }

    function getBestellschein() {
        return $this->bestellschein;
    }

    function getLieferantName() {
        return $this->lieferantName;
    }

    function getZahlungsmethode() {
        return $this->zahlungsmethode;
    }

    function setLieferantenbestellungsId($lieferantenbestellungsId) {
        $this->lieferantenbestellungsId = $lieferantenbestellungsId;
    }

    function setLieferantId($lieferantId) {
        $this->lieferantId = $lieferantId;
    }

    function setBestellschein($bestellschein) {
        $this->bestellschein = $bestellschein;
    }

    function setLieferantName($lieferantName) {
        $this->lieferantName = $lieferantName;
    }

    function setZahlungsmethode($zahlungsmethode) {
        $this->zahlungsmethode = $zahlungsmethode;
    }

    function __construct($lieferantenbestellungsId, $lieferantId, $bestellschein, $lieferantName, $zahlungsmethodeId, $zahlungsmethode) {
        $this->lieferantenbestellungsId = $lieferantenbestellungsId;
        $this->lieferantId = $lieferantId;
        $this->bestellschein = $bestellschein;
        $this->lieferantName = $lieferantName;
        $this->zahlungsmethodeId = $zahlungsmethodeId;
        $this->zahlungsmethode = $zahlungsmethode;
    }


}
