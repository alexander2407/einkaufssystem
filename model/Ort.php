<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ort
 *
 * @author AlexB
 */
class Ort {
    private $ortId;
    private $plz;
    private $bezeichnung;
    private $landKennzeichen;
    private $landBezeichnung;
    
    function __construct($ortId, $plz, $bezeichnung, $landKennzeichen, $landBezeichnung) {
        $this->ortId = $ortId;
        $this->plz = $plz;
        $this->bezeichnung = $bezeichnung;
        $this->landKennzeichen = $landKennzeichen;
        $this->landBezeichnung = $landBezeichnung;
    }

    function getOrtId() {
        return $this->ortId;
    }

    function getPlz() {
        return $this->plz;
    }

    function getBezeichnung() {
        return $this->bezeichnung;
    }

    function getLandKennzeichen() {
        return $this->landKennzeichen;
    }

    function getLandBezeichnung() {
        return $this->landBezeichnung;
    }

    function setOrtId($ortId) {
        $this->ortId = $ortId;
    }

    function setPlz($plz) {
        $this->plz = $plz;
    }

    function setBezeichnung($bezeichnung) {
        $this->bezeichnung = $bezeichnung;
    }

    function setLandKennzeichen($landKennzeichen) {
        $this->landKennzeichen = $landKennzeichen;
    }

    function setLandBezeichnung($landBezeichnung) {
        $this->landBezeichnung = $landBezeichnung;
    }


}
