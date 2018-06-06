<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Zahlungsmethode
 *
 * @author dinho
 */
class Zahlungsmethode {
    
    private $zahlungsmethodeid;
    private $zahlungsmethodename;
    
    function getZahlungsmethodeid() {
        return $this->zahlungsmethodeid;
    }

    function getZahlungsmethodename() {
        return $this->zahlungsmethodename;
    }

    function setZahlungsmethodeid($zahlungsmethodeid) {
        $this->zahlungsmethodeid = $zahlungsmethodeid;
    }

    function setZahlungsmethodename($zahlungsmethodename) {
        $this->zahlungsmethodename = $zahlungsmethodename;
    }

    function __construct($zahlungsmethodeid, $zahlungsmethodename) {
        $this->zahlungsmethodeid = $zahlungsmethodeid;
        $this->zahlungsmethodename = $zahlungsmethodename;
    }

    //put your code here
}
