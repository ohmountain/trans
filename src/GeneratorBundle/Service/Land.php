<?php

namespace GeneratorBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use NiwoBundle\Entity\LandRights;
use NiwoBundle\Entity\LandBlock;

class Land
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    // public function generate_land()
    // {
    //     $peoples = [
    //         [
    //             "comm_name" => "凤山村",
    //             "comm_pp_name" => "2组",
    //             "name" => "姜鑫鑫",
    //             "sid"  => "320601198812280336",
    //             "gender" => "男",
    //             "contact" => "15950596914",
    //             "family_name" => "姜某某",
    //             "family_gender" => "男",
    //             "family_sid" => "320601201812280336",
    //             "relationship" => "朋友"
    //         ],[
    //             "comm_name" => "凤山村",
    //             "comm_pp_name" => "3组",
    //             "name" => "杨文丽",
    //             "gender" => "女",
    //             "sid"  => "522631199410263121",
    //             "contact" => "15616322910",
    //             "family_name" => "杨某某",
    //             "family_gender" => "女",
    //             "family_sid" => "522631201812280336",
    //             "relationship" => "朋友"
    //         ],[
    //             "comm_name" => "凤山村",
    //             "comm_pp_name" => "4组",
    //             "name" => "赵甜甜",
    //             "gender" => "女",
    //             "sid"  => "522101198608297626",
    //             "contact" => "18685014939",
    //             "family_name" => "赵某某",
    //             "family_gender" => "女",
    //             "family_sid" => "522101201812280336",
    //             "relationship" => "朋友"
    //         ]
    //     ];

    //     $em = $this->container->get("doctrine")->getManager();

    //     foreach ($peoples as $p) {
    //         $entity = new LandRights();

    //         $entity->setCommName($p["comm_name"]);
    //         $entity->setCommPpName($p["comm_pp_name"]);
    //         $entity->setOwnerId(rand(1000, 9999));
    //         $entity->setOwnerName($p["name"]);
    //         $entity->setOwnerSid($p["sid"]);
    //         $entity->setOwnerGender($p["gender"]);
    //         $entity->setOwnerContact($p["contact"]);
    //         $entity->setFamilyName($p["family_name"]);
    //         $entity->setFamilyGender($p["family_gender"]);
    //         $entity->setFamilySid($p["family_sid"]);
    //         $entity->setRelationship($p["relationship"]);

    //         $em->persist($entity);
    //     }

    //     $em->flush();
    // }


    public function generate_block()
    {
        $blocks = [];

        $em     = $this->container->get("doctrine")->getManager();
        $owners = $em->getRepository("NiwoBundle\Entity\LandRights")->findAll();

        for($i = 0; $i < 15; $i ++) {
            $block = new LandBlock();

            $j = $i + 1;

            $block->setBlockName("地块$j");
            $block->setBlockArea(round(rand(1, 10) / rand(1, 10), 2));
            $block->setBlockType(["田", "地"][array_rand([1,2])]);
            $block->setBlockNo(1000 + $i);
            $block->setBlockShape("方形");
            $block->setBlockCoordinate("X24534342.120,Y34343434.309");
            $block->setUsageStatus(2);
            $block->setContractIdHash(hash("sha256", uniqid()));
            $block->setOwner($owners[array_rand($owners)]);

            $em->persist($block);
        }

        $em->flush();
    }
}