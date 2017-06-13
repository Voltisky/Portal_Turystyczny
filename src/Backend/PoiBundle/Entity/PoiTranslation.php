<?php

namespace Backend\PoiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation;

/**
 * PoiTranslation
 */
class PoiTranslation extends AbstractPersonalTranslation
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var string
     */
    protected $field;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var \Backend\PoiBundle\Entity\Poi
     */

    public function __construct($locale = null, $field = null, $content = null)
    {
        $this->setLocale($locale);
        $this->setField($field);
        $this->setContent($content);
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
     * Set locale
     *
     * @param string $locale
     * @return PoiTranslation
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set field
     *
     * @param string $field
     * @return PoiTranslation
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field
     *
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return PoiTranslation
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }


    /**
     * @var \Backend\PoiBundle\Entity\Poi
     */
    protected $object;

    /**
     * Set object
     *
     * @param \Backend\PoiBundle\Entity\Poi $object
     * @return PoiTranslation
     */
    public function setObject($object = null)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return \Backend\PoiBundle\Entity\Poi
     */
    public function getObject()
    {
        return $this->object;
    }
}
