<?php

namespace Backend\PoiBundle\Entity;

/**
 * Poi
 */
class Poi
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
     * @var string
     */
    private $status_poi = 'w edycji';

    /**
     * @var string
     */
    private $polozenie;

    /**
     * @var integer
     */
    private $ocena_avg;

    /**
     * @var integer
     */
    private $hits;

    /**
     * @var string
     */
    private $alias;

    /**
     * @var string
     */
    private $ulica;

    /**
     * @var string
     */
    private $nrdomu;

    /**
     * @var string
     */
    private $nrtel;

    /**
     * @var string
     */
    private $nrfax;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $www;

    /**
     * @var string
     */
    private $wwwdod;

    /**
     * @var string
     */
    private $wwwdod_nazwa;

    /**
     * @var string
     */
    private $wwwdod_opis;

    /**
     * @var string
     */
    private $sezonowosc;

    /**
     * @var boolean
     */
    private $dladzieci;

    /**
     * @var boolean
     */
    private $dlaniepelnosprawnych;

    /**
     * @var string
     */
    private $wstep;

    /**
     * @var float
     */
    private $wgs_x;

    /**
     * @var float
     */
    private $wgs_y;

    /**
     * @var string
     */
    private $wprowadzajacy_nazwa;

    /**
     * @var string
     */
    private $wprowadzajacy_kontakt;

    /**
     * @var string
     */
    private $zrodlo;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $slug_media;

    /**
     * @var string
     */
    private $slug_rodzaj;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $poi_media;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $poi_category;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $etapy_poi;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $translations;

    /**
     * @var \Backend\AdministracyjneBundle\Entity\Adres
     */
    private $adres;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     */
    private $created_by_user;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     */
    private $user;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     */
    private $modified_by_user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->poi_media = new \Doctrine\Common\Collections\ArrayCollection();
        $this->poi_category = new \Doctrine\Common\Collections\ArrayCollection();
        $this->etapy_poi = new \Doctrine\Common\Collections\ArrayCollection();
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNazwa();
    }

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
     * @return Poi
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
     * @return Poi
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
     * Set statusPoi
     *
     * @param string $statusPoi
     *
     * @return Poi
     */
    public function setStatusPoi($statusPoi)
    {
        $this->status_poi = $statusPoi;

        return $this;
    }

    /**
     * Get statusPoi
     *
     * @return string
     */
    public function getStatusPoi()
    {
        return $this->status_poi;
    }

    /**
     * Set polozenie
     *
     * @param string $polozenie
     *
     * @return Poi
     */
    public function setPolozenie($polozenie)
    {
        $this->polozenie = $polozenie;

        return $this;
    }

    /**
     * Get polozenie
     *
     * @return string
     */
    public function getPolozenie()
    {
        return $this->polozenie;
    }

    /**
     * Set ocenaAvg
     *
     * @param integer $ocenaAvg
     *
     * @return Poi
     */
    public function setOcenaAvg($ocenaAvg)
    {
        $this->ocena_avg = $ocenaAvg;

        return $this;
    }

    /**
     * Get ocenaAvg
     *
     * @return integer
     */
    public function getOcenaAvg()
    {
        return $this->ocena_avg;
    }

    /**
     * Set hits
     *
     * @param integer $hits
     *
     * @return Poi
     */
    public function setHits($hits)
    {
        $this->hits = $hits;

        return $this;
    }

    /**
     * Get hits
     *
     * @return integer
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Poi
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set ulica
     *
     * @param string $ulica
     *
     * @return Poi
     */
    public function setUlica($ulica)
    {
        $this->ulica = $ulica;

        return $this;
    }

    /**
     * Get ulica
     *
     * @return string
     */
    public function getUlica()
    {
        return $this->ulica;
    }

    /**
     * Set nrdomu
     *
     * @param string $nrdomu
     *
     * @return Poi
     */
    public function setNrdomu($nrdomu)
    {
        $this->nrdomu = $nrdomu;

        return $this;
    }

    /**
     * Get nrdomu
     *
     * @return string
     */
    public function getNrdomu()
    {
        return $this->nrdomu;
    }

    /**
     * Set nrtel
     *
     * @param string $nrtel
     *
     * @return Poi
     */
    public function setNrtel($nrtel)
    {
        $this->nrtel = $nrtel;

        return $this;
    }

    /**
     * Get nrtel
     *
     * @return string
     */
    public function getNrtel()
    {
        return $this->nrtel;
    }

    /**
     * Set nrfax
     *
     * @param string $nrfax
     *
     * @return Poi
     */
    public function setNrfax($nrfax)
    {
        $this->nrfax = $nrfax;

        return $this;
    }

    /**
     * Get nrfax
     *
     * @return string
     */
    public function getNrfax()
    {
        return $this->nrfax;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Poi
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set www
     *
     * @param string $www
     *
     * @return Poi
     */
    public function setWww($www)
    {
        $this->www = $www;

        return $this;
    }

    /**
     * Get www
     *
     * @return string
     */
    public function getWww()
    {
        return $this->www;
    }

    /**
     * Set wwwdod
     *
     * @param string $wwwdod
     *
     * @return Poi
     */
    public function setWwwdod($wwwdod)
    {
        $this->wwwdod = $wwwdod;

        return $this;
    }

    /**
     * Get wwwdod
     *
     * @return string
     */
    public function getWwwdod()
    {
        return $this->wwwdod;
    }

    /**
     * Set wwwdodNazwa
     *
     * @param string $wwwdodNazwa
     *
     * @return Poi
     */
    public function setWwwdodNazwa($wwwdodNazwa)
    {
        $this->wwwdod_nazwa = $wwwdodNazwa;

        return $this;
    }

    /**
     * Get wwwdodNazwa
     *
     * @return string
     */
    public function getWwwdodNazwa()
    {
        return $this->wwwdod_nazwa;
    }

    /**
     * Set wwwdodOpis
     *
     * @param string $wwwdodOpis
     *
     * @return Poi
     */
    public function setWwwdodOpis($wwwdodOpis)
    {
        $this->wwwdod_opis = $wwwdodOpis;

        return $this;
    }

    /**
     * Get wwwdodOpis
     *
     * @return string
     */
    public function getWwwdodOpis()
    {
        return $this->wwwdod_opis;
    }

    /**
     * Set sezonowosc
     *
     * @param string $sezonowosc
     *
     * @return Poi
     */
    public function setSezonowosc($sezonowosc)
    {
        $this->sezonowosc = $sezonowosc;

        return $this;
    }

    /**
     * Get sezonowosc
     *
     * @return string
     */
    public function getSezonowosc()
    {
        return $this->sezonowosc;
    }

    /**
     * Set dladzieci
     *
     * @param boolean $dladzieci
     *
     * @return Poi
     */
    public function setDladzieci($dladzieci)
    {
        $this->dladzieci = $dladzieci;

        return $this;
    }

    /**
     * Get dladzieci
     *
     * @return boolean
     */
    public function getDladzieci()
    {
        return $this->dladzieci;
    }

    /**
     * Set dlaniepelnosprawnych
     *
     * @param boolean $dlaniepelnosprawnych
     *
     * @return Poi
     */
    public function setDlaniepelnosprawnych($dlaniepelnosprawnych)
    {
        $this->dlaniepelnosprawnych = $dlaniepelnosprawnych;

        return $this;
    }

    /**
     * Get dlaniepelnosprawnych
     *
     * @return boolean
     */
    public function getDlaniepelnosprawnych()
    {
        return $this->dlaniepelnosprawnych;
    }

    /**
     * Set wstep
     *
     * @param string $wstep
     *
     * @return Poi
     */
    public function setWstep($wstep)
    {
        $this->wstep = $wstep;

        return $this;
    }

    /**
     * Get wstep
     *
     * @return string
     */
    public function getWstep()
    {
        return $this->wstep;
    }

    /**
     * Set wgsX
     *
     * @param float $wgsX
     *
     * @return Poi
     */
    public function setWgsX($wgsX)
    {
        $this->wgs_x = $wgsX;

        return $this;
    }

    /**
     * Get wgsX
     *
     * @return float
     */
    public function getWgsX()
    {
        return $this->wgs_x;
    }

    /**
     * Set wgsY
     *
     * @param float $wgsY
     *
     * @return Poi
     */
    public function setWgsY($wgsY)
    {
        $this->wgs_y = $wgsY;

        return $this;
    }

    /**
     * Get wgsY
     *
     * @return float
     */
    public function getWgsY()
    {
        return $this->wgs_y;
    }

    /**
     * Set wprowadzajacyNazwa
     *
     * @param string $wprowadzajacyNazwa
     *
     * @return Poi
     */
    public function setWprowadzajacyNazwa($wprowadzajacyNazwa)
    {
        $this->wprowadzajacy_nazwa = $wprowadzajacyNazwa;

        return $this;
    }

    /**
     * Get wprowadzajacyNazwa
     *
     * @return string
     */
    public function getWprowadzajacyNazwa()
    {
        return $this->wprowadzajacy_nazwa;
    }

    /**
     * Set wprowadzajacyKontakt
     *
     * @param string $wprowadzajacyKontakt
     *
     * @return Poi
     */
    public function setWprowadzajacyKontakt($wprowadzajacyKontakt)
    {
        $this->wprowadzajacy_kontakt = $wprowadzajacyKontakt;

        return $this;
    }

    /**
     * Get wprowadzajacyKontakt
     *
     * @return string
     */
    public function getWprowadzajacyKontakt()
    {
        return $this->wprowadzajacy_kontakt;
    }

    /**
     * Set zrodlo
     *
     * @param string $zrodlo
     *
     * @return Poi
     */
    public function setZrodlo($zrodlo)
    {
        $this->zrodlo = $zrodlo;

        return $this;
    }

    /**
     * Get zrodlo
     *
     * @return string
     */
    public function getZrodlo()
    {
        return $this->zrodlo;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Poi
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Poi
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Poi
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slugMedia
     *
     * @param string $slugMedia
     *
     * @return Poi
     */
    public function setSlugMedia($slugMedia)
    {
        $this->slug_media = $slugMedia;

        return $this;
    }

    /**
     * Get slugMedia
     *
     * @return string
     */
    public function getSlugMedia()
    {
        return $this->slug_media;
    }

    /**
     * Set slugRodzaj
     *
     * @param string $slugRodzaj
     *
     * @return Poi
     */
    public function setSlugRodzaj($slugRodzaj)
    {
        $this->slug_rodzaj = $slugRodzaj;

        return $this;
    }

    /**
     * Get slugRodzaj
     *
     * @return string
     */
    public function getSlugRodzaj()
    {
        return $this->slug_rodzaj;
    }

    /**
     * Add poiMedia
     *
     * @param \Backend\PoiBundle\Entity\PoiMedia $poiMedia
     *
     * @return Poi
     */
    public function addPoiMedia(\Backend\PoiBundle\Entity\PoiMedia $poiMedia)
    {
        $this->poi_media[] = $poiMedia;

        return $this;
    }

    /**
     * Remove poiMedia
     *
     * @param \Backend\PoiBundle\Entity\PoiMedia $poiMedia
     */
    public function removePoiMedia(\Backend\PoiBundle\Entity\PoiMedia $poiMedia)
    {
        $this->poi_media->removeElement($poiMedia);
    }

    /**
     * Get poiMedia
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPoiMedia()
    {
        return $this->poi_media;
    }

    /**
     * Add poiCategory
     *
     * @param \Backend\PoiBundle\Entity\PoiCategory $poiCategory
     *
     * @return Poi
     */
    public function addPoiCategory(\Backend\PoiBundle\Entity\PoiCategory $poiCategory)
    {
        $this->poi_category[] = $poiCategory;

        return $this;
    }

    /**
     * Remove poiCategory
     *
     * @param \Backend\PoiBundle\Entity\PoiCategory $poiCategory
     */
    public function removePoiCategory(\Backend\PoiBundle\Entity\PoiCategory $poiCategory)
    {
        $this->poi_category->removeElement($poiCategory);
    }

    /**
     * Get poiCategory
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPoiCategory()
    {
        return $this->poi_category;
    }

    /**
     * Add etapyPoi
     *
     * @param \Backend\PoiBundle\Entity\Etap $etapyPoi
     *
     * @return Poi
     */
    public function addEtapyPoi(\Backend\PoiBundle\Entity\Etap $etapyPoi)
    {
        $this->etapy_poi[] = $etapyPoi;

        return $this;
    }

    /**
     * Remove etapyPoi
     *
     * @param \Backend\PoiBundle\Entity\Etap $etapyPoi
     */
    public function removeEtapyPoi(\Backend\PoiBundle\Entity\Etap $etapyPoi)
    {
        $this->etapy_poi->removeElement($etapyPoi);
    }

    /**
     * Get etapyPoi
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtapyPoi()
    {
        return $this->etapy_poi;
    }

    /**
     * Add translation
     *
     * @param \Backend\PoiBundle\Entity\PoiTranslation $translation
     *
     * @return Poi
     */
    public function addTranslation(\Backend\PoiBundle\Entity\PoiTranslation $translation)
    {
        $translation->setObject($this);
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \Backend\PoiBundle\Entity\PoiTranslation $translation
     */
    public function removeTranslation(\Backend\PoiBundle\Entity\PoiTranslation $translation)
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

    /**
     * Set adres
     *
     * @param \Backend\AdministracyjneBundle\Entity\Adres $adres
     *
     * @return Poi
     */
    public function setAdres(\Backend\AdministracyjneBundle\Entity\Adres $adres = null)
    {
        $this->adres = $adres;

        return $this;
    }

    /**
     * Get adres
     *
     * @return \Backend\AdministracyjneBundle\Entity\Adres
     */
    public function getAdres()
    {
        return $this->adres;
    }

    /**
     * Set createdByUser
     *
     * @param \Application\Sonata\UserBundle\Entity\User $createdByUser
     *
     * @return Poi
     */
    public function setCreatedByUser(\Application\Sonata\UserBundle\Entity\User $createdByUser = null)
    {
        $this->created_by_user = $createdByUser;

        return $this;
    }

    /**
     * Get createdByUser
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getCreatedByUser()
    {
        return $this->created_by_user;
    }

    /**
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     *
     * @return Poi
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set modifiedByUser
     *
     * @param \Application\Sonata\UserBundle\Entity\User $modifiedByUser
     *
     * @return Poi
     */
    public function setModifiedByUser(\Application\Sonata\UserBundle\Entity\User $modifiedByUser = null)
    {
        $this->modified_by_user = $modifiedByUser;

        return $this;
    }

    /**
     * Get modifiedByUser
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getModifiedByUser()
    {
        return $this->modified_by_user;
    }

    protected $lang;

    public function setLang($locale)
    {
        $this->lang = $locale;
    }

    public function getLang()
    {
        return $this->lang;
    }

}
