<?php

namespace Backend\PoiBundle\Entity;

/**
 * PoiMedia
 */
class PoiMedia {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $position;

    /**
     * @var boolean
     */
    private $enabled;

    /**
     * @var boolean
     */
    private $czywiodaca;

    /**
     * @var boolean
     */
    private $status;

    /**
     * @var \Backend\PoiBundle\Entity\Poi
     */
    private $poi;

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
     * Set position
     *
     * @param integer $position
     *
     * @return PoiMedia
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
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return PoiMedia
     */
    public function setEnabled($enabled) {
	$this->enabled = $enabled;

	return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled() {
	return $this->enabled;
    }

    /**
     * Set czywiodaca
     *
     * @param boolean $czywiodaca
     *
     * @return PoiMedia
     */
    public function setCzywiodaca($czywiodaca) {
	$this->czywiodaca = $czywiodaca;

	return $this;
    }

    /**
     * Get czywiodaca
     *
     * @return boolean
     */
    public function getCzywiodaca() {
	return $this->czywiodaca;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return PoiMedia
     */
    public function setStatus($status) {
	$this->status = $status;

	return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus() {
	return $this->status;
    }

    /**
     * Set poi
     *
     * @param \Backend\PoiBundle\Entity\Poi $poi
     *
     * @return PoiMedia
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
     * Set media
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $media
     *
     * @return PoiMedia
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

    private $miniatura;

    public function getMiniatura() {
	return 'Brak miniatury';
    }

    public function setMiniatura($v) {
	$this->miniatura = $v;
    }

}
