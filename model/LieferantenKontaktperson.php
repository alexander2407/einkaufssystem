<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LieferantenKontaktperson
 *
 * @author AlexB
 */
class LieferantenKontaktperson {
    private $kontaktpersonId;
    private $vorname;
    private $nachname;
    private $telefonnummer;
    private $lieferantId;
    
    function __construct($kontaktpersonId, $vorname, $nachname, $telefonnummer, $lieferantId) {
        $this->kontaktpersonId = $kontaktpersonId;
        $this->vorname = $vorname;
        $this->nachname = $nachname;
        $this->telefonnummer = $telefonnummer;
        $this->lieferantId = $lieferantId;
    }
    
    function getKontaktpersonId() {
        return $this->kontaktpersonId;
    }

    function getVorname() {
        return $this->vorname;
    }

    function getNachname() {
        return $this->nachname;
    }

    function getTelefonnummer() {
        return $this->telefonnummer;
    }

    function getLieferantId() {
        return $this->lieferantId;
    }

    function setKontaktpersonId($kontaktpersonId) {
        $this->kontaktpersonId = $kontaktpersonId;
    }

    function setVorname($vorname) {
        $this->vorname = $vorname;
    }

    function setNachname($nachname) {
        $this->nachname = $nachname;
    }

    function setTelefonnummer($telefonnummer) {
        $this->telefonnummer = $telefonnummer;
    }

    function setLieferantId($lieferantId) {
        $this->lieferantId = $lieferantId;
    }


}
