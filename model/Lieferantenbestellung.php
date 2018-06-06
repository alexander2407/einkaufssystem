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
    private $lieferantName;             //Lieferantenname
    private $zahlungsmethodeId;         
    private $zahlungsmethode;           //Zahlungsmethode String
    private $abgeschlossen;
    
    function getLieferantenbestellungsId() {
        return $this->lieferantenbestellungsId;
    }

    function getLieferantId() {
        return $this->lieferantId;
    }

    function getLieferantName() {
        return $this->lieferantName;
    }

    function getZahlungsmethodeId() {
        return $this->zahlungsmethodeId;
    }

    function getZahlungsmethode() {
        return $this->zahlungsmethode;
    }

    function getAbgeschlossen() {
        return $this->abgeschlossen;
    }

    function setLieferantenbestellungsId($lieferantenbestellungsId) {
        $this->lieferantenbestellungsId = $lieferantenbestellungsId;
    }

    function setLieferantId($lieferantId) {
        $this->lieferantId = $lieferantId;
    }

    function setLieferantName($lieferantName) {
        $this->lieferantName = $lieferantName;
    }

    function setZahlungsmethodeId($zahlungsmethodeId) {
        $this->zahlungsmethodeId = $zahlungsmethodeId;
    }

    function setZahlungsmethode($zahlungsmethode) {
        $this->zahlungsmethode = $zahlungsmethode;
    }

    function setAbgeschlossen($abgeschlossen) {
        $this->abgeschlossen = $abgeschlossen;
    }

    function __construct($lieferantenbestellungsId, $lieferantId, $lieferantName, $zahlungsmethodeId, $zahlungsmethode, $abgeschlossen) {
        $this->lieferantenbestellungsId = $lieferantenbestellungsId;
        $this->lieferantId = $lieferantId;
        $this->lieferantName = $lieferantName;
        $this->zahlungsmethodeId = $zahlungsmethodeId;
        $this->zahlungsmethode = $zahlungsmethode;
        $this->abgeschlossen = $abgeschlossen;
    }

}
