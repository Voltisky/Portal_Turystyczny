<?php

namespace Backend\PoiBundle\Entity;

/**
 * Szlak
 */
class Szlak extends Poi {

    /**
     * @var integer
     */
    private $dlugosc;

    /**
     * @var integer
     */
    private $trudnosc;

    /**
     * @var float
     */
    private $czaspodrozy;

    /**
     * @var float
     */
    private $u92_x_s;

    /**
     * @var float
     */
    private $u92_y_s;

    /**
     * @var float
     */
    private $wgs_x_s;

    /**
     * @var float
     */
    private $wgs_y_s;

    /**
     * @var float
     */
    private $u92_x_k;

    /**
     * @var float
     */
    private $u92_y_k;

    /**
     * @var float
     */
    private $wgs_x_k;

    /**
     * @var float
     */
    private $wgs_y_k;

    /**
     * @var boolean
     */
    private $czy_wycieczka;

    /**
     * @var boolean
     */
    private $czy_udostepniona;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $etapy_szlak;

    /**
     * Constructor
     */
    public function __construct() {
	$this->etapy_szlak = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set dlugosc
     *
     * @param integer $dlugosc
     *
     * @return Szlak
     */
    public function setDlugosc($dlugosc) {
	$this->dlugosc = $dlugosc;

	return $this;
    }

    /**
     * Get dlugosc
     *
     * @return integer
     */
    public function getDlugosc() {
	return $this->dlugosc;
    }

    /**
     * Set trudnosc
     *
     * @param integer $trudnosc
     *
     * @return Szlak
     */
    public function setTrudnosc($trudnosc) {
	$this->trudnosc = $trudnosc;

	return $this;
    }

    /**
     * Get trudnosc
     *
     * @return integer
     */
    public function getTrudnosc() {
	return $this->trudnosc;
    }

    /**
     * Set czaspodrozy
     *
     * @param float $czaspodrozy
     *
     * @return Szlak
     */
    public function setCzaspodrozy($czaspodrozy) {
	$this->czaspodrozy = $czaspodrozy;

	return $this;
    }

    /**
     * Get czaspodrozy
     *
     * @return float
     */
    public function getCzaspodrozy() {
	return $this->czaspodrozy;
    }

    /**
     * Set u92XS
     *
     * @param float $u92XS
     *
     * @return Szlak
     */
    public function setU92XS($u92XS) {
	$this->u92_x_s = $u92XS;

	return $this;
    }

    /**
     * Get u92XS
     *
     * @return float
     */
    public function getU92XS() {
	return $this->u92_x_s;
    }

    /**
     * Set u92YS
     *
     * @param float $u92YS
     *
     * @return Szlak
     */
    public function setU92YS($u92YS) {
	$this->u92_y_s = $u92YS;

	return $this;
    }

    /**
     * Get u92YS
     *
     * @return float
     */
    public function getU92YS() {
	return $this->u92_y_s;
    }

    /**
     * Set wgsXS
     *
     * @param float $wgsXS
     *
     * @return Szlak
     */
    public function setWgsXS($wgsXS) {
	$this->wgs_x_s = $wgsXS;

	return $this;
    }

    /**
     * Get wgsXS
     *
     * @return float
     */
    public function getWgsXS() {
	return $this->wgs_x_s;
    }

    /**
     * Set wgsYS
     *
     * @param float $wgsYS
     *
     * @return Szlak
     */
    public function setWgsYS($wgsYS) {
	$this->wgs_y_s = $wgsYS;

	return $this;
    }

    /**
     * Get wgsYS
     *
     * @return float
     */
    public function getWgsYS() {
	return $this->wgs_y_s;
    }

    /**
     * Set u92XK
     *
     * @param float $u92XK
     *
     * @return Szlak
     */
    public function setU92XK($u92XK) {
	$this->u92_x_k = $u92XK;

	return $this;
    }

    /**
     * Get u92XK
     *
     * @return float
     */
    public function getU92XK() {
	return $this->u92_x_k;
    }

    /**
     * Set u92YK
     *
     * @param float $u92YK
     *
     * @return Szlak
     */
    public function setU92YK($u92YK) {
	$this->u92_y_k = $u92YK;

	return $this;
    }

    /**
     * Get u92YK
     *
     * @return float
     */
    public function getU92YK() {
	return $this->u92_y_k;
    }

    /**
     * Set wgsXK
     *
     * @param float $wgsXK
     *
     * @return Szlak
     */
    public function setWgsXK($wgsXK) {
	$this->wgs_x_k = $wgsXK;

	return $this;
    }

    /**
     * Get wgsXK
     *
     * @return float
     */
    public function getWgsXK() {
	return $this->wgs_x_k;
    }

    /**
     * Set wgsYK
     *
     * @param float $wgsYK
     *
     * @return Szlak
     */
    public function setWgsYK($wgsYK) {
	$this->wgs_y_k = $wgsYK;

	return $this;
    }

    /**
     * Get wgsYK
     *
     * @return float
     */
    public function getWgsYK() {
	return $this->wgs_y_k;
    }

    /**
     * Set czyWycieczka
     *
     * @param boolean $czyWycieczka
     *
     * @return Szlak
     */
    public function setCzyWycieczka($czyWycieczka) {
	$this->czy_wycieczka = $czyWycieczka;

	return $this;
    }

    /**
     * Get czyWycieczka
     *
     * @return boolean
     */
    public function getCzyWycieczka() {
	return $this->czy_wycieczka;
    }

    /**
     * Set czyUdostepniona
     *
     * @param boolean $czyUdostepniona
     *
     * @return Szlak
     */
    public function setCzyUdostepniona($czyUdostepniona) {
	$this->czy_udostepniona = $czyUdostepniona;

	return $this;
    }

    /**
     * Get czyUdostepniona
     *
     * @return boolean
     */
    public function getCzyUdostepniona() {
	return $this->czy_udostepniona;
    }

    /**
     * Add etapySzlak
     *
     * @param \Backend\PoiBundle\Entity\Etap $etapySzlak
     *
     * @return Szlak
     */
    public function addEtapySzlak(\Backend\PoiBundle\Entity\Etap $etapySzlak) {
	$this->etapy_szlak[] = $etapySzlak;

	return $this;
    }

    /**
     * Remove etapySzlak
     *
     * @param \Backend\PoiBundle\Entity\Etap $etapySzlak
     */
    public function removeEtapySzlak(\Backend\PoiBundle\Entity\Etap $etapySzlak) {
	$this->etapy_szlak->removeElement($etapySzlak);
    }

    /**
     * Get etapySzlak
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtapySzlak() {
	return $this->etapy_szlak;
    }

    /**
     * @var geometry
     */
    private $geometria;

    /**
     * Set geometria
     *
     * @param \geometry $geometria
     *
     * @return Szlak
     */
    public function setGeometria($geometria) {
	$this->geometria = $geometria;

	return $this;
    }

    /**
     * Get geometria
     *
     * @return \geometry
     */
    public function getGeometria() {
	return $this->geometria;
    }

}
