<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ust
 *
 * @author AlexB
 */
class Ust {
    private $ustId;
    private $steuersatz;
    
    function __construct($ustId, $steuersatz) {
        $this->ustId = $ustId;
        $this->steuersatz = $steuersatz;
    }
    function getUstId() {
        return $this->ustId;
    }

    function getSteuersatz() {
        return $this->steuersatz;
    }

    function setUstId($ustId) {
        $this->ustId = $ustId;
    }

    function setSteuersatz($steuersatz) {
        $this->steuersatz = $steuersatz;
    }


}
