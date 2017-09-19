<?php

namespace NiwoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rental
 *
 * @ORM\Table(name="rental",indexes={
 *     @ORM\Index(name="rental_partya_id", columns={"partya_id"}),
 *     @ORM\Index(name="rental_partyb_id", columns={"partyb_id"}),
 *     @ORM\Index(name="rental_partya_name", columns={"partya_name"}),
 *     @ORM\Index(name="rental_partyb_name", columns={"partyb_name"})
 * })
 * @ORM\Entity(repositoryClass="NiwoBundle\Repository\RentalRepository")
 */
class Rental
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
     * @ORM\Column(name="partya_name", type="string", length=255)
     */
    private $partyaName;

    /**
     * @var string
     *
     * @ORM\Column(name="partya_id", type="string", length=255)
     */
    private $partyaId;

    /**
     * @var string
     *
     * @ORM\Column(name="partya_contact", type="string", length=255)
     */
    private $partyaContact;

    /**
     * @var string
     *
     * @ORM\Column(name="partyb_name", type="string", length=255)
     */
    private $partybName;

    /**
     * @var string
     *
     * @ORM\Column(name="partyb_id", type="string", length=255)
     */
    private $partybId;

    /**
     * @var string
     *
     * @ORM\Column(name="partyb_contact", type="string", length=255)
     */
    private $partybContact;

    /**
     * @var string
     *
     * @ORM\Column(name="start_time", type="string", length=255)
     */
    private $startTime;

    /**
     * @var string
     *
     * @ORM\Column(name="end_time", type="string", length=255)
     */
    private $endTime;

    /**
     * @var float
     *
     * @ORM\Column(name="expense", type="float")
     */
    private $expense;

    /**
     * @var array
     *
     * @ORM\Column(name="block", type="json_array")
     */
    private $block;

    /**
     * @var block_no
     *
     * @ORM\Column(name="block_no", type="string")
     */
    private $block_no;


    /**
     * @var block_area
     *
     * @ORM\Column(name="block_area", type="float")
     */
    private $block_area;

    /**
     * @var array
     *
     * @ORM\Column(name="images", type="array")
     */
    private $images;

    /**
     * @var string
     *
     * @ORM\Column(name="content_hash", type="string")
     */
    private $content_hash;

    /**
     * @var string
     *
     * @ORM\Column(name="hash", type="string", length=255)
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
     * Set partyaName
     *
     * @param string $partyaName
     *
     * @return Rental
     */
    public function setPartyaName($partyaName)
    {
        $this->partyaName = $partyaName;

        return $this;
    }

    /**
     * Get partyaName
     *
     * @return string
     */
    public function getPartyaName()
    {
        return $this->partyaName;
    }

    /**
     * Set partyaId
     *
     * @param string $partyaId
     *
     * @return Rental
     */
    public function setPartyaId($partyaId)
    {
        $this->partyaId = $partyaId;

        return $this;
    }

    /**
     * Get partyaId
     *
     * @return string
     */
    public function getPartyaId()
    {
        return $this->partyaId;
    }

    /**
     * Set partyaContact
     *
     * @param string $partyaContact
     *
     * @return Rental
     */
    public function setPartyaContact($partyaContact)
    {
        $this->partyaContact = $partyaContact;

        return $this;
    }

    /**
     * Get partyaContact
     *
     * @return string
     */
    public function getPartyaContact()
    {
        return $this->partyaContact;
    }

    /**
     * Set partybName
     *
     * @param string $partybName
     *
     * @return Rental
     */
    public function setPartybName($partybName)
    {
        $this->partybName = $partybName;

        return $this;
    }

    /**
     * Get partybName
     *
     * @return string
     */
    public function getPartybName()
    {
        return $this->partybName;
    }

    /**
     * Set partybId
     *
     * @param string $partybId
     *
     * @return Rental
     */
    public function setPartybId($partybId)
    {
        $this->partybId = $partybId;

        return $this;
    }

    /**
     * Get partybId
     *
     * @return string
     */
    public function getPartybId()
    {
        return $this->partybId;
    }

    /**
     * Set partybContact
     *
     * @param string $partybContact
     *
     * @return Rental
     */
    public function setPartybContact($partybContact)
    {
        $this->partybContact = $partybContact;

        return $this;
    }

    /**
     * Get partybContact
     *
     * @return string
     */
    public function getPartybContact()
    {
        return $this->partybContact;
    }

    /**
     * Set startTime
     *
     * @param string $startTime
     *
     * @return Rental
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return string
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param string $endTime
     *
     * @return Rental
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return string
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set expense
     *
     * @param float $expense
     *
     * @return Rental
     */
    public function setExpense($expense)
    {
        $this->expense = $expense;

        return $this;
    }

    /**
     * Get expense
     *
     * @return float
     */
    public function getExpense()
    {
        return $this->expense;
    }

    /**
     * Set block
     *
     * @param array $block
     *
     * @return Rental
     */
    public function setBlock($block)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return array
     */
    public function getBlock()
    {
        return $this->block;
    }


    /**
     * Set block_no
     *
     * @param string $block_no
     *
     * @return Rental
     */
    public function setBlockNo($block_no)
    {
        $this->block_no = $block_no;

        return $this;
    }

    /**
     * Get block_no
     *
     * @return string
     */
    public function getBlockNo()
    {
        return $this->block_no;
    }

    /**
     * Set block_area
     *
     * @return Rental
     */
    public function setBlockArea($block_area)
    {
        $this->block_area = $block_area;

        return $this;
    }

    /**
     * Get block_area
     *
     * @return float
     */
    public function getBlockArea()
    {
        return $this->block_area;
    }

    /**
     * Set images
     *
     * @param array $images
     *
     * @return Rental
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get images
     *
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set hash
     *
     * @param string $hash
     *
     * @return Rental
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
     * Set content_hash
     *
     * @param string $content_hash
     *
     * @return Rental
     */
    public function setContentHash($content_hash)
    {
        $this->content_hash = $content_hash;

        return $this;
    }

    /**
     * Get content_hash
     *
     * @return string
     */
    public function getContentHash()
    {
        return $this->content_hash;
    }
}

