<?php

namespace NiwoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LandBlock
 *
 * @ORM\Table(name="land_block")
 * @ORM\Entity(repositoryClass="NiwoBundle\Repository\LandBlockRepository")
 */
class LandBlock
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
     * @ORM\Column(name="block_name", type="string", length=255)
     */
    private $blockName;

    /**
     * @var float
     *
     * @ORM\Column(name="block_area", type="float")
     */
    private $blockArea;

    /**
     * @var string
     *
     * @ORM\Column(name="block_type", type="string", length=255)
     */
    private $blockType;

    /**
     * @var string
     *
     * @ORM\Column(name="block_no", type="string" )
     */
    private $blockNo;

    /**
     * @var string
     *
     * @ORM\Column(name="block_coordinate", type="string", length=255)
     */
    private $blockCoordinate;

    /**
     * @var string
     *
     * @ORM\Column(name="block_shape", type="string", length=255)
     */
    private $blockShape;

    /**
     * @var int
     *
     * @ORM\Column(name="usage_status", type="smallint")
     */
    private $usageStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="contract_id_hash", type="string", length=255)
     */
    private $contractIdHash;

    /**
     * @ORM\ManyToOne(targetEntity="LandRights", inversedBy="blocks")
     */
    private $owner;


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
     * Set blockName
     *
     * @param string $blockName
     *
     * @return LandBlock
     */
    public function setBlockName($blockName)
    {
        $this->blockName = $blockName;

        return $this;
    }

    /**
     * Get blockName
     *
     * @return string
     */
    public function getBlockName()
    {
        return $this->blockName;
    }

    /**
     * Set blockArea
     *
     * @param float $blockArea
     *
     * @return LandBlock
     */
    public function setBlockArea($blockArea)
    {
        $this->blockArea = $blockArea;

        return $this;
    }

    /**
     * Get blockArea
     *
     * @return float
     */
    public function getBlockArea()
    {
        return $this->blockArea;
    }

    /**
     * Set blockType
     *
     * @param string $blockType
     *
     * @return LandBlock
     */
    public function setBlockType($blockType)
    {
        $this->blockType = $blockType;

        return $this;
    }

    /**
     * Get blockType
     *
     * @return string
     */
    public function getBlockType()
    {
        return $this->blockType;
    }

    /**
     * Set blockNo
     *
     * @param string $blockNo
     *
     * @return LandBlock
     */
    public function setBlockNo($blockNo)
    {
        $this->blockNo = $blockNo;

        return $this;
    }

    /**
     * Get blockNo
     *
     * @return string
     */
    public function getBlockNo()
    {
        return $this->blockNo;
    }

    /**
     * Set blockCoordinate
     *
     * @param string $blockCoordinate
     *
     * @return LandBlock
     */
    public function setBlockCoordinate($blockCoordinate)
    {
        $this->blockCoordinate = $blockCoordinate;

        return $this;
    }

    /**
     * Get blockCoordinate
     *
     * @return string
     */
    public function getBlockCoordinate()
    {
        return $this->blockCoordinate;
    }

    /**
     * Set blockShape
     *
     * @param string $blockShape
     *
     * @return LandBlock
     */
    public function setBlockShape($blockShape)
    {
        $this->blockShape = $blockShape;

        return $this;
    }

    /**
     * Get blockShape
     *
     * @return string
     */
    public function getBlockShape()
    {
        return $this->blockShape;
    }

    /**
     * Set usageStatus
     *
     * @param integer $usageStatus
     *
     * @return LandBlock
     */
    public function setUsageStatus($usageStatus)
    {
        $this->usageStatus = $usageStatus;

        return $this;
    }

    /**
     * Get usageStatus
     *
     * @return int
     */
    public function getUsageStatus()
    {
        return $this->usageStatus;
    }

    /**
     * Set contractIdHash
     *
     * @param string $contractIdHash
     *
     * @return LandBlock
     */
    public function setContractIdHash($contractIdHash)
    {
        $this->contractIdHash = $contractIdHash;

        return $this;
    }

    /**
     * Get contractIdHash
     *
     * @return string
     */
    public function getContractIdHash()
    {
        return $this->contractIdHash;
    }

    /**
     * Set owner
     *
     * @param LandRights $owner
     *
     * @return LandBlock
     */
    public function setOwner(LandRights $owner)
    {
        $this->owner = $owner;
    }

    /**
     * Get owner
     *
     * @return LandRights $owner
     */
    public function getOwner()
    {
        return $this->owner;
    }
}

