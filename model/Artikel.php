<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Artikel
 *
 * @author AlexB
 */
class Artikel {
    private $artikelId;
    private $artikelname;
    private $einkaufspreis;
    private $verkaufspreis;
    private $mindestbestand;
    private $aufschlag;
    private $lagerstand;
    private $lagerort;
    private $steuersatz;
    private $aktiv;
    
    
    function getArtikelId() {
        return $this->artikelId;
    }

    function getArtikelname() {
        return $this->artikelname;
    }

    function getEinkaufspreis() {
        return $this->einkaufspreis;
    }

    function getVerkaufspreis() {
        return $this->verkaufspreis;
    }

    function getMindestbestand() {
        return $this->mindestbestand;
    }

    function getAufschlag() {
        return $this->aufschlag;
    }

    function getLagerstand() {
        return $this->lagerstand;
    }

    function getLagerort() {
        return $this->lagerort;
    }

    function getSteuersatz() {
        return $this->steuersatz;
    }

    function getAktiv() {
        return $this->aktiv;
    }

    function setArtikelId($artikelId) {
        $this->artikelId = $artikelId;
    }

    function setArtikelname($artikelname) {
        $this->artikelname = $artikelname;
    }

    function setEinkaufspreis($einkaufspreis) {
        $this->einkaufspreis = $einkaufspreis;
    }

    function setVerkaufspreis($verkaufspreis) {
        $this->verkaufspreis = $verkaufspreis;
    }

    function setMindestbestand($mindestbestand) {
        $this->mindestbestand = $mindestbestand;
    }

    function setAufschlag($aufschlag) {
        $this->aufschlag = $aufschlag;
    }

    function setLagerstand($lagerstand) {
        $this->lagerstand = $lagerstand;
    }

    function setLagerort($lagerort) {
        $this->lagerort = $lagerort;
    }

    function setSteuersatz($steuersatz) {
        $this->steuersatz = $steuersatz;
    }

    function setAktiv($aktiv) {
        $this->aktiv = $aktiv;
    }

    function __construct($artikelId, $artikelname, $einkaufspreis, $verkaufspreis, $mindestbestand, $aufschlag, $lagerstand, $lagerort, $steuersatz, $aktiv) {
        $this->artikelId = $artikelId;
        $this->artikelname = $artikelname;
        $this->einkaufspreis = $einkaufspreis;
        $this->verkaufspreis = $verkaufspreis;
        $this->mindestbestand = $mindestbestand;
        $this->aufschlag = $aufschlag;
        $this->lagerstand = $lagerstand;
        $this->lagerort = $lagerort;
        $this->steuersatz = $steuersatz;
        $this->aktiv = $aktiv;
    }

}
