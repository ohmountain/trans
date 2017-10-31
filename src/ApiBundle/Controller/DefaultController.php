<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as BaseResponse;

use ApiBundle\Service\Response;
use NiwoBundle\Entity\LandBlock;
use NiwoBundle\Entity\LandRights;
use NiwoBundle\Entity\Integrity;
use NiwoBundle\Entity\HousingPropertyRights;
use NiwoBundle\Entity\WoodlandRights;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {

        $data = $request->get("data");

        $data = json_decode($data, true);

        // 创建土地确权信息
        if (is_array($data) && isset($data["comm_name"])) {
            $right = new LandRights();

            $right->setCommName($data["comm_name"]);
            $right->setCommPpName($data["comm_pp_name"]);
            $right->setOwnerId($data["owner_id"]);
            $right->setOwnerName($data["owner_name"]);
            $right->setOwnerGender($data["owner_gender"]);
            $right->setOwnerContact($data["owner_contact"]);
            $right->setOwnerSid($data["owner_sid"]);
            $right->setFamilyName($data["family_name"]);
            $right->setFamilyGender($data["family_gender"]);
            $right->setFamilySid($data["family_sid"]);
            $right->setRelationship($data["relationship"]);

            $em = $this->get("doctrine")->getManager();
            $em->persist($right);

            foreach ($data["block"] as $b) {
                $block = new LandBlock();

                $block->setBlockName($b["block_name"]);
                $block->setBlockArea($b["block_area"]);
                $block->setBlockType($b["block_type"]);
                $block->setBlockNo($b["block_no"]);
                $block->setBlockCoordinate($b["block_coordinate"]);
                $block->setBlockShape($b["block_shape"]);
                $block->setUsageStatus($b["usage_status"]);

                $contrct_id_hash = $this->get("niwo.zhimi")->sendCert("", "did:gyi:AV7hqKtn4tY3bghzVcBsRnRSaVSCwjnRAG", hash("sha256", json_encode($b)), ["土地权证信信息上链"], json_encode($b));

                $block->setContractIdHash($contrct_id_hash);
                $block->setOwner($right);

                $em->persist($block);
            }

            $em->flush();
        }

        $data = [];

        return Response::Json(Response::SUCCESS, "Welcom", true, $data);
    }


    // 创建房屋产权信息
    public function createHousingAction(Request $request)
    {
        $data = $request->get("data");
        $data = json_decode($data, true);

        if (is_array($data) && array_key_exists('property_number', $data)) {
            $rights = new HousingPropertyRights();

            $rights->setPropertyNumber($data['property_number']);
            $rights->setOwnerName($data['owner_name']);
            $rights->setOwnerId($data['owner_id']);
            $rights->setOwnerIdHash(hash('sha256', hash('sha256', '1'.$data['owner_id'])));
            $rights->setAddress($data['address']);
            $rights->setCommName($data['comm_name']);
            $rights->setCommPpName($data['comm_pp_name']);
            $rights->setEast($data['east']);
            $rights->setSouth($data['south']);
            $rights->setWest($data['west']);
            $rights->setNorth($data['north']);
            $rights->setConstructionArea($data['construction_area']);
            $rights->setHouseArea($data['house_area']);
            $rights->setHouseStyle($data['house_style']);
            $rights->setAuthorizedDept($data['authorized_dept']);
            $rights->setAuthorizedDate($data['authorized_date']);

            $cert_hash = $this->get("niwo.zhimi")->sendCert(
                "",
                "did:gyi:AV7hqKtn4tY3bghzVcBsRnRSaVSCwjnRAG",
                hash("sha256", json_encode($data)),
                ["房屋产权上链"],
                json_encode($data)
            );

            $rights->setCertHash($cert_hash);

            $err = null;

            try {
                $em = $this->get("doctrine")->getManager();
                $em->persist($rights);
                $em->flush();
            } catch(\Exception $e) {
                $err = $e->getMessage();
            }

        }

        $data = [];
        return Response::Json(Response::SUCCESS, "Welcom", true, ['data' => $rights ?? null, 'message' => $err ?? null]);
    }

    public function createWoodlandAction(Request $request)
    {
        $data = $request->get("data");
        $data = json_decode($data, true);

        if (is_array($data) && array_key_exists('country_name', $data)) {
            $rights = new WoodlandRights();
            $rights->setOwnerId($data['owner_id']);
            $rights->SetOwnerIdHash(hash('sha256', hash('sha256', $data['owner_id'])));
            $rights->setOwnerName($data['owner_name']);
            $rights->setCountryName($data['country_name']);
            $rights->setCommName($data['comm_name']);
            $rights->setCommPpName($data['comm_pp_name']);
            $rights->setEast($data['east']);
            $rights->setWest($data['west']);
            $rights->setSouth($data['south']);
            $rights->setNorth($data['north']);
            $rights->setWoodlandId($data['woodland_id']);
            $rights->setArea($data['area']);
            $rights->setMapAuthor($data['map_author']);
            $rights->setLandName($data['land_name']);
            $rights->setTreeType($data['tree_type']);
            $rights->setValid($data['valid']);
            $rights->setAuthorizedDate($data['authorized_date']);
            $rights->setProcessor($data['processor']);

            $cert_hash = $this->get("niwo.zhimi")->sendCert(
                "",
                "did:gyi:AV7hqKtn4tY3bghzVcBsRnRSaVSCwjnRAG",
                hash("sha256", json_encode($data)),
                ["林地确权上链"],
                json_encode($data)
            );

            $rights->setCertHash($cert_hash);

            $err = null;

            try {
                $em = $this->get("doctrine")->getManager();
                $em->persist($rights);
                $em->flush();
            } catch(\Exception $e) {
                $err = $e->getMessage();
            }

        }

        $data = [];
        return Response::Json(Response::SUCCESS, "Welcom", true, ['data' => isset($rights) ? $rights->getId() : null,  'message' => $err ?? null]);
    }


    public function createIntegrityAction(Request $request)
    {
        return $this->render("integrity.twig");
    }

    public function createAction(Request $request)
    {
        $name = $request->get("name");
        $category = $request->get("category");
        $place = $request->get("place");
        $content = $request->get("content");

        $response = new BaseResponse();

        if ($name == null || $category == null || $place == null || $content == null) {
            $response->setContent(json_encode([
                "ok" => false,
                "reason" => 0,
            ]));

            return $response;
        }

        if (!in_array($name, ["张以华", "杨秀才", "凡祥华"])) {
            $response->setContent(json_encode([
                "ok" => false,
                "reason" => 2,
            ]));

            return $response;
        }

        $sid = "";
        $contact = "";

        switch ($name) {
        case "杨秀才":
            $sid = "522502196211282652";
            break;

        case "张以华":
            $sid = "52250219761016261X";
            break;

        default:
            $sid = "522502196501132652";
        }

        $timestamp = range(1199116800, time() - 3600 * 365, 3600);
        $time = $timestamp[array_rand($timestamp)];

        $time = date("Ymdhis", $time);


        $ccc = [
            "owner_id" => $sid,
            "category" => $category,
            "timestamp" => $time,
            "name" => $name,
            "place" => $place,
            "content" => $content,
        ];

        $cert = $this->get("niwo.zhimi")->sendCert("", "did:gyi:AV7hqKtn4tY3bghzVcBsRnRSaVSCwjnRAG", hash("sha256", json_encode($ccc)), ["土地权证信信息上链"], json_encode($ccc));

        $integrity = new Integrity();

        $integrity->setOwnerId($sid);
        $integrity->setCategory($category);
        $integrity->setName($name);
        $integrity->setPlace($place);
        $integrity->setContent($content);
        $integrity->setTimestamp($time);
        $integrity->setCert($cert);

        $em = $this->get("doctrine")->getManager();

        $em->persist($integrity);
        $em->flush();

        if ($integrity->getId()) {
            $response->setContent(json_encode([
                "ok" => true
            ]));

            return $response;
        }


        $response->setContent(json_encode([
            "ok" => true
        ]));

        return $response;
    }
}
