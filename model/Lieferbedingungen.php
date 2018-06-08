<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Lieferbedingungen
 *
 * @author AlexB
 */
class Lieferbedingungen {
    private $lieferbedingungenId;
    private $kosten;
    private $incoterms;
    private $transportart;
    
    function getLieferbedingungenId() {
        return $this->lieferbedingungenId;
    }

    function getKosten() {
        return $this->kosten;
    }

    function getIncoterms() {
        return $this->incoterms;
    }

    function getTransportart() {
        return $this->transportart;
    }

    function setLieferbedingungenId($lieferbedingungenId) {
        $this->lieferbedingungenId = $lieferbedingungenId;
    }

    function setKosten($kosten) {
        $this->kosten = $kosten;
    }

    function setIncoterms($incoterms) {
        $this->incoterms = $incoterms;
    }

    function setTransportart($transportart) {
        $this->transportart = $transportart;
    }

    function __construct($lieferbedingungenId, $kosten, $incoterms, $transportart) {
        $this->lieferbedingungenId = $lieferbedingungenId;
        $this->kosten = $kosten;
        $this->incoterms = $incoterms;
        $this->transportart = $transportart;
    }

}
