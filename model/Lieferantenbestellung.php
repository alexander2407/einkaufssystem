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
    private $lieferantenbestellungId;   //id   
    private $lieferantId;               //lieferantenId
    private $lieferantName;             //Lieferantenname
    private $zahlungsmethode;           //Zahlungsmethode String
    
    function getLieferantenbestellungId() {
        return $this->lieferantenbestellungId;
    }

    function getLieferantId() {
        return $this->lieferantId;
    }

    function getLieferantName() {
        return $this->lieferantName;
    }

    function getZahlungsmethode() {
        return $this->zahlungsmethode;
    }

    function setLieferantenbestellungId($lieferantenbestellungId) {
        $this->lieferantenbestellungId = $lieferantenbestellungId;
    }

    function setLieferantId($lieferantId) {
        $this->lieferantId = $lieferantId;
    }

    function setLieferantName($lieferantName) {
        $this->lieferantName = $lieferantName;
    }

    function setZahlungsmethode($zahlungsmethode) {
        $this->zahlungsmethode = $zahlungsmethode;
    }

    function __construct($lieferantenbestellungId, $lieferantId, $lieferantName, $zahlungsmethode) {
        $this->lieferantenbestellungId = $lieferantenbestellungId;
        $this->lieferantId = $lieferantId;
        $this->lieferantName = $lieferantName;
        $this->zahlungsmethode = $zahlungsmethode;
    }

}
