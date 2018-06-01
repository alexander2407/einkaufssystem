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
    private $lagerstandVerfuegbar;
    private $lagerstandAktuell;
    private $aufschlag;
    
    function getArtikelname() {
        return $this->artikelname;
    }

    function getAufschlag() {
        return $this->aufschlag;
    }

    function setArtikelname($artikelname) {
        $this->artikelname = $artikelname;
    }

    function setAufschlag($aufschlag) {
        $this->aufschlag = $aufschlag;
    }

        
    function getArtikelId() {
        return $this->artikelId;
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

    function getLagerstandVerfuegbar() {
        return $this->lagerstandVerfuegbar;
    }

    function getLagerstandAktuell() {
        return $this->lagerstandAktuell;
    }

    function setArtikelId($artikelId) {
        $this->artikelId = $artikelId;
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

    function setLagerstandVerfuegbar($lagerstandVerfuegbar) {
        $this->lagerstandVerfuegbar = $lagerstandVerfuegbar;
    }

    function setLagerstandAktuell($lagerstandAktuell) {
        $this->lagerstandAktuell = $lagerstandAktuell;
    }

    function __construct($artikelId, $artikelname, $einkaufspreis, $verkaufspreis, $mindestbestand, $lagerstandVerfuegbar, $lagerstandAktuell, $aufschlag) {
        $this->artikelId = $artikelId;
        $this->artikelname = $artikelname;
        $this->einkaufspreis = $einkaufspreis;
        $this->verkaufspreis = $verkaufspreis;
        $this->mindestbestand = $mindestbestand;
        $this->lagerstandVerfuegbar = $lagerstandVerfuegbar;
        $this->lagerstandAktuell = $lagerstandAktuell;
        $this->aufschlag = $aufschlag;
    }


}
