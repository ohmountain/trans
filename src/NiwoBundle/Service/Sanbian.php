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
                "block_area" => number_format($block->getBlockArea(), 4),
                "block_type" => $block->getBlockType(),
                "block_no"   => $block->getBlockNo(),
                "block_coordinate" => $block->getBlockCoordinate(),
                "block_shape" => $block->getBlockShape(),
                "contract_id_hash" => $block->getContractIdHash(),
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
        $em = $this->container->get("doctrine")->getManager();
        $rep = $em->getRepository("NiwoBundle\Entity\WoodlandRights");


        $data = [];
        $woodlands = $rep->findByOwnerId($id);

        if (!$woodlands) {

            return json_decode(json_encode([
                "error" => false,
                "message" => "",
                "data" => []
            ]));
        }

        foreach ($woodlands as $w) {
            array_push($data, [
                "country_name" => $w->getCountryName(),
                "comm_name" => $w->getCommName(),
                "comm_pp_name" => $w->getCommPpName(),
                "owner_name" => $w->getOwnerName(),
                "east" => $w->getEast(),
                "north" => $w->getNorth(),
                "west" => $w->getWest(),
                "south" => $w->getSouth(),
                "woodland_id" => $w->getWoodlandId(),
                "map_author" => $w->getMapAuthor(),
                "land_name" => $w->getLandName(),
                "tree_type" => $w->getTreeType(),
                "valid" => $w->getValid(),
                "authorized_date" => $w->getAuthorizedDate(),
                "processor" => $w->getProcessor()
            ]);
        };

        return json_decode(json_encode([
            "error" => false,
            "message" => "",
            "data" => $data
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
        $em = $this->container->get("doctrine")->getManager();
        $rep = $em->getRepository("NiwoBundle\Entity\HousingPropertyRights");

        $houses = $rep->findByOwnerId($id);

        if (!$houses) {
            return json_decode(json_encode([
                "error" => false,
                "message" => "无房屋产权信息",
                "data" => []
            ]));
        }


        $data = [];

        foreach ($houses as $h) {
            array_push($data, [
                "address" => $h->getAddress(),
                "comm_name" => $h->getCommName(),
                "comm_pp_name" => $h->getCommPpName(),
                "east" => $h->getEast(),
                "north" => $h->getNorth(),
                "west" => $h->getWest(),
                "south" => $h->getSouth(),
                "construction_area" => $h->getConstructionArea(),
                "house_are" => number_format($h->getHouseArea(), 4),
                "owner_name" => $h->getOwnerName(),
                "house_style" => $h->getHouseStyle(),
                "authorized_date" => $h->getAuthorizedDate(),
                "authorized_dept" => $h->getAuthorizedDept()
            ]);
        }

        return json_decode(json_encode([
            "error" => false,
            "message" => "",
            "data" => $data
        ]));
    }
}