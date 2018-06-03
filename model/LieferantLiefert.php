<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LieferantLiefert
 *
 * @author AlexB
 */
class LieferantLiefert {
    private $lieferantId;
    private $artikelId;
    private $lieferantname;
    private $artikelname;
    
    function getLieferantId() {
        return $this->lieferantId;
    }

    function getArtikelId() {
        return $this->artikelId;
    }

    function getLieferantname() {
        return $this->lieferantname;
    }

    function getArtikelname() {
        return $this->artikelname;
    }

    function setLieferantId($lieferantId) {
        $this->lieferantId = $lieferantId;
    }

    function setArtikelId($artikelId) {
        $this->artikelId = $artikelId;
    }

    function setLieferantname($lieferantname) {
        $this->lieferantname = $lieferantname;
    }

    function setArtikelname($artikelname) {
        $this->artikelname = $artikelname;
    }

    function __construct($lieferantId, $artikelId, $lieferantname, $artikelname) {
        $this->lieferantId = $lieferantId;
        $this->artikelId = $artikelId;
        $this->lieferantname = $lieferantname;
        $this->artikelname = $artikelname;
    }

}
