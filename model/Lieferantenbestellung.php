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
    private $zahlungsmethode;           //Zahlungsmethode String
    
    function getLieferantenbestellungId() {
        return $this->lieferantenbestellungsId;
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

    function setLieferantenbestellungId($lieferantenbestellungsId) {
        $this->lieferantenbestellungsId = $lieferantenbestellungsId;
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

    function __construct($lieferantenbestellungsId, $lieferantId, $lieferantName, $zahlungsmethode) {
        $this->lieferantenbestellungsId = $lieferantenbestellungsId;
        $this->lieferantId = $lieferantId;
        $this->lieferantName = $lieferantName;
        $this->zahlungsmethode = $zahlungsmethode;
    }

}
