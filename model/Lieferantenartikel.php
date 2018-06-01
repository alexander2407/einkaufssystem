<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Lieferantenartikel
 *
 * @author AlexB
 */
class Lieferantenartikel {
    private $lieferantenbestellungsId;
    private $lieferantenlieferungsId;       //zum einfügen in DAtenbank, kA. was da genau drinnen stehen soll
    private $artikelId;
    private $artikelName;
    private $lieferantId;
    private $lieferantName;
    private $anzahl;
    
        
    function getLieferantenlieferungsId() {
        return $this->lieferantenlieferungsId;
    }

    function setLieferantenlieferungsId($lieferantenlieferungsId) {
        $this->lieferantenlieferungsId = $lieferantenlieferungsId;
    }

        
    function getLieferantenbestellungsId() {
        return $this->lieferantenbestellungsid;
    }

    function setLieferantenbestellungsId($lieferantenbestellungsId) {
        $this->lieferantenbestellungsId = $lieferantenbestellungsId;
    }

        
    function getArtikelId() {
        return $this->artikelId;
    }

    function getArtikelName() {
        return $this->artikelName;
    }

    function getLieferantId() {
        return $this->lieferantId;
    }

    function getLieferantName() {
        return $this->lieferantName;
    }

    function getAnzahl() {
        return $this->anzahl;
    }

    function setArtikelId($artikelId) {
        $this->artikelId = $artikelId;
    }

    function setArtikelName($artikelName) {
        $this->artikelName = $artikelName;
    }

    function setLieferantId($lieferantId) {
        $this->lieferantId = $lieferantId;
    }

    function setLieferantName($lieferantName) {
        $this->lieferantName = $lieferantName;
    }

    function setAnzahl($anzahl) {
        $this->anzahl = $anzahl;
    }

    function __construct($lieferantenbestellungsId, $lieferantenlieferungsId, $artikelId, $artikelName, $lieferantId, $lieferantName, $anzahl) {
        $this->lieferantenbestellungsId = $lieferantenbestellungsId;
        $this->lieferantenlieferungsId = $lieferantenlieferungsId;
        $this->artikelId = $artikelId;
        $this->artikelName = $artikelName;
        $this->lieferantId = $lieferantId;
        $this->lieferantName = $lieferantName;
        $this->anzahl = $anzahl;
    }


}
