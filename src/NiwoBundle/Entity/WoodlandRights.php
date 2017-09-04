<?php

namespace NiwoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WoodlandRights
 *
 * @ORM\Table(name="woodland_rights")
 * @ORM\Entity(repositoryClass="NiwoBundle\Repository\WoodlandRightsRepository")
 */
class WoodlandRights
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
     * @ORM\Column(name="owner_id", type="string", length=255, options={"comments": "所有人ID"})
     */
    private $ownerId;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_id_hash", type="string", length=255, options={"comments": "所有人ID hash"})
     */
    private $ownerIdHash;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_name", type="string", length=255)
     */
    private $ownerName;

    /**
     * @var string
     *
     * @ORM\Column(name="country_name", type="string", length=255, options={"comments": "乡镇"})
     */
    private $countryName;

    /**
     * @var string
     *
     * @ORM\Column(name="comm_name", type="string", length=255, options={"comments": "村委会名称"})
     */
    private $commName;

    /**
     * @var string
     *
     * @ORM\Column(name="comm_pp_name", type="string", length=255, options={"comments":"村民组名称"})
     */
    private $commPpName;

    /**
     * @var string
     *
     * @ORM\Column(name="east", type="string", length=255, nullable=true, options={"comments": "东至"})
     */
    private $east;

    /**
     * @var string
     *
     * @ORM\Column(name="south", type="string", length=255, nullable=true, options={"comments": "南至"})
     */
    private $south;

    /**
     * @var string
     *
     * @ORM\Column(name="west", type="string", length=255, nullable=true, options={"comments": "西至"})
     */
    private $west;

    /**
     * @var string
     *
     * @ORM\Column(name="north", type="string", length=255, nullable=true, options={"comments": "北至"})
     */
    private $north;

    /**
     * @var string
     *
     * @ORM\Column(name="woodland_id", type="string", options={"comments": "林地编号"})
     */

    private $woodlandId;
    /**
     * @var float
     *
     * @ORM\Column(name="area", type="float", options={"comments": "林地面积(亩)"})
     */
    private $area;

    /**
     * @var string
     *
     * @ORM\Column(name="map_author", type="string", options={"comments": "制图人"})
     */
    private $mapAuthor;

    /**
     * @var string
     *
     * @ORM\Column(name="land_name", type="string", options={"comments": "小地名"})
     */
    private $landName;

    /**
     * @var string
     *
     * @ORM\Column(name="tree_type", type="string", options={"comments": "树种"})
     */
    private $treeType;

    /**
     * @var string
     *
     * @ORM\Column(name="valid", type="string", options={"comments": "林地使用期限"})
     */
    private $valid;


    /**
     * @var string
     *
     * @ORM\Column(name="authorized_date", type="string", options={"comments": "发证日期"})
     */
    private $authorizedDate;

    /**
     * @var string
     *
     * @ORM\Column(name="processor", type="string", options={"comments": "经办人"})
     */
    private $processor;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ownerId
     *
     * @param string $ownerId
     *
     * @return WoodlandRights
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
     * Set ownerIdHash
     *
     * @param string $ownerIdHash
     *
     * @return WoodlandRights
     */
    public function setOwnerIdHash($ownerIdHash)
    {
        $this->ownerIdHash = $ownerIdHash;

        return $this;
    }

    /**
     * Get ownerIdHash
     *
     * @return string
     */
    public function getOwnerIdHash()
    {
        return $this->ownerIdHash;
    }

    /**
     * Set ownerName
     *
     * @param string $ownerName
     *
     * @return WoodlandRights
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
     * Set countryName
     *
     * @param string $countryName
     *
     * @return WoodlandRights
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;

        return $this;
    }

    /**
     * Get countryName
     *
     * @return string
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * Set commName
     *
     * @param string $commName
     *
     * @return WoodlandRights
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
     * @return WoodlandRights
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
     * Set east
     *
     * @param string $east
     *
     * @return WoodlandRights
     */
    public function setEast($east)
    {
        $this->east = $east;

        return $this;
    }

    /**
     * Get east
     *
     * @return string
     */
    public function getEast()
    {
        return $this->east;
    }

    /**
     * Set south
     *
     * @param string $south
     *
     * @return WoodlandRights
     */
    public function setSouth($south)
    {
        $this->south = $south;

        return $this;
    }

    /**
     * Get south
     *
     * @return string
     */
    public function getSouth()
    {
        return $this->south;
    }

    /**
     * Set west
     *
     * @param string $west
     *
     * @return WoodlandRights
     */
    public function setWest($west)
    {
        $this->west = $west;

        return $this;
    }

    /**
     * Get west
     *
     * @return string
     */
    public function getWest()
    {
        return $this->west;
    }

    /**
     * Set north
     *
     * @param string $north
     *
     * @return WoodlandRights
     */
    public function setNorth($north)
    {
        $this->north = $north;

        return $this;
    }

    /**
     * Get north
     *
     * @return string
     */
    public function getNorth()
    {
        return $this->north;
    }

    /**
     * Set woodlandId
     *
     * @param string $woodlandId
     *
     * @return WoodlandRights
     */
    public function setWoodlandId($woodlandId)
    {
        $this->woodlandId = $woodlandId;

        return $this;
    }

    /**
     * Get woodlandId
     *
     * @return string
     */
    public function getWoodlandId()
    {
        return $this->woodlandId;
    }

    /**
     * Set area
     *
     * @param float $area
     *
     * @return WoodlandRights
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return float
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set mapAuthor
     *
     * @param string $mapAuthor
     *
     * @return WoodlandRights
     */
    public function setMapAuthor($mapAuthor)
    {
        $this->mapAuthor = $mapAuthor;

        return $this;
    }

    /**
     * Get mapAuthor
     *
     * @return string
     */
    public function getMapAuthor()
    {
        return $this->mapAuthor;
    }

    /**
     * Set landName
     *
     * @param string $landName
     *
     * @return WoodlandRights
     */
    public function setLandName($landName)
    {
        $this->landName = $landName;

        return $this;
    }

    /**
     * Get landName
     *
     * @return string
     */
    public function getLandName()
    {
        return $this->landName;
    }

    /**
     * Set treeType
     *
     * @param string $treeType
     *
     * @return WoodlandRights
     */
    public function setTreeType($treeType)
    {
        $this->treeType = $treeType;

        return $this;
    }

    /**
     * Get treeType
     *
     * @return string
     */
    public function getTreeType()
    {
        return $this->treeType;
    }

    /**
     * Set valid
     *
     * @param string $valid
     *
     * @return WoodlandRights
     */
    public function setValid($valid)
    {
        $this->valid = $valid;

        return $this;
    }

    /**
     * Get valid
     *
     * @return string
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * Set authorizedDate
     *
     * @param string $authorizedDate
     *
     * @return WoodlandRights
     */
    public function setAuthorizedDate($authorizedDate)
    {
        $this->authorizedDate = $authorizedDate;

        return $this;
    }

    /**
     * Get authorizedDate
     *
     * @return string
     */
    public function getAuthorizedDate()
    {
        return $this->authorizedDate;
    }

    /**
     * Set processor
     *
     * @param string $processor
     *
     * @return WoodlandRights
     */
    public function setProcessor($processor)
    {
        $this->processor = $processor;

        return $this;
    }

    /**
     * Get processor
     *
     * @return string
     */
    public function getProcessor()
    {
        return $this->processor;
    }
}
