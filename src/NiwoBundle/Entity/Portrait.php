<?php

namespace NiwoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Portrait
 *
 * @ORM\Table(name="portrait", indexes={
 *    @ORM\Index(name="portrait_timestamp_index", columns={"timestamp"})
 * })
 * @ORM\Entity(repositoryClass="NiwoBundle\Repository\PortraitRepository")
 */
class Portrait
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=255)
     */
    private $place;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="timestamp", type="string", length=14)
     */
    private $timestamp;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="portraits")
     */
    private $person;

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
     * Set name
     *
     * @param string $name
     *
     * @return Portrait
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
     * Set place
     *
     * @param string $place
     *
     * @return Portrait
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Portrait
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
     * Set timestamp
     *
     * @param string $timestamp
     *
     * @return Portrait
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set person
     *
     * @param \NiwoBundle\Entity\Person $person
     *
     * @return Portrait
     */
    public function setPerson(\NiwoBundle\Entity\Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \NiwoBundle\Entity\Person
     */
    public function getPerson()
    {
        return $this->person;
    }
}
