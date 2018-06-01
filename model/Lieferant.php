<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Lieferant
 *
 * @author AlexB
 */
class Lieferant {
    private $lieferantenId;
    private $name;
    private $telefonnummer;
    private $strasse;
    private $plz;
    private $ort;
    private $land;
    private $land_kennzeichen;
    private $aktiv;
    
    function getLieferantenId() {
        return $this->lieferantenId;
    }

    function getName() {
        return $this->name;
    }

    function getTelefonnummer() {
        return $this->telefonnummer;
    }

    function getStrasse() {
        return $this->strasse;
    }

    function getPlz() {
        return $this->plz;
    }

    function getOrt() {
        return $this->ort;
    }

    function getLand() {
        return $this->land;
    }

    function getLand_kennzeichen() {
        return $this->land_kennzeichen;
    }

    function getAktiv() {
        return $this->aktiv;
    }

    function setLieferantenId($lieferantenId) {
        $this->lieferantenId = $lieferantenId;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setTelefonnummer($telefonnummer) {
        $this->telefonnummer = $telefonnummer;
    }

    function setStrasse($strasse) {
        $this->strasse = $strasse;
    }

    function setPlz($plz) {
        $this->plz = $plz;
    }

    function setOrt($ort) {
        $this->ort = $ort;
    }

    function setLand($land) {
        $this->land = $land;
    }

    function setLand_kennzeichen($land_kennzeichen) {
        $this->land_kennzeichen = $land_kennzeichen;
    }

    function setAktiv($aktiv) {
        $this->aktiv = $aktiv;
    }

    function __construct($lieferantenId, $name, $telefonnummer, $strasse, $plz, $ort, $land, $land_kennzeichen, $aktiv) {
        $this->lieferantenId = $lieferantenId;
        $this->name = $name;
        $this->telefonnummer = $telefonnummer;
        $this->strasse = $strasse;
        $this->plz = $plz;
        $this->ort = $ort;
        $this->land = $land;
        $this->land_kennzeichen = $land_kennzeichen;
        $this->aktiv = $aktiv;
    }

    
    
}
