<?php

namespace Backend\CommonBundle\Entity;

/**
 * Konfiguracja
 */
class Konfiguracja
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nazwa;

    /**
     * @var string
     */
    private $opis;

    /**
     * @var boolean
     */
    private $main;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nazwa
     *
     * @param string $nazwa
     *
     * @return Konfiguracja
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    /**
     * Get nazwa
     *
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * Set opis
     *
     * @param string $opis
     *
     * @return Konfiguracja
     */
    public function setOpis($opis)
    {
        $this->opis = $opis;

        return $this;
    }

    /**
     * Get opis
     *
     * @return string
     */
    public function getOpis()
    {
        return $this->opis;
    }

    /**
     * Set main
     *
     * @param boolean $main
     *
     * @return Konfiguracja
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Get main
     *
     * @return boolean
     */
    public function getMain()
    {
        return $this->main;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add translation
     *
     * @param \Backend\CommonBundle\Entity\KonfiguracjaTranslation $translation
     *
     * @return Konfiguracja
     */
    public function addTranslation(\Backend\CommonBundle\Entity\KonfiguracjaTranslation $translation)
    {
		$translation->setObject($this);
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \Backend\CommonBundle\Entity\KonfiguracjaTranslation $translation
     */
    public function removeTranslation(\Backend\CommonBundle\Entity\KonfiguracjaTranslation $translation)
    {
        $this->translations->removeElement($translation);
    }

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTranslations()
    {
        return $this->translations;
    }
	
    protected $lang;

    public function setLang($locale) {
	$this->lang = $locale;
    }

    public function getLang() {
	return $this->lang;
    }
    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     */
    private $logo;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     */
    private $default_image;


    /**
     * Set logo
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $logo
     *
     * @return Konfiguracja
     */
    public function setLogo(\Application\Sonata\MediaBundle\Entity\Media $logo = null)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set defaultImage
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $defaultImage
     *
     * @return Konfiguracja
     */
    public function setDefaultImage(\Application\Sonata\MediaBundle\Entity\Media $defaultImage = null)
    {
        $this->default_image = $defaultImage;

        return $this;
    }

    /**
     * Get defaultImage
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getDefaultImage()
    {
        return $this->default_image;
    }
}
