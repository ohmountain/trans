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

}
