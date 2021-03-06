<?php

namespace NiwoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * land_rights
 *
 * @ORM\Table(name="land_rights")
 * @ORM\Entity(repositoryClass="NiwoBundle\Repository\LandRightsRepository")
 */
class LandRights
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="comm_name", type="string", length=255)
     */
    private $commName;

    /**
     * @var string
     *
     * @ORM\Column(name="comm_pp_name", type="string", length=255)
     */
    private $commPpName;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_id", type="string", length=255)
     */
    private $ownerId;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_name", type="string", length=255)
     */
    private $ownerName;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_gender", type="string", length=255)
     */
    private $ownerGender;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_contact", type="string", length=255)
     */
    private $ownerContact;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_sid", type="string", length=255)
     */
    private $ownerSid;

    /**
     * @var string
     *
     * @ORM\Column(name="family_name", type="string", length=255)
     */
    private $familyName;

    /**
     * @var string
     *
     * @ORM\Column(name="family_gender", type="string", length=255)
     */
    private $familyGender;

    /**
     * @var string
     *
     * @ORM\Column(name="family_sid", type="string", length=255)
     */
    private $familySid;

    /**
     * @var string
     *
     * @ORM\Column(name="relationship", type="string", length=255)
     */
    private $relationship;

    /**
     * @ORM\OneToMany(targetEntity="LandBlock", mappedBy="owner")
     */
    private $blocks;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set commName
     *
     * @param string $commName
     *
     * @return land_rights
     */
    public function setCommName($commName)
    {
        $this->commName = $commName;

        return $this;
    }

    /**
     * Get commName
     *
     * @return string
     */
    public function getCommName()
    {
        return $this->commName;
    }

    /**
     * Set commPpName
     *
     * @param string $commPpName
     *
     * @return land_rights
     */
    public function setCommPpName($commPpName)
    {
        $this->commPpName = $commPpName;

        return $this;
    }

    /**
     * Get commPpName
     *
     * @return string
     */
    public function getCommPpName()
    {
        return $this->commPpName;
    }

    /**
     * Set ownerId
     *
     * @param string $ownerId
     *
     * @return land_rights
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;

        return $this;
    }

    /**
     * Get ownerId
     *
     * @return string
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * Set ownerName
     *
     * @param string $ownerName
     *
     * @return land_rights
     */
    public function setOwnerName($ownerName)
    {
        $this->ownerName = $ownerName;

        return $this;
    }

    /**
     * Get ownerName
     *
     * @return string
     */
    public function getOwnerName()
    {
        return $this->ownerName;
    }

    /**
     * Set ownerGender
     *
     * @param string $ownerGender
     *
     * @return land_rights
     */
    public function setOwnerGender($ownerGender)
    {
        $this->ownerGender = $ownerGender;

        return $this;
    }

    /**
     * Get ownerGender
     *
     * @return string
     */
    public function getOwnerGender()
    {
        return $this->ownerGender;
    }

    /**
     * Set ownerContact
     *
     * @param string $ownerContact
     *
     * @return land_rights
     */
    public function setOwnerContact($ownerContact)
    {
        $this->ownerContact = $ownerContact;

        return $this;
    }

    /**
     * Get ownerContact
     *
     * @return string
     */
    public function getOwnerContact()
    {
        return $this->ownerContact;
    }

    /**
     * Set ownerSid
     *
     * @param string $ownerSid
     *
     * @return land_rights
     */
    public function setOwnerSid($ownerSid)
    {
        $this->ownerSid = $ownerSid;

        return $this;
    }

    /**
     * Get ownerSid
     *
     * @return string
     */
    public function getOwnerSid()
    {
        return $this->ownerSid;
    }

    /**
     * Set familyName
     *
     * @param string $familyName
     *
     * @return land_rights
     */
    public function setFamilyName($familyName)
    {
        $this->familyName = $familyName;

        return $this;
    }

    /**
     * Get familyName
     *
     * @return string
     */
    public function getFamilyName()
    {
        return $this->familyName;
    }

    /**
     * Set familyGender
     *
     * @param string $familyGender
     *
     * @return land_rights
     */
    public function setFamilyGender($familyGender)
    {
        $this->familyGender = $familyGender;

        return $this;
    }

    /**
     * Get familyGender
     *
     * @return string
     */
    public function getFamilyGender()
    {
        return $this->familyGender;
    }

    /**
     * Set familySid
     *
     * @param string $familySid
     *
     * @return land_rights
     */
    public function setFamilySid($familySid)
    {
        $this->familySid = $familySid;

        return $this;
    }

    /**
     * Get familySid
     *
     * @return string
     */
    public function getFamilySid()
    {
        return $this->familySid;
    }

    /**
     * Set relationship
     *
     * @param string $relationship
     *
     * @return land_rights
     */
    public function setRelationship($relationship)
    {
        $this->relationship = $relationship;

        return $this;
    }

    /**
     * Get relationship
     *
     * @return string
     */
    public function getRelationship()
    {
        return $this->relationship;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->blocks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add block
     *
     * @param \NiwoBundle\Entity\LandBlock $block
     *
     * @return LandRights
     */
    public function addBlock(\NiwoBundle\Entity\LandBlock $block)
    {
        $this->blocks[] = $block;

        return $this;
    }

    /**
     * Remove block
     *
     * @param \NiwoBundle\Entity\LandBlock $block
     */
    public function removeBlock(\NiwoBundle\Entity\LandBlock $block)
    {
        $this->blocks->removeElement($block);
    }

    /**
     * Get blocks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlocks()
    {
        return $this->blocks;
    }
}
