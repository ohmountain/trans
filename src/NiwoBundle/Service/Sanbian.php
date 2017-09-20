<?php

namespace  NiwoBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Curl\Curl;

/**
 ** 获取三变信息
 **/
class Sanbian
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * 获取土地确权信息
     *
     * @param string $id
     *
     * @return array
     */
    public function land(string $id): \stdClass
    {

        $em = $this->container->get("doctrine")->getManager();
        $rep = $em->getRepository("NiwoBundle\Entity\LandRights");

        $person = $rep->findBy(["ownerSid" => $id]);

        if (count($person) == 0) {
            return json_decode(json_encode([
                "error" => false,
                "message" => "",
                "data" => []
            ]));
        }

        $data = [];

        $p = $person[0];

        $data = [
            "comm_name" => $p->getCommName(),
            "comm_pp_name" => $p->getCommPpName(),
            "owner_id" => $p->getOwnerId(),
            "owner_name" => $p->getOwnerName(),
            "owner_gender" => $p->getOwnerGender(),
            "owner_sid" => $p->getOwnerSid(),
            "family_name" => $p->getFamilyName(),
            "family_sid" => $p->getFamilySid(),
            "family_gender" => $p->getFamilyGender(),
            "relationship" => $p->getRelationship(),
            "block" => []
        ];

        foreach ($p->getBlocks() as $block) {
            $data["block"][] = [
                "block_name" => $block->getBlockName(),
                "block_area" => $block->getBlockArea(),
                "block_type" => $block->getBlockType(),
                "block_no"   => $block->getBlockNo(),
                "block_coordinate" => $block->getBlockCoordinate(),
                "block_shape" => $block->getBlockShape(),
                "usage_status" => $block->getUsageStatus()
            ];
        }


        return json_decode(json_encode([
            "error" => false,
            "message" => "",
            "data" => $data
        ]));
    }


    /**
     * 获取林权信息
     *
     * @param string $id
     *
     * @return array
     */
    public function woodland(string $id): \stdClass
    {
        $curl = new Curl();

        $curl->setOpt(CURLOPT_TIMEOUT, $this->container->getParameter("niwo")["sanbian"]["timeout"]);
        $url  = $this->container->getParameter("niwo")["sanbian"]["woodland"];
        $url  = "{$url}?idCare={$id}";

        $result = $curl->get($url);

        if ($result->error == true) {

            $this->container->get("logger")->error("获取林权信息出错",["url" => $url, "message" => $result->error_message]);

            return json_decode(json_encode([
                "error" => true,
                "message" => $result->error_message,
                "data" => null
            ]));
        }

        $data = json_decode($result->response, true);

        return json_decode(json_encode([
            "error" => false,
            "message" => "",
            "data" => $data["value"]
        ]));
    }


    /**
     * 获取房屋产权信息
     *
     * @param string $id
     *
     * @return array
     */
    public function housing(string $id): \stdClass
    {
        $curl = new Curl();

        $curl->setOpt(CURLOPT_TIMEOUT, $this->container->getParameter("niwo")["sanbian"]["timeout"]);
        $url  = $this->container->getParameter("niwo")["sanbian"]["housing"];
        $url  = "{$url}?idCare={$id}";

        $result = $curl->get($url);

        if ($result->error == true) {

            $this->container->get("logger")->error("获取房屋产权信息出错",["url" => $url, "message" => $result->error_message]);

            return json_decode(json_encode([
                "error" => true,
                "message" => $result->error_message,
                "data" => null
            ]));
        }

        $data = json_decode($result->response, true);

        return json_decode(json_encode([
            "error" => false,
            "message" => "",
            "data" => $data["value"]
        ]));
    }
}