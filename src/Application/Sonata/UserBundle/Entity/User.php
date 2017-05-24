<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;

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
class User extends BaseUser
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $poi;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $poi_created;


    /**
     * Add poi
     *
     * @param \Backend\PoiBundle\Entity\Poi $poi
     *
     * @return User
     */
    public function addPoi(\Backend\PoiBundle\Entity\Poi $poi)
    {
        $this->poi[] = $poi;

        return $this;
    }

    /**
     * Remove poi
     *
     * @param \Backend\PoiBundle\Entity\Poi $poi
     */
    public function removePoi(\Backend\PoiBundle\Entity\Poi $poi)
    {
        $this->poi->removeElement($poi);
    }

    /**
     * Get poi
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPoi()
    {
        return $this->poi;
    }

    /**
     * Add poiCreated
     *
     * @param \Backend\PoiBundle\Entity\Poi $poiCreated
     *
     * @return User
     */
    public function addPoiCreated(\Backend\PoiBundle\Entity\Poi $poiCreated)
    {
        $this->poi_created[] = $poiCreated;

        return $this;
    }

    /**
     * Remove poiCreated
     *
     * @param \Backend\PoiBundle\Entity\Poi $poiCreated
     */
    public function removePoiCreated(\Backend\PoiBundle\Entity\Poi $poiCreated)
    {
        $this->poi_created->removeElement($poiCreated);
    }

    /**
     * Get poiCreated
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPoiCreated()
    {
        return $this->poi_created;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $poi_modified;


    /**
     * Add poiModified
     *
     * @param \Backend\PoiBundle\Entity\Poi $poiModified
     *
     * @return User
     */
    public function addPoiModified(\Backend\PoiBundle\Entity\Poi $poiModified)
    {
        $this->poi_modified[] = $poiModified;

        return $this;
    }

    /**
     * Remove poiModified
     *
     * @param \Backend\PoiBundle\Entity\Poi $poiModified
     */
    public function removePoiModified(\Backend\PoiBundle\Entity\Poi $poiModified)
    {
        $this->poi_modified->removeElement($poiModified);
    }

    /**
     * Get poiModified
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPoiModified()
    {
        return $this->poi_modified;
    }
}
