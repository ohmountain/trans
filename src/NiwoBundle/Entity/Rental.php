<?php

namespace NiwoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rental
 *
 * @ORM\Table(name="rental",indexes={
 *     @ORM\Index(name="rental_parta_id", columns={"parta_id"})
 *     @ORM\Index(name="rental_partb_id", columns={"partb_id"})
 *     @ORM\Index(name="rental_parta_name", columns={"parta_name"})
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
     * @ORM\Column(name="parta__name", type="string", length=255)
     */
    private $partaName;

    /**
     * @var string
     *
     * @ORM\Column(name="parta_id", type="string", length=255)
     */
    private $partaId;

    /**
     * @var string
     *
     * @ORM\Column(name="parta_contact", type="string", length=255)
     */
    private $partaContact;

    /**
     * @var string
     *
     * @ORM\Column(name="partb_name", type="string", length=255)
     */
    private $partbName;

    /**
     * @var string
     *
     * @ORM\Column(name="partb_id", type="string", length=255)
     */
    private $partbId;

    /**
     * @var string
     *
     * @ORM\Column(name="partb_contact", type="string", length=255)
     */
    private $partbContact;

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
     * @var array
     *
     * @ORM\Column(name="images", type="array")
     */
    private $images;

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
     * Set partaName
     *
     * @param string $partaName
     *
     * @return Rental
     */
    public function setPartaName($partaName)
    {
        $this->partaName = $partaName;

        return $this;
    }

    /**
     * Get partaName
     *
     * @return string
     */
    public function getPartaName()
    {
        return $this->partaName;
    }

    /**
     * Set partaId
     *
     * @param string $partaId
     *
     * @return Rental
     */
    public function setPartaId($partaId)
    {
        $this->partaId = $partaId;

        return $this;
    }

    /**
     * Get partaId
     *
     * @return string
     */
    public function getPartaId()
    {
        return $this->partaId;
    }

    /**
     * Set partaContact
     *
     * @param string $partaContact
     *
     * @return Rental
     */
    public function setPartaContact($partaContact)
    {
        $this->partaContact = $partaContact;

        return $this;
    }

    /**
     * Get partaContact
     *
     * @return string
     */
    public function getPartaContact()
    {
        return $this->partaContact;
    }

    /**
     * Set partbName
     *
     * @param string $partbName
     *
     * @return Rental
     */
    public function setPartbName($partbName)
    {
        $this->partbName = $partbName;

        return $this;
    }

    /**
     * Get partbName
     *
     * @return string
     */
    public function getPartbName()
    {
        return $this->partbName;
    }

    /**
     * Set partbId
     *
     * @param string $partbId
     *
     * @return Rental
     */
    public function setPartbId($partbId)
    {
        $this->partbId = $partbId;

        return $this;
    }

    /**
     * Get partbId
     *
     * @return string
     */
    public function getPartbId()
    {
        return $this->partbId;
    }

    /**
     * Set partbContact
     *
     * @param string $partbContact
     *
     * @return Rental
     */
    public function setPartbContact($partbContact)
    {
        $this->partbContact = $partbContact;

        return $this;
    }

    /**
     * Get partbContact
     *
     * @return string
     */
    public function getPartbContact()
    {
        return $this->partbContact;
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
}

