<?php

namespace Backend\PoiBundle\Entity;

/**
 * PoiCategory
 */
class PoiCategory
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $czyglowny;

    /**
     * @var \Backend\PoiBundle\Entity\Poi
     */
    private $poi;

    /**
     * @var \Application\Sonata\ClassificationBundle\Entity\Category
     */
    private $category;


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
     * Set czyglowny
     *
     * @param boolean $czyglowny
     *
     * @return PoiCategory
     */
    public function setCzyglowny($czyglowny)
    {
        $this->czyglowny = $czyglowny;

        return $this;
    }

    /**
     * Get czyglowny
     *
     * @return boolean
     */
    public function getCzyglowny()
    {
        return $this->czyglowny;
    }

    /**
     * Set poi
     *
     * @param \Backend\PoiBundle\Entity\Poi $poi
     *
     * @return PoiCategory
     */
    public function setPoi(\Backend\PoiBundle\Entity\Poi $poi = null)
    {
        $this->poi = $poi;

        return $this;
    }

    /**
     * Get poi
     *
     * @return \Backend\PoiBundle\Entity\Poi
     */
    public function getPoi()
    {
        return $this->poi;
    }

    /**
     * Set category
     *
     * @param \Application\Sonata\ClassificationBundle\Entity\Category $category
     *
     * @return PoiCategory
     */
    public function setCategory(\Application\Sonata\ClassificationBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Application\Sonata\ClassificationBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
