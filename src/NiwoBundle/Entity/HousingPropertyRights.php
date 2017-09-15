<?php

namespace NiwoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HousingPropertyRights
 *
 * @ORM\Table(name="housing_property_rights")
 * @ORM\Entity(repositoryClass="NiwoBundle\Repository\HousingPropertyRightsRepository")
 */
class HousingPropertyRights
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
     * @ORM\Column(name="property_number", type="string", length=32, unique=true, options={"comment":"产权证书号"})
     */
    private $propertyNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_name", type="string", length=255, options={"comment":"户主姓名"})
     */
    private $ownerName;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_id", type="string", length=18, options={"comment":"户主身份证号码"})
     */
    private $ownerId;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_id_hash", type="string", length=255, options={"comment":"户主身份证号码hash"})
     */
    private $ownerIdHash;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, options={"comment":"房屋地址"})
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="comm_name", type="string", length=255, options={"comment": "村委会名称"})
     */
    private $commName;

    /**
     * @var string
     *
     * @ORM\Column(name="comm_pp_name", type="string", length=255, options={"comment":"村委组名称"})
     */
    private $commPpName;

    /**
     * @var string
     *
     * @ORM\Column(name="east", type="string", length=255, options={"comment":"东"})
     */
    private $east;

    /**
     * @var string
     *
     * @ORM\Column(name="south", type="string", length=255, options={"comment":"南"})
     */
    private $south;

    /**
     * @var string
     *
     * @ORM\Column(name="west", type="string", length=255, options={"comment":"西"})
     */
    private $west;

    /**
     * @var string
     *
     * @ORM\Column(name="north", type="string", length=255, options={"comment":"北"})
     */
    private $north;

    /**
     * @var float
     *
     * @ORM\Column(name="construction_area", type="float", options={"comment":"房屋建筑面积"})
     */
    private $constructionArea;

    /**
     * @var float
     *
     * @ORM\Column(name="house_area", type="float", options={"comment":"房屋占地面积"})
     */
    private $houseArea;

    /**
     * @var string
     *
     * @ORM\Column(name="house_style", type="string", length=255, options={"comment":"房屋结构"})
     */
    private $houseStyle;

    /**
     * @var string
     *
     * @ORM\Column(name="authorized_date", type="string", length=8, nullable=true, options={"comment":"发证日期"})
     */
    private $authorizedDate;

    /**
     * @var string
     *
     * @ORM\Column(name="authorized_dept", type="string", length=255, nullable=true, options={"comment":"发证机关"})
     */
    private $authorizedDept;


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
     * Set propertyNumber
     *
     * @param string $propertyNumber
     *
     * @return HousingPropertyRights
     */
    public function setPropertyNumber($propertyNumber)
    {
        $this->propertyNumber = $propertyNumber;

        return $this;
    }

    /**
     * Get propertyNumber
     *
     * @return string
     */
    public function getPropertyNumber()
    {
        return $this->propertyNumber;
    }

    /**
     * Set ownerName
     *
     * @param string $ownerName
     *
     * @return HousingPropertyRights
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
     * Set ownerId
     *
     * @param string $ownerId
     *
     * @return HousingPropertyRights
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
     * @return HousingPropertyRights
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
     * Set address
     *
     * @param string $address
     *
     * @return HousingPropertyRights
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set commName
     *
     * @param string $commName
     *
     * @return HousingPropertyRights
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
     * @return HousingPropertyRights
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
     * @return HousingPropertyRights
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
     * @return HousingPropertyRights
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
     * @return HousingPropertyRights
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
     * @return HousingPropertyRights
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
     * Set constructionArea
     *
     * @param float $constructionArea
     *
     * @return HousingPropertyRights
     */
    public function setConstructionArea($constructionArea)
    {
        $this->constructionArea = $constructionArea;

        return $this;
    }

    /**
     * Get constructionArea
     *
     * @return float
     */
    public function getConstructionArea()
    {
        return $this->constructionArea;
    }

    /**
     * Set houseArea
     *
     * @param float $houseArea
     *
     * @return HousingPropertyRights
     */
    public function setHouseArea($houseArea)
    {
        $this->houseArea = $houseArea;

        return $this;
    }

    /**
     * Get houseArea
     *
     * @return float
     */
    public function getHouseArea()
    {
        return $this->houseArea;
    }

    /**
     * Set houseStyle
     *
     * @param string $houseStyle
     *
     * @return HousingPropertyRights
     */
    public function setHouseStyle($houseStyle)
    {
        $this->houseStyle = $houseStyle;

        return $this;
    }

    /**
     * Get houseStyle
     *
     * @return string
     */
    public function getHouseStyle()
    {
        return $this->houseStyle;
    }

    /**
     * Set authorizedDate
     *
     * @param string $authorizedDate
     *
     * @return HousingPropertyRights
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
     * Set authorizedDept
     *
     * @param string $authorizedDept
     *
     * @return HousingPropertyRights
     */
    public function setAuthorizedDept($authorizedDept)
    {
        $this->authorizedDept = $authorizedDept;

        return $this;
    }

    /**
     * Get authorizedDept
     *
     * @return string
     */
    public function getAuthorizedDept()
    {
        return $this->authorizedDept;
    }
}
