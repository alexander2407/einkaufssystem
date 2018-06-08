<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Zahlungsbedingungen
 *
 * @author AlexB
 */
class Zahlungsbedingungen {
    private $zahlungsbedingungenId;
    private $skonto;
    private $rabatt;
    private $zahlungszieltage;
    
    function __construct($zahlungsbedingungenId, $skonto, $rabatt, $zahlungszieltage) {
        $this->zahlungsbedingungenId = $zahlungsbedingungenId;
        $this->skonto = $skonto;
        $this->rabatt = $rabatt;
        $this->zahlungszieltage = $zahlungszieltage;
    }

    function getZahlungsbedingungenId() {
        return $this->zahlungsbedingungenId;
    }

    function getSkonto() {
        return $this->skonto;
    }

    function getRabatt() {
        return $this->rabatt;
    }

    function getZahlungszieltage() {
        return $this->zahlungszieltage;
    }

    function setZahlungsbedingungenId($zahlungsbedingungenId) {
        $this->zahlungsbedingungenId = $zahlungsbedingungenId;
    }

    function setSkonto($skonto) {
        $this->skonto = $skonto;
    }

    function setRabatt($rabatt) {
        $this->rabatt = $rabatt;
    }

    function setZahlungszieltage($zahlungszieltage) {
        $this->zahlungszieltage = $zahlungszieltage;
    }


}
