<?php

namespace NiwoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table(name="person", indexes={ @ORM\Index(name="person_hash_index", columns={"hash"}) })
 * @ORM\Entity(repositoryClass="NiwoBundle\Repository\PersonRepository")
 */
class Person
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
     * @ORM\Column(name="bc_id", type="string", length=255, unique=true)
     */
    private $bcId;

    /**
     * @var string
     *
     * @ORM\Column(name="hash", type="string", length=255, unique=true)
     */
    private $hash;

    /**
     * @ORM\OneToMany(targetEntity="Portrait", mappedBy="person")
     */
    private $portraits;

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
     * Set bcId
     *
     * @param string $bcId
     *
     * @return Person
     */
    public function setBcId($bcId)
    {
        $this->bcId = $bcId;

        return $this;
    }

    /**
     * Get bcId
     *
     * @return string
     */
    public function getBcId()
    {
        return $this->bcId;
    }

    /**
     * Set hash
     *
     * @param string $hash
     *
     * @return Person
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->portraits = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add portrait
     *
     * @param \NiwoBundle\Entity\Portrait $portrait
     *
     * @return Person
     */
    public function addPortrait(\NiwoBundle\Entity\Portrait $portrait)
    {
        $this->portraits[] = $portrait;

        return $this;
    }

    /**
     * Remove portrait
     *
     * @param \NiwoBundle\Entity\Portrait $portrait
     */
    public function removePortrait(\NiwoBundle\Entity\Portrait $portrait)
    {
        $this->portraits->removeElement($portrait);
    }

    /**
     * Get portraits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPortraits()
    {
        return $this->portraits;
    }
}
