<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LieferantDetail
 *
 * @author AlexB
 */
class LieferantDetail {
    private $lieferantId;
    private $name;
    private $telefonnummer;
    private $strasse;
    private $hausnummer;
    private $ortId;
    private $plz;
    private $ort;
    private $landId;
    private $land;
    private $land_kennzeichen;
    private $aktiv;
    private $zahlungsbedingungId;
    private $skonto;
    private $rabatt;
    private $zahlungsziel;
    private $lieferbedingungsId;
    private $lieferkosten;
    private $incoterms;
    private $transportart;
    private $lieferantenkontaktpersonId;
    private $kontakt_vorname;
    private $kontakt_nachname;
    private $kontakt_telefonnummer;
    
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

    function getOrtId() {
        return $this->ortId;
    }

    function getPlz() {
        return $this->plz;
    }

    function getOrt() {
        return $this->ort;
    }

    function getLandId() {
        return $this->landId;
    }

    function getLand() {
        return $this->land;
    }

    function getLand_kennzeichen() {
        return $this->land_kennzeichen;
    }

    function getAktiv() {
        return $this->aktiv;
    }

    function getZahlungsbedingungId() {
        return $this->zahlungsbedingungId;
    }

    function getSkonto() {
        return $this->skonto;
    }

    function getRabatt() {
        return $this->rabatt;
    }

    function getZahlungsziel() {
        return $this->zahlungsziel;
    }

    function getLieferbedingungsId() {
        return $this->lieferbedingungsId;
    }

    function getLieferkosten() {
        return $this->lieferkosten;
    }

    function getIncoterms() {
        return $this->incoterms;
    }

    function getTransportart() {
        return $this->transportart;
    }

    function getLieferantenkontaktpersonId() {
        return $this->lieferantenkontaktpersonId;
    }

    function getKontakt_vorname() {
        return $this->kontakt_vorname;
    }

    function getKontakt_nachname() {
        return $this->kontakt_nachname;
    }

    function getKontakt_telefonnummer() {
        return $this->kontakt_telefonnummer;
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

    function setOrtId($ortId) {
        $this->ortId = $ortId;
    }

    function setPlz($plz) {
        $this->plz = $plz;
    }

    function setOrt($ort) {
        $this->ort = $ort;
    }

    function setLandId($landId) {
        $this->landId = $landId;
    }

    function setLand($land) {
        $this->land = $land;
    }

    function setLand_kennzeichen($land_kennzeichen) {
        $this->land_kennzeichen = $land_kennzeichen;
    }

    function setAktiv($aktiv) {
        $this->aktiv = $aktiv;
    }

    function setZahlungsbedingungId($zahlungsbedingungId) {
        $this->zahlungsbedingungId = $zahlungsbedingungId;
    }

    function setSkonto($skonto) {
        $this->skonto = $skonto;
    }

    function setRabatt($rabatt) {
        $this->rabatt = $rabatt;
    }

    function setZahlungsziel($zahlungsziel) {
        $this->zahlungsziel = $zahlungsziel;
    }

    function setLieferbedingungsId($lieferbedingungsId) {
        $this->lieferbedingungsId = $lieferbedingungsId;
    }

    function setLieferkosten($lieferkosten) {
        $this->lieferkosten = $lieferkosten;
    }

    function setIncoterms($incoterms) {
        $this->incoterms = $incoterms;
    }

    function setTransportart($transportart) {
        $this->transportart = $transportart;
    }

    function setLieferantenkontaktpersonId($lieferantenkontaktpersonId) {
        $this->lieferantenkontaktpersonId = $lieferantenkontaktpersonId;
    }

    function setKontakt_vorname($kontakt_vorname) {
        $this->kontakt_vorname = $kontakt_vorname;
    }

    function setKontakt_nachname($kontakt_nachname) {
        $this->kontakt_nachname = $kontakt_nachname;
    }

    function setKontakt_telefonnummer($kontakt_telefonnummer) {
        $this->kontakt_telefonnummer = $kontakt_telefonnummer;
    }

    function __construct($lieferantId, $name, $telefonnummer, $strasse, $hausnummer, $ortId, $plz, $ort, $landId, $land, $land_kennzeichen, $aktiv, $zahlungsbedingungId, $skonto, $rabatt, $zahlungsziel, $lieferbedingungsId, $lieferkosten, $incoterms, $transportart, $lieferantenkontaktpersonId, $kontakt_vorname, $kontakt_nachname, $kontakt_telefonnummer) {
        $this->lieferantId = $lieferantId;
        $this->name = $name;
        $this->telefonnummer = $telefonnummer;
        $this->strasse = $strasse;
        $this->hausnummer = $hausnummer;
        $this->ortId = $ortId;
        $this->plz = $plz;
        $this->ort = $ort;
        $this->landId = $landId;
        $this->land = $land;
        $this->land_kennzeichen = $land_kennzeichen;
        $this->aktiv = $aktiv;
        $this->zahlungsbedingungId = $zahlungsbedingungId;
        $this->skonto = $skonto;
        $this->rabatt = $rabatt;
        $this->zahlungsziel = $zahlungsziel;
        $this->lieferbedingungsId = $lieferbedingungsId;
        $this->lieferkosten = $lieferkosten;
        $this->incoterms = $incoterms;
        $this->transportart = $transportart;
        $this->lieferantenkontaktpersonId = $lieferantenkontaktpersonId;
        $this->kontakt_vorname = $kontakt_vorname;
        $this->kontakt_nachname = $kontakt_nachname;
        $this->kontakt_telefonnummer = $kontakt_telefonnummer;
    }


}
