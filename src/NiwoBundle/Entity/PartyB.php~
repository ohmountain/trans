<?php

namespace NiwoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PartyB
 *
 * @ORM\Table(name="party_b")
 * @ORM\Entity(repositoryClass="NiwoBundle\Repository\PartyBRepository")
 */
class PartyB
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
     * @ORM\Column(name="bc_id", type="string", length=255, unique=true, options={"comment":"身份链ID"})
     */
    private $bcId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, options={"comment":"乙方名称"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=255, options={"comment":"联系方式"})
     */
    private $contact;


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
     * @return PartB
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
     * Set name
     *
     * @param string $name
     *
     * @return PartB
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return PartB
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }
}

