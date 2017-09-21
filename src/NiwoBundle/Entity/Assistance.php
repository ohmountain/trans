<?php

namespace NiwoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Assistance
 *
 * @ORM\Table(name="assistance")
 * @ORM\Entity(repositoryClass="NiwoBundle\Repository\AssistanceRepository")
 */
class Assistance
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
     * @ORM\Column(name="sid", type="string", length=32, unique=true, options={"comment": "身份证号"})
     */
    private $sid;

    /**
     * @var string
     *
     * @ORM\Column(name="cert", type="string", length=255, options={"comment": "存证哈希"})
     */
    private $cert;

    /**
     * @var bool
     *
     * @ORM\Column(name="eligibility", type="boolean", options={"comment": "是否获得救助"})
     */
    private $eligibility;


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
     * Set sid
     *
     * @param string $sid
     *
     * @return Assistance
     */
    public function setSid($sid)
    {
        $this->sid = $sid;

        return $this;
    }

    /**
     * Get sid
     *
     * @return string
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * Set cert
     *
     * @param string $cert
     *
     * @return Assistance
     */
    public function setCert($cert)
    {
        $this->cert = $cert;

        return $this;
    }

    /**
     * Get cert
     *
     * @return string
     */
    public function getCert()
    {
        return $this->cert;
    }

    /**
     * Set eligibility
     *
     * @param boolean $eligibility
     *
     * @return Assistance
     */
    public function setEligibility($eligibility)
    {
        $this->eligibility = $eligibility;

        return $this;
    }

    /**
     * Get eligibility
     *
     * @return bool
     */
    public function getEligibility()
    {
        return $this->eligibility;
    }
}

