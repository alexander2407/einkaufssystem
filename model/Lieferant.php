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
    private $lieferantId;
    private $name;
    private $telefonnummer;
    private $strasse;
    private $hausnummer;
    private $plz;
    private $ort;
    private $land;
    private $aktiv;
    
    function getLieferantId() {
        return $this->lieferantId;
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

    function getHausnummer() {
        return $this->hausnummer;
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

    function getAktiv() {
        return $this->aktiv;
    }

    function setLieferantId($lieferantId) {
        $this->lieferantId = $lieferantId;
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

    function setHausnummer($hausnummer) {
        $this->hausnummer = $hausnummer;
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

    function setAktiv($aktiv) {
        $this->aktiv = $aktiv;
    }

    function __construct($lieferantId, $name, $telefonnummer, $strasse, $hausnummer, $plz, $ort, $land, $aktiv) {
        $this->lieferantId = $lieferantId;
        $this->name = $name;
        $this->telefonnummer = $telefonnummer;
        $this->strasse = $strasse;
        $this->hausnummer = $hausnummer;
        $this->plz = $plz;
        $this->ort = $ort;
        $this->land = $land;
        $this->aktiv = $aktiv;
    }


    
    
}
