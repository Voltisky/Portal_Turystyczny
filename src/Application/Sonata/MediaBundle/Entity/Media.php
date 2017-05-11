<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\MediaBundle\Entity;

use Sonata\MediaBundle\Entity\BaseMedia as BaseMedia;

/**
 * This file has been generated by the Sonata EasyExtends bundle.
 *
 * @link https://sonata-project.org/bundles/easy-extends
 *
 * References :
 *   working with object : http://www.doctrine-project.org/projects/orm/2.0/docs/reference/working-with-objects/en
 *
 * @author <yourname> <youremail>
 */
class Media extends BaseMedia
{
    /**
     * @var int $id
     */
    protected $id;

    /**
     * Get id
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->galleryHasMedias = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add galleryHasMedia
     *
     * @param \Application\Sonata\MediaBundle\Entity\GalleryHasMedia $galleryHasMedia
     *
     * @return Media
     */
    public function addGalleryHasMedia(\Application\Sonata\MediaBundle\Entity\GalleryHasMedia $galleryHasMedia)
    {
        $this->galleryHasMedias[] = $galleryHasMedia;

        return $this;
    }

    /**
     * Remove galleryHasMedia
     *
     * @param \Application\Sonata\MediaBundle\Entity\GalleryHasMedia $galleryHasMedia
     */
    public function removeGalleryHasMedia(\Application\Sonata\MediaBundle\Entity\GalleryHasMedia $galleryHasMedia)
    {
        $this->galleryHasMedias->removeElement($galleryHasMedia);
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $poi_media;


    /**
     * Add poiMedia
     *
     * @param \Backend\PoiBundle\Entity\PoiMedia $poiMedia
     *
     * @return Media
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
     * Set category
     *
     * @param \Application\Sonata\ClassificationBundle\Entity\Category $category
     *
     * @return Media
     */
    public function setCategory(\Application\Sonata\ClassificationBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $konfiguracja_logo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $konfiguracja_default_image;


    /**
     * Add konfiguracjaLogo
     *
     * @param \Backend\CommonBundle\Entity\Konfiguracja $konfiguracjaLogo
     *
     * @return Media
     */
    public function addKonfiguracjaLogo(\Backend\CommonBundle\Entity\Konfiguracja $konfiguracjaLogo)
    {
        $this->konfiguracja_logo[] = $konfiguracjaLogo;

        return $this;
    }

    /**
     * Remove konfiguracjaLogo
     *
     * @param \Backend\CommonBundle\Entity\Konfiguracja $konfiguracjaLogo
     */
    public function removeKonfiguracjaLogo(\Backend\CommonBundle\Entity\Konfiguracja $konfiguracjaLogo)
    {
        $this->konfiguracja_logo->removeElement($konfiguracjaLogo);
    }

    /**
     * Get konfiguracjaLogo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKonfiguracjaLogo()
    {
        return $this->konfiguracja_logo;
    }

    /**
     * Add konfiguracjaDefaultImage
     *
     * @param \Backend\CommonBundle\Entity\Konfiguracja $konfiguracjaDefaultImage
     *
     * @return Media
     */
    public function addKonfiguracjaDefaultImage(\Backend\CommonBundle\Entity\Konfiguracja $konfiguracjaDefaultImage)
    {
        $this->konfiguracja_default_image[] = $konfiguracjaDefaultImage;

        return $this;
    }

    /**
     * Remove konfiguracjaDefaultImage
     *
     * @param \Backend\CommonBundle\Entity\Konfiguracja $konfiguracjaDefaultImage
     */
    public function removeKonfiguracjaDefaultImage(\Backend\CommonBundle\Entity\Konfiguracja $konfiguracjaDefaultImage)
    {
        $this->konfiguracja_default_image->removeElement($konfiguracjaDefaultImage);
    }

    /**
     * Get konfiguracjaDefaultImage
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKonfiguracjaDefaultImage()
    {
        return $this->konfiguracja_default_image;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $etapy;


    /**
     * Add etapy
     *
     * @param \Backend\PoiBundle\Entity\Etap $etapy
     *
     * @return Media
     */
    public function addEtapy(\Backend\PoiBundle\Entity\Etap $etapy)
    {
        $this->etapy[] = $etapy;

        return $this;
    }

    /**
     * Remove etapy
     *
     * @param \Backend\PoiBundle\Entity\Etap $etapy
     */
    public function removeEtapy(\Backend\PoiBundle\Entity\Etap $etapy)
    {
        $this->etapy->removeElement($etapy);
    }

    /**
     * Get etapy
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtapy()
    {
        return $this->etapy;
    }
}
