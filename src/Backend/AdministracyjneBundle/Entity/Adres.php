<?php

namespace Backend\AdministracyjneBundle\Entity;

/**
 * Adres
 */
class Adres
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $sym;

    /**
     * @var integer
     */
    private $sym_pod;

    /**
     * @var integer
     */
    private $teryt;

    /**
     * @var integer
     */
    private $woj;

    /**
     * @var integer
     */
    private $pow;

    /**
     * @var integer
     */
    private $gmi;

    /**
     * @var string
     */
    private $nazwa_woj;

    /**
     * @var string
     */
    private $nazwa_pow;

    /**
     * @var string
     */
    private $nazwa_gmi;

    /**
     * @var string
     */
    private $nazwa_dod;

    /**
     * @var integer
     */
    private $rodzaj_gmi;

    /**
     * @var integer
     */
    private $rm;

    /**
     * @var boolean
     */
    private $mz;

    /**
     * @var string
     */
    private $nazwa;

    /**
     * @var \DateTime
     */
    private $stan_na;

    /**
     * @var integer
     */
    private $dotnetid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $adresy_msc;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $adresy_poczta;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->adresy_msc = new \Doctrine\Common\Collections\ArrayCollection();
        $this->adresy_poczta = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set sym
     *
     * @param integer $sym
     *
     * @return Adres
     */
    public function setSym($sym)
    {
        $this->sym = $sym;

        return $this;
    }

    /**
     * Get sym
     *
     * @return integer
     */
    public function getSym()
    {
        return $this->sym;
    }

    /**
     * Set symPod
     *
     * @param integer $symPod
     *
     * @return Adres
     */
    public function setSymPod($symPod)
    {
        $this->sym_pod = $symPod;

        return $this;
    }

    /**
     * Get symPod
     *
     * @return integer
     */
    public function getSymPod()
    {
        return $this->sym_pod;
    }

    /**
     * Set teryt
     *
     * @param integer $teryt
     *
     * @return Adres
     */
    public function setTeryt($teryt)
    {
        $this->teryt = $teryt;

        return $this;
    }

    /**
     * Get teryt
     *
     * @return integer
     */
    public function getTeryt()
    {
        return $this->teryt;
    }

    /**
     * Set woj
     *
     * @param integer $woj
     *
     * @return Adres
     */
    public function setWoj($woj)
    {
        $this->woj = $woj;

        return $this;
    }

    /**
     * Get woj
     *
     * @return integer
     */
    public function getWoj()
    {
        return $this->woj;
    }

    /**
     * Set pow
     *
     * @param integer $pow
     *
     * @return Adres
     */
    public function setPow($pow)
    {
        $this->pow = $pow;

        return $this;
    }

    /**
     * Get pow
     *
     * @return integer
     */
    public function getPow()
    {
        return $this->pow;
    }

    /**
     * Set gmi
     *
     * @param integer $gmi
     *
     * @return Adres
     */
    public function setGmi($gmi)
    {
        $this->gmi = $gmi;

        return $this;
    }

    /**
     * Get gmi
     *
     * @return integer
     */
    public function getGmi()
    {
        return $this->gmi;
    }

    /**
     * Set nazwaWoj
     *
     * @param string $nazwaWoj
     *
     * @return Adres
     */
    public function setNazwaWoj($nazwaWoj)
    {
        $this->nazwa_woj = $nazwaWoj;

        return $this;
    }

    /**
     * Get nazwaWoj
     *
     * @return string
     */
    public function getNazwaWoj()
    {
        return $this->nazwa_woj;
    }

    /**
     * Set nazwaPow
     *
     * @param string $nazwaPow
     *
     * @return Adres
     */
    public function setNazwaPow($nazwaPow)
    {
        $this->nazwa_pow = $nazwaPow;

        return $this;
    }

    /**
     * Get nazwaPow
     *
     * @return string
     */
    public function getNazwaPow()
    {
        return $this->nazwa_pow;
    }

    /**
     * Set nazwaGmi
     *
     * @param string $nazwaGmi
     *
     * @return Adres
     */
    public function setNazwaGmi($nazwaGmi)
    {
        $this->nazwa_gmi = $nazwaGmi;

        return $this;
    }

    /**
     * Get nazwaGmi
     *
     * @return string
     */
    public function getNazwaGmi()
    {
        return $this->nazwa_gmi;
    }

    /**
     * Set nazwaDod
     *
     * @param string $nazwaDod
     *
     * @return Adres
     */
    public function setNazwaDod($nazwaDod)
    {
        $this->nazwa_dod = $nazwaDod;

        return $this;
    }

    /**
     * Get nazwaDod
     *
     * @return string
     */
    public function getNazwaDod()
    {
        return $this->nazwa_dod;
    }

    /**
     * Set rodzajGmi
     *
     * @param integer $rodzajGmi
     *
     * @return Adres
     */
    public function setRodzajGmi($rodzajGmi)
    {
        $this->rodzaj_gmi = $rodzajGmi;

        return $this;
    }

    /**
     * Get rodzajGmi
     *
     * @return integer
     */
    public function getRodzajGmi()
    {
        return $this->rodzaj_gmi;
    }

    /**
     * Set rm
     *
     * @param integer $rm
     *
     * @return Adres
     */
    public function setRm($rm)
    {
        $this->rm = $rm;

        return $this;
    }

    /**
     * Get rm
     *
     * @return integer
     */
    public function getRm()
    {
        return $this->rm;
    }

    /**
     * Set mz
     *
     * @param boolean $mz
     *
     * @return Adres
     */
    public function setMz($mz)
    {
        $this->mz = $mz;

        return $this;
    }

    /**
     * Get mz
     *
     * @return boolean
     */
    public function getMz()
    {
        return $this->mz;
    }

    /**
     * Set nazwa
     *
     * @param string $nazwa
     *
     * @return Adres
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
     * Set stanNa
     *
     * @param \DateTime $stanNa
     *
     * @return Adres
     */
    public function setStanNa($stanNa)
    {
        $this->stan_na = $stanNa;

        return $this;
    }

    /**
     * Get stanNa
     *
     * @return \DateTime
     */
    public function getStanNa()
    {
        return $this->stan_na;
    }

    /**
     * Set dotnetid
     *
     * @param integer $dotnetid
     *
     * @return Adres
     */
    public function setDotnetid($dotnetid)
    {
        $this->dotnetid = $dotnetid;

        return $this;
    }

    /**
     * Get dotnetid
     *
     * @return integer
     */
    public function getDotnetid()
    {
        return $this->dotnetid;
    }

    /**
     * Add adresyMsc
     *
     * @param \Backend\AdministracyjneBundle\Entity\Adres $adresyMsc
     *
     * @return Adres
     */
    public function addAdresyMsc(\Backend\AdministracyjneBundle\Entity\Adres $adresyMsc)
    {
        $this->adresy_msc[] = $adresyMsc;

        return $this;
    }

    /**
     * Remove adresyMsc
     *
     * @param \Backend\AdministracyjneBundle\Entity\Adres $adresyMsc
     */
    public function removeAdresyMsc(\Backend\AdministracyjneBundle\Entity\Adres $adresyMsc)
    {
        $this->adresy_msc->removeElement($adresyMsc);
    }

    /**
     * Get adresyMsc
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdresyMsc()
    {
        return $this->adresy_msc;
    }

    /**
     * Add adresyPocztum
     *
     * @param \Backend\AdministracyjneBundle\Entity\Adres $adresyPocztum
     *
     * @return Adres
     */
    public function addAdresyPocztum(\Backend\AdministracyjneBundle\Entity\Adres $adresyPocztum)
    {
        $this->adresy_poczta[] = $adresyPocztum;

        return $this;
    }

    /**
     * Remove adresyPocztum
     *
     * @param \Backend\AdministracyjneBundle\Entity\Adres $adresyPocztum
     */
    public function removeAdresyPocztum(\Backend\AdministracyjneBundle\Entity\Adres $adresyPocztum)
    {
        $this->adresy_poczta->removeElement($adresyPocztum);
    }

    /**
     * Get adresyPoczta
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdresyPoczta()
    {
        return $this->adresy_poczta;
    }
}
