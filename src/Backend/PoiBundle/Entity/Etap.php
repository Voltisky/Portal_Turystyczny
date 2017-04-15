<?php

namespace Backend\PoiBundle\Entity;

/**
 * Etap
 */
class Etap {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $powiazanie = 'poi';

    /**
     * @var string
     */
    private $rodzaj = 'etap.rowerowy';

    /**
     * @var string
     */
    private $style;

    /**
     * @var string
     */
    private $wspolrzedne;

    /**
     * @var string
     */
    private $stan;

    /**
     * @var integer
     */
    private $position;

    /**
     * @var string
     */
    private $nazwa;

    /**
     * @var string
     */
    private $opis;

    /**
     * @var integer
     */
    private $dlugosc = 0;

    /**
     * @var \Backend\PoiBundle\Entity\Poi
     */
    private $poi;

    /**
     * @var \Backend\PoiBundle\Entity\Szlak
     */
    private $szlak;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     */
    private $media;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
	return $this->id;
    }

    /**
     * Set powiazanie
     *
     * @param string $powiazanie
     *
     * @return Etap
     */
    public function setPowiazanie($powiazanie) {
	$this->powiazanie = $powiazanie;

	return $this;
    }

    /**
     * Get powiazanie
     *
     * @return string
     */
    public function getPowiazanie() {
	return $this->powiazanie;
    }

    /**
     * Set rodzaj
     *
     * @param string $rodzaj
     *
     * @return Etap
     */
    public function setRodzaj($rodzaj) {
	$this->rodzaj = $rodzaj;

	return $this;
    }

    /**
     * Get rodzaj
     *
     * @return string
     */
    public function getRodzaj() {
	return $this->rodzaj;
    }

    /**
     * Set style
     *
     * @param string $style
     *
     * @return Etap
     */
    public function setStyle($style) {
	$this->style = $style;

	return $this;
    }

    /**
     * Get style
     *
     * @return string
     */
    public function getStyle() {
	return $this->style;
    }

    /**
     * Set wspolrzedne
     *
     * @param string $wspolrzedne
     *
     * @return Etap
     */
    public function setWspolrzedne($wspolrzedne) {
	$this->wspolrzedne = $wspolrzedne;

	return $this;
    }

    /**
     * Get wspolrzedne
     *
     * @return string
     */
    public function getWspolrzedne() {
	return $this->wspolrzedne;
    }

    /**
     * Set stan
     *
     * @param string $stan
     *
     * @return Etap
     */
    public function setStan($stan) {
	$this->stan = $stan;

	return $this;
    }

    /**
     * Get stan
     *
     * @return string
     */
    public function getStan() {
	return $this->stan;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return Etap
     */
    public function setPosition($position) {
	$this->position = $position;

	return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition() {
	return $this->position;
    }

    /**
     * Set nazwa
     *
     * @param string $nazwa
     *
     * @return Etap
     */
    public function setNazwa($nazwa) {
	$this->nazwa = $nazwa;

	return $this;
    }

    /**
     * Get nazwa
     *
     * @return string
     */
    public function getNazwa() {
	return $this->nazwa;
    }

    /**
     * Set opis
     *
     * @param string $opis
     *
     * @return Etap
     */
    public function setOpis($opis) {
	$this->opis = $opis;

	return $this;
    }

    /**
     * Get opis
     *
     * @return string
     */
    public function getOpis() {
	return $this->opis;
    }

    /**
     * Set dlugosc
     *
     * @param integer $dlugosc
     *
     * @return Etap
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
     * Set poi
     *
     * @param \Backend\PoiBundle\Entity\Poi $poi
     *
     * @return Etap
     */
    public function setPoi(\Backend\PoiBundle\Entity\Poi $poi = null) {
	$this->poi = $poi;

	return $this;
    }

    /**
     * Get poi
     *
     * @return \Backend\PoiBundle\Entity\Poi
     */
    public function getPoi() {
	return $this->poi;
    }

    /**
     * Set szlak
     *
     * @param \Backend\PoiBundle\Entity\Szlak $szlak
     *
     * @return Etap
     */
    public function setSzlak(\Backend\PoiBundle\Entity\Szlak $szlak = null) {
	$this->szlak = $szlak;

	return $this;
    }

    /**
     * Get szlak
     *
     * @return \Backend\PoiBundle\Entity\Szlak
     */
    public function getSzlak() {
	return $this->szlak;
    }

    /**
     * Set media
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $media
     *
     * @return Etap
     */
    public function setMedia(\Application\Sonata\MediaBundle\Entity\Media $media = null) {
	$this->media = $media;

	return $this;
    }

    /**
     * Get media
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getMedia() {
	return $this->media;
    }

}
