<?php

namespace NiwoBundle\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Curl\Curl;
use NiwoBundle\Entity\Person;
use NiwoBundle\Entity\Rental;

class Zhimi
{
    private $em;
    private $container;

    public function __construct(EntityManager $em, ContainerInterface $container)
    {
        $this->em = $em;
        $this->container = $container;
    }

    public function handleRequestData(array $request_data): JsonResponse
    {
        $response = new JsonResponse();


        /**
         * 缺少操作类型参数
         * ret_code 40300
         */
        if (!array_key_exists("op_type", $request_data)) {
            $response->setContent(json_encode([
                "ret_code" => 40300,
                "reason_string" => "缺少操作类型参数",
            ]));

            return $response;
        }

        /**
         * 没有对应的操作类型
         * ret_code 40400
         */
        if (!in_array($request_data["op_type"], [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15])) {
            $response->setContent(json_encode([
                "ret_code" => 40400,
                "reason_string" => "没有对应的操作类型,操作类型为[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]"
            ]));

            return $response;
        }

        $op_type = $request_data["op_type"];



        /**
         * 缺少参数
         * ret_code 40500
         */
        if (!array_key_exists("parameter", $request_data)) {
            $response->setContent(json_encode([
                "ret_code" => 40500,
                "reason_string" => "缺少参数",
            ]));

            return $response;
        }

        /**
         * 参数格式错误
         * ret_code 40600
         */
        if (!is_array($request_data["parameter"])) {
            $response->setContent(json_encode([
                "ret_code" => 5,
                "reason_string" => "参数格式错误",
            ]));

            return $response;
        }

        $parameter = $request_data["parameter"];

        if (!array_key_exists("id", $parameter)) {
            $response->setContent(json_encode([
                "ret_code" => 1,
                "reason_string" => "id 异常",
            ]));

            return $response;
        }

        if (!array_key_exists("id_type", $parameter) || !$this->checkIdType($parameter["id_type"])) {
            $response->setContent(json_encode([
                "ret_code" => 2,
                "reason_string" => "id_type 异常",
            ]));

            return $response;
        }

        /**
         * 参数不全
         * ret_code 40700
         */
        if (!array_key_exists("id_type", $parameter) ||
            !array_key_exists("id", $parameter)
        ) {
            $response->setContent(json_encode([
                "ret_code" => 40700,                "reason_string" => "参数不全,需要id_type、id、sig(可选)",            ]));

            return $response;
        }

        $id= $parameter["id"] ?? null;
        $id_type = $parameter["id_type"] ?? null;
        $sig     = $parameter["sig"] ?? null;

        /**
         * 参数不能为空
         * ret_code 40800
         */
        if (empty($id) || empty($id_type)) {
            $response->setContent(json_encode([
                "ret_code" => 40800,                "reason_string" => "参数不能为空",            ]));

            return $response;
        }

        /**
         * 注册
         */
        if ($op_type == 1) {
            return $this->register($parameter);
        }

        /**
         * 获取诚信信息
         */
        if ($op_type == 2) {
            return $this->chengxin($parameter);
        }

        /**
         * 获取农村三变土地确权证信息
         */
        if ($op_type == 3) {
            return $this->landRights($parameter);
        }

        /**
         * 获取农村三变林权证信息
         */
        if ($op_type == 4) {
            return $this->woodlandRights($parameter);
        }

        /**
         * 获取农村房屋产权信息
         */
        if ($op_type == 5) {
            return $this->housingPropertyRights($parameter);
        }

        if ($op_type == 6) {
            return $this->eligibility($parameter);
        }

        if ($op_type == 7) {
            return $this->rentalInfomation($parameter);
        }

        if ($op_type == 8) {
            return $this->changeRentalInfomation($parameter);
        }

        if ($op_type == 9) {
            return $this->rentalBlocksInfomation($parameter);
        }

        if ($op_type == 11) {
            return $this->createRental($parameter);
        }

        if ($op_type == 12) {
            return $this->equityProportion($parameter);
        }

        if ($op_type == 13) {
            return $this->getPartyB();
        }

        if ($op_type == 14) {
            return $this->getCreditScore($parameter);
        }

        if ($op_type == 15) {
            return $this->getDiscounts($parameter);
        }
    }

    /**
     * 检测证件类型是否符合规定
     *
     * 证件类型的含义具体可看API文档
     */
    private function checkIdType(string $id_type): bool
    {
        $allowed = ["10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "1a", "1b", "1c", "1d", "1e", "1f", "1g", "1X", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "a2", "2b", "2c", "2d", "2e", "2X"];

        return in_array($id_type, $allowed);
    }

    /**
     * 处理注册请求
     *
     * @param array $parameter
     *
     * @return JsonResponse
     */
    private function register(array $parameter): JsonResponse
    {

        $response = new JsonResponse();

        /**
         * TODO
         * 1. 执行正常的注册逻辑
         * 2. 可能注册失败
         * 3. 可能已被注册
         */

        $id = $parameter['id'];
        $id = hash("sha256", hash("sha256", "1".$id));

        $curl = new Curl();
        $curl->setOpt(CURLOPT_TIMEOUT, $this->container->getParameter('niwo')['chain']['timeout']);
        $url  = $this->container->getParameter('niwo')['chain']['register_api'];
        $url  = "{$url}/{$id}";

        $result = $curl->get($url);

        /**
         * 网络请求错误
         * ret_code 0
         */
        if ($result->error || $result->http_error) {

            $response->setContent(json_encode([
                "ret_code" => 500,
                "value" => null,
                "reason_string" => "注册请求网络错误",
            ]));

            return $response;
        }

        $data= json_decode($result->response, true);

        if ($data["Error"] !== 0 || $data["Result"] == null) {

            $url  = $this->container->getParameter('niwo')['chain']['status_api'];
            $url  = "{$url}/{$id}";

            $curl = new Curl();
            $curl->setOpt(CURLOPT_TIMEOUT, $this->container->getParameter('niwo')['chain']['timeout']);

            $result = $curl->get($url);

            $data= json_decode($result->response, true);

            if ($result->error || $data["Error"] !== 0 || $data["Result"] == null) {

                $response->setContent(json_encode([
                    "ret_code" => 4,
                    "value" => null,
                    "reason_string" => "证件号已注册"
                ]));

                return $response;
            }

            $bc_id = $data["Result"]["did"];
            $state = $data["Result"]["state"];

            $response->setContent(json_encode([
                "ret_code" => 4,
                "value" => [
                    "bc_id" => $bc_id,
                    "state" => $state
                ],
                "reason_string" => "证件号已注册"
            ]));

            return $response;
        }

        $bc_id = $data["Result"]["did"];
        $state = $data["Result"]["state"];

        $person = new Person();
        $person->setBcId($bc_id);
        $person->setHash($id);

        /**
         * 保存进数据库
         */
        $em = $this->container->get('doctrine')->getManager();
        $em->persist($person);
        $em->flush();

        /*
         * 假设注册成功
         * ret_code 0
         */
        $response->setContent(json_encode([
            "ret_code" => 0,
            "value" => [
                "bc_id" => $data["Result"]["did"],
                "state" => $data["Result"]["state"]
            ],
            "reason_string" => "注册完成"
        ]));

        return $response;
    }

    /**
     * 状态查询
     */
    private function registerStatus(string $id): JsonResponse
    {
        $response = new JsonResponse();

        $id   = $parameter['id'];
        $hash = hash("sha256", hash("sha256", $id));

        $curl = new Curl();
        $curl->setOpt(CURLOPT_TIMEOUT, $this->container->getParameter('niwo')['chain']['timeout']);
        $url  = $this->container->getParameter('niwo')['chain']['status_api'];
        $url  = "{$url}/{$hash}";

        $result = $curl->get($url);

        /**
         * 网络请求错误
         * ret_code 0
         */
        if ($result->error || $result->http_error) {

            $response->setContent(json_encode([
                "ret_code" => 500,
                "value" => null,
                "reason_string" => "注册请求网络错误"
            ]));

            return $response;
        }

        $data= json_decode($result->response, true);

        if ($data["Error"] !== 0 || $data["Result"] == null) {
            $response->setContent(json_encode([
                "ret_code" => 400,
                "value" => null,
                "reason_string" => "查询失败"
            ]));

            return $response;
        }

        /**
         * 假设查询成功
         * ret_code 0
         */
        $response->setContent(json_encode([
            "ret_code" => 0,
            "value" => [
                "bc_id" => $data["Result"]["did"],
                "state" => $data["Result"]["state"]
            ],
            "reason_string" => "查询完成"
        ]));

        return $response;
    }

    /**
     * 处理获取诚信信息请求
     *
     * @param array $parameter
     *
     * @return JsonResponse
     */
    private function chengxin(array $parameter)
    {
        $id_type = $parameter["id_type"];
        $id      = $parameter["id"];
        $sig     = $parameter["sig"] ?? "";

        $hash = hash("sha256", hash("sha256", "1{$id}"));

        $response = new JsonResponse();

        /**
         * DONE
         * 1. 执行正常的获取逻辑
         * 2. 可能获取失败
         */

        /**
         * 假设获取成功
         * ret_code 0
         */
        // $response->setContent(json_encode([
        //     "ret_code" => 0,
        //     "value" => [
        //         "hash" => md5(uniqid()),
        //         "history" => [
        //             [
        //                 "category" => "金融信用",
        //                 "history"  => [
        //                     [
        //                         "timestamp" => "20170101101326",
        //                         "name" => "张三",
        //                         "place" => "贵阳市花溪区",
        //                         "content" => "xxxxxxxxxxxxx",
        //                         "cert" => hash("sha256", uniqid())
        //                     ],
        //                     [
        //                         "timestamp" => "20170101101326",
        //                         "name" => "张三",
        //                         "place" => "贵阳市白云区",
        //                         "content" => "xxxxxxxxxxxxx",
        //                         "cert" => hash("sha256", uniqid())
        //                     ],
        //                     [
        //                         "timestamp" => "20170101101326",
        //                         "name" => "张三",
        //                         "place" => "贵阳市清镇",
        //                         "content" => "xxxxxxxxxxxxx",
        //                         "cert" => hash("sha256", uniqid())
        //                     ]
        //                 ]
        //             ],
        //             [
        //                 "category" => "公共服务",
        //                 "history"  => [
        //                     [
        //                         "timestamp" => "20170101101326",
        //                         "name" => "张三",
        //                         "place" => "贵阳市花溪区",
        //                         "content" => "xxxxxxxxxxxxx",
        //                         "cert" => hash("sha256", uniqid())
        //                     ],
        //                     [
        //                         "timestamp" => "20170101101326",
        //                         "name" => "张三",
        //                         "place" => "贵阳市白云区",
        //                         "content" => "xxxxxxxxxxxxx",
        //                         "cert" => hash("sha256", uniqid())
        //                     ],
        //                     [
        //                         "timestamp" => "20170101101326",
        //                         "name" => "张三",
        //                         "place" => "贵阳市清镇",
        //                         "content" => "xxxxxxxxxxxxx",
        //                         "cert" => hash("sha256", uniqid())
        //                     ]
        //                 ]
        //             ],
        //             [
        //                 "category" => "公共信用",
        //                 "history"  => [
        //                     [
        //                         "timestamp" => "20170101101326",
        //                         "name" => "张三",
        //                         "place" => "贵阳市花溪区",
        //                         "content" => "xxxxxxxxxxxxx",
        //                         "cert" => hash("sha256", uniqid())
        //                     ],
        //                     [
        //                         "timestamp" => "20170101101326",
        //                         "name" => "张三",
        //                         "place" => "贵阳市白云区",
        //                         "content" => "xxxxxxxxxxxxx",
        //                         "cert" => hash("sha256", uniqid())
        //                     ],
        //                     [
        //                         "timestamp" => "20170101101326",
        //                         "name" => "张三",
        //                         "place" => "贵阳市清镇",
        //                         "content" => "xxxxxxxxxxxxx",
        //                         "cert" => hash("sha256", uniqid())
        //                     ]
        //                 ]
        //             ],
        //             [
        //                 "category" => "司法信用",
        //                 "history"  => [
        //                     [
        //                         "timestamp" => "20170101101326",
        //                         "name" => "张三",
        //                         "place" => "贵阳市花溪区",
        //                         "content" => "xxxxxxxxxxxxx",
        //                         "cert" => hash("sha256", uniqid())
        //                     ],
        //                     [
        //                         "timestamp" => "20170101101326",
        //                         "name" => "张三",
        //                         "place" => "贵阳市白云区",
        //                         "content" => "xxxxxxxxxxxxx",
        //                         "cert" => hash("sha256", uniqid())
        //                     ],
        //                     [
        //                         "timestamp" => "20170101101326",
        //                         "name" => "张三",
        //                         "place" => "贵阳市清镇",
        //                         "content" => "xxxxxxxxxxxxx",
        //                         "cert" => hash("sha256", uniqid())
        //                     ]
        //                 ]
        //             ],
        //             [
        //                 "category" => "其他",
        //                 "history"  => [
        //                     [
        //                         "timestamp" => "20170101101326",
        //                         "name" => "张三",
        //                         "place" => "贵阳市花溪区",
        //                         "content" => "xxxxxxxxxxxxx",
        //                         "cert" => hash("sha256", uniqid())
        //                     ],
        //                     [
        //                         "timestamp" => "20170101101326",
        //                         "name" => "张三",
        //                         "place" => "贵阳市白云区",
        //                         "content" => "xxxxxxxxxxxxx",
        //                         "cert" => hash("sha256", uniqid())
        //                     ],
        //                     [
        //                         "timestamp" => "20170101101326",
        //                         "name" => "张三",
        //                         "place" => "贵阳市清镇",
        //                         "content" => "xxxxxxxxxxxxx",
        //                         "cert" => hash("sha256", uniqid())
        //                     ]
        //                 ]
        //             ],
        //         ]
        //     ]
        // ]));

        $integrities = $this->container->get("doctrine")->getManager()->getRepository("NiwoBundle\Entity\Integrity")->findByOwnerId($id);

        $intes = [
            "公共服务" => [],
            "金融信用" => [],
            "司法信用" => [],
            "公共信用" => [],
            "其他"     => []
        ];

        foreach ($integrities as $inte) {
            if (!array_key_exists($inte->getCategory(), $intes)) {
                $intes[$inte->getCategory()] = [];
            }

            $intes[$inte->getCategory()][] = [
                "timestamp" => $inte->getTimestamp(),
                "name" => $inte->getName(),
                "place" => $inte->getPlace(),
                "content" => $inte->getContent(),
                "cert" => $inte->getCert()
            ];
        }

        $final_data = [];

        foreach ($intes as $k => $inte) {
            $tmp = [];

            $tmp["category"] = $k;
            $tmp["history"]  = [];

            foreach ($inte as $i) {
                $tmp["history"][] = $i;
            }

            array_push($final_data, $tmp);
        }


        $response->setContent(json_encode([
            "ret_code" => 0,
            "value" => [
                "hash" => hash("sha256", hash("sha256", "1{$id}")),
                "history" => $final_data
            ]
        ]));

        $this->sendCert("", $this->getDid($hash), $hash, ["金融信用","公共服务","公共信用", "司法信用", "其他"], "获取信用信息", $sig);
        return $response;
    }


    /**
     * 三变土地确权
     *
     * @param array $parameter
     *
     * @return JsonResponse
     */
    private function landRights(array $parameter): JsonResponse
    {
        $response = new JsonResponse();

        /**
         * TODO
         * 1. 执行正常的获取逻辑
         * 2. 可能获取失败
         */

        $id_type = $parameter["id_type"];
        $id      = $parameter["id"];
        $sig     = $parameter["sig"] ?? "";

        $hash = hash("sha256", hash("sha256", "1{$id}"));

        $sanbian = $this->container->get("niwo.sanbian");

        /* 从三变平台获取信息 */
        $result = $sanbian->land($id);

        if ($result->error) {
            $data = [
                "ret_data" => 500,
                "value" => [
                    "hash" => $hash,
                    "ownership" => null
                ],
                "reason_string" => $result->message
            ];

            $response->setContent(json_encode($data));

            return $response;
        }

        $trans_data = $result->data;

        $owner_id = "";

        $ownership = [
            "comm_name" => $trans_data->comm_name ?? "",
            "comm_pp_name" => $trans_data->comm_pp_name ?? "",
            "owner_name" => $trans_data->owner_name ?? "",
            "owner_id" => $trans_data->owner_id ?? "",
            "owner_gender" => $trans_data->owner_gender ?? "",
            "owner_contact" => "",  // 暂无
            "owner_sid" => $trans_data->owner_sid ?? "",
            "family_name" => $trans_data->family_name ?? "",
            "family_gender" => $trans_data->family_gender ?? "",
            "family_sid" => $trans_data->family_sid ?? "",
            "relationship" => $trans_data->relationship ?? "",
            "block" => $trans_data->block ?? []
        ];

        $rentals = $this->container->get("doctrine")->getManager()->getRepository("NiwoBundle\Entity\Rental")->findAll();

        $data = [
            'ret_code' => 0,
            'value' => [
                "hash" => $hash,
                "ownership" => $ownership,
            ],
            'reason_string' => '获取成功'
        ];

        $response->setContent(json_encode($data));

        $this->sendCert("", $this->getDid($hash), $hash, ["landrights"], "获取土地确权信息", $sig);

        return $response;
    }

    /**
     * 三变林权信息
     *
     * @param array $parameter
     *
     * @return JsonResponse
     */
    private function woodlandRights(array $parameter): JsonResponse
    {
        $response = new JsonResponse();

        /**
         * TODO
         * 1. 执行正常的获取逻辑
         * 2. 可能获取失败
         */

        $id_type = $parameter["id_type"];
        $id      = $parameter["id"];
        $sig     = $parameter["sig"] ?? "";
        $hash    = hash("sha256", hash("sha256", "1".$id));

        $rep = $this->em->getRepository("NiwoBundle\Entity\WoodlandRights");

        $rights = $rep->findByOwnerId($id);

        $data = [];

        $result = $this->container->get("niwo.sanbian")->woodland($id);

        if ($result->error) {
            $data = [
                "ret_data" => 500,
                "value" => [
                    "hash" => $hash,
                    "ownership" => null
                ],
                "reason_string" => $result->message
            ];

            $response->setContent(json_encode($data));

            return $response;
        }

        $response->setContent(json_encode([
            'code' => 0,
            'value' => [
                'hash' => hash("sha256", hash("sha256", $id)),
                "ownership" => $result->data
            ]
        ]));

        $this->sendCert("", $this->getDid($hash), $hash, ["woodlandrights"], "获取林权信息", $sig);
        return $response;
    }

    /**
     * 三变房屋产权
     *
     * @param array $parameter
     *
     * @return JsonResponse
     */
    private function housingPropertyRights(array $parameter): JsonResponse
    {

        $response = new JsonResponse();

        /**
         * TODO
         * 1. 执行正常的获取逻辑
         * 2. 可能获取失败
         */

        $id_type = $parameter["id_type"];
        $id      = $parameter["id"];
        $sig     = $parameter["sig"] ?? "";
        $hash    = hash("sha256", hash("sha256", "1".$id));

        $res = $this->container->get("niwo.sanbian")->housing($id);

        if ($res->error) {
            $response->setContent(json_encode([
                "ret_code" => 500,
                "value" => null,
                "reason_string" => $res->message
            ]));

            return $response;
        }


        // // 虚假数据，用于开发
        // $data = [[
        //     "address" => "贵阳市-花溪区-石板镇",
        //     "comm_name" => "xxx村民委员会",
        //     "comm_pp_name" => "xx组",
        //     "east" => "防火墙",
        //     "south" => "池塘",
        //     "west" => "农田",
        //     "north" => "公路",
        //     "construction_area" => "123.23",
        //     "house_area" => "234.02",
        //     "owner_name" => "张三",
        //     "house_style" => "砖瓦",
        //     "authorized_date" => "20031020",
        //     "authorized_dept" => "贵阳市房产局"
        // ]];

        $response->setContent(json_encode([
            'ret_code' => 0,
            'value' => [
                'hash' => hash('sha256', hash('sha256', '1')),
                'ownership' => $res->data
            ],
            'reason_string' => '获取成功'
        ]));

        // $rep = $this->em->getRepository("NiwoBundle\Entity\HousingPropertyRights");

        // $rights = $rep->findByOwnerId($id);

        // if ($rights === null) {
        //     $response->setContent(json_encode([
        //         "ret_value" => 1,
        //         "value" => null,
        //         "reason_string" => "无数据"
        //     ]));

        //     return $response;
        // }


        // $value = [];

        // foreach ($rights as $right) {
        //     $r = [
        //         "address" => $rights->getAddress(),
        //         "comm_name" => $rights->getCommName(),
        //         "comm_pp_name" => $rights->getCommPpName(),
        //         "east" => $rights->getEast(),
        //         "south" => $rights->getSouth(),
        //         "east" => $rights->getEast(),
        //         "west" => $rights->getWest(),
        //         "construct_area" => $rights->getConstructionArea(),
        //         "house_area" => $rights->getHouseArea(),
        //         "house_style" => $rights->getHouseStyle(),
        //         "owner_name" => $rights->getOwnerName(),
        //         "authorized_date" => $rights->getAuthorizedDate(),
        //         "authorized_dept" => $rights->getAuthorizedDept()
        //     ];

        //     array_push($value, $r);
        // }

        // /**
        //  * 假设获取成功
        //  */
        // $response->setContent(json_encode([
        //     "ret_value" => 0,
        //     "value" => [
        //         "hash" => $rights->getOwnerIdHash(),
        //         "ownership" => $value
        //     ],
        //     "ret_string" => "获取成功"
        // ]));

        $this->sendCert("", $this->getDid($hash), $hash, ["woodlandrights"], "获取房屋产权信息", $sig);

        return $response;
    }


    /**
     * 处理获取产权信息请求
     *
     * @param array $parameter
     *
     * @return JsonResponse
     */
    private function chanquan(array $parameter)
    {

        $response = new JsonResponse();

        /**
         * TODO
         * 1. 执行正常的获取逻辑
         * 2. 可能获取失败
         */

        /**
         * 假设获取成功
         * ret_code 20200
         */
        $response->setContent(json_encode([
            "ret_code" => 0,
            "value" => [
                "type" => 2,
                "hash" => md5(uniqid()),
                "ownership" => [[
                    "address" => "地址",
                    "comm_name" => "村委名称",
                    "comm_pp_name" => "村民组名称",
                    "house_area" => "房屋占地面积",
                    "construction_area" => "房屋建筑面积",
                    "owner_name" => "户主姓名",
                    "house_style" => "房屋结构",
                    "house_line" => "房屋四至线",
                    "authorized_date" => "发证日期",
                    "authorized_dept" => "发证机关"
                ]]
            ]
        ]));

        return $response;
    }

    /**
     * 社会救助
     */
    public function eligibility(array $parameter): JsonResponse
    {
        $id_type = $parameter["id_type"];
        $id      = $parameter["id"];
        $sig     = $parameter["sig"] ?? "";
        $hash    = hash("sha256", hash("sha256", "1".$id));

        $response = new JsonResponse();

        $assistance = $this->container->get("doctrine")->getManager()->getRepository("NiwoBundle\Entity\Assistance")->findBySid($id);

        if ($assistance == null || $assistance->getEligibility() == false) {
            return $response->setContent(json_encode([
                "ret_code" => 0,
                "value" => [
                    "hash" => "",
                    "cert" => "",
                    "eligibility" => false
                ]
            ]));
        }

        $response->setContent(json_encode([
            "ret_code" => 0,
            "value" => [
                "hash" => $assistance->getCert(),
                "cert" => $assistance->getCert(),
                "eligibility" => true
            ]
        ]));

        $this->sendCert("", $this->getDid($hash), $hash, ["eligibility"], "获取社会救助信息", $sig);

        return $response;
    }

    /**
     * 获取租赁信息
     */
    private function rentalInfomation(array $parameter): JsonResponse
    {
        $id_type = $parameter["id_type"];
        $id      = $parameter["id"];
        $sig     = $parameter["sig"] ?? "";
        $id_hash = $parameter["id_hash"] ?? "";
        $hash    = hash("sha256", hash("sha256", "1".$id));
        $response = new JsonResponse();

        $em = $this->container->get("doctrine")->getManager();
        $rep = $em->getRepository("NiwoBundle\Entity\Rental");

        $this->container->get("logger")->debug("获取租赁信息请求参数", ["parameters" => $parameter]);

        $rental = $rep->findByHash($id_hash);

        $contract = [];

        if ($rental) {
            $contract["modification_flag"] = true;
            $contract["party_a"] = $rental->getPartyaName() ?? "";
            $contract["party_a_id"] = $id ?? "";
            $contract["party_a_contact"] = $rental->getPartyaContact() ?? "";
            $contract["party_b"] = $rental->getPartybName() ?? "";
            $contract["party_b_id"] = $rental->getPartybId() ?? "";
            $contract["party_b_contact"] = $rental->getPartybContact() ?? "";
            $contract["expense"] = $rental->getExpense() ?? 0;
            $contract["start_time"] = $rental->getStartTime() ?? "";
            $contract["end_time"] = $rental->getEndTime() ?? "";

            $blocks = $rental->getBlock();

            foreach ($blocks as $k => $v) {
                if ($v == null) {
                    $blocks[$k] = "";
                }
            }

            $rentals = $rep->findAll();

            $total_area = 300;

            foreach ($rentals as $r) {
                $total_area += $r->getBlockArea() ?? 0;
            }

            $blocks["owner_name"] = $rental->getPartyaName();
            $blocks["distribution"] = number_format($rental->getBlockArea() / $total_area, 4);
            $blocks["usage_status"] = 1;
            $contract["block"] = $blocks;

            foreach ($blocks as $k => $v) {
                if ($v == null) {
                    $blocks[$k] = "";
                }
            }

            $blocks["usage_status"] = 1;
            $contract["block"] = [$blocks];
        }

        $ret_data = [
            "ret_code" => 0,
            "value" => [
                "hash" => $id_hash,
                "contract" => $contract,
                "reason_string" => ""
            ]
        ];

        $response->setContent(json_encode($ret_data));

        $this->sendCert("", $this->getDid($hash), $hash, ["woodlandrights"], "获取租赁信息", $sig);
        return $response;
    }

    private function changeRentalInfomation(array $parameter): JsonResponse
    {
        $id_type = $parameter["id_type"];
        $id      = $parameter["id"];
        $sig     = $parameter["sig"] ?? "";
        $hash    = hash("sha256", hash("sha256", "1".$id));
        $contract = $parameter["value"]["contract"];


        // TODO 变更动作

        // 假设变更完成
        $response = new JsonResponse();
        $response->setContent(json_encode([
            "ret_code" => 0,
            "cert" => hash("sha256", uniqid()),
            "value" => [
                "image" => "http://pic.qiantucdn.com/58pic/26/61/81/28658PICEQT_1024.jpg!/fw/780/watermark/url/L3dhdGVybWFyay12MS4zLnBuZw"
            ],
            "reason_string" => "合同更改成功"
        ]));

        $this->sendCert("", $this->getDid($hash), $hash, ["changerentalinfomation"], "变更租赁信息", $sig);

        return $response;
    }

    /**
     * 获取三变租赁区块信息
     */
    private function rentalBlocksInfomation(array $parameter): JsonResponse
    {
        $response = new JsonResponse();

        $id_type = $parameter["id_type"];
        $id      = $parameter["id"];
        $sig     = $parameter["sig"] ?? "";
        $hash    = hash("sha256", hash("sha256", "1".$id));

        $id_hash = $parameter["id_hash"];

        $rental = $this->em->getRepository("NiwoBundle\Entity\Rental")->findByHash($id_hash);

        $images = [];

        $markle_root = "";
        $block_height = 0;
        $content_hash = "";
        $contract_url = "";


        if ($rental != null) {

            $root_dir = $this->container->get("kernel")->getRootDir();
            $web_dir = realpath($root_dir . "/../web");

            foreach ($rental->getImages() as $image) {
                if ($image == "") continue;

                $url = "";

                $image = $web_dir . $image;

                $img_info = getimagesize($image);

                $img_info = getimagesize($image);
                $img_src = "data:{$img_info['mime']};base64," . base64_encode(file_get_contents($image));

                // if (isset($_SERVER['SERVER_ADDR'])) {
                //     $url = ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != null) ? "https://" : "http://") . "{$_SERVER['SERVER_ADDR']}".":{$_SERVER['SERVER_PORT']}".$image;
                // } else {
                //     $url = $image;
                // }




                $url = $img_src;

                array_push($images, [
                    "url" => $url
                ]);
            }

            $content_hash = $rental->getContentHash();
            $rental_hash  = $rental->getHash();
        }



        $images = array_reverse($images);

        $curl = new Curl();
        $block_info_api = $this->container->getParameter("niwo")["chain"]["block_info_api"];
        $res = $curl->get($block_info_api."/".$id_hash);


        if (!$res->error) {
            $result = json_decode($res->response, true);

            $markle_root  = $result["Result"]["merkleroot"] ?? "";
            $block_height = $result["Result"]["height"] ?? 0;
        }


        $data = [

            "ret_code" => 0,

            "value" => [
                "hash" => $id_hash,
                "merkle_root" => $markle_root,
                "block_height" => $block_height,
                "content_hash" => $content_hash,
                "contract_url" => $contract_url,
                "images" => $images
            ],
            "reason_string" => ""
        ];

        $this->sendCert("", $this->getDid($hash), $hash, ["getrentalinblocksfomation"], "获取租赁块信息", $sig);

        return $response->setContent(json_encode($data));
    }

    private function createRental(array $parameter): JsonResponse
    {
        /**
         * DONE
         *
         * 1. 获取操作用户的DID
         * 2. 存证，获得存证hash
         * 3. 转换并保存图片
         * 4. 保存到数据库
         */

        $did = $this->getDid(hash("sha256", hash("sha256", "1".$parameter["id"])));

        $content_hash = hash("sha256", json_encode($parameter["contract"]));

        /// 存证hash
        $hash = $this->sendCert("", $did, hash("sha256", json_encode($parameter["contract"])), ["创建租赁"], "创建租赁信息");

        $response = new JsonResponse();

        $contract = $parameter["contract"];

        $this->container->get("logger")->debug("创建租赁信息", ["contract" => $contract]);

        $rental = new Rental();

        $rental->setPartyaName($contract["party_a"] ?? "");
        $rental->setPartyaId($contract["party_a_id"] ?? "");
        $rental->setPartyaContact($contract["party_a_contact"] ?? "");
        $rental->setPartybName($contract["party_b"] ?? "");
        $rental->setPartybId($contract["party_b_id"] ?? "");
        $rental->setPartybContact($contract["party_b_contact"] ?? "");
        $rental->setHash($hash);
        $rental->setContentHash($content_hash);
        $rental->setStartTime($contract["start_time"]);
        $rental->setEndTime($contract["end_time"]);
        $rental->setBlock($contract["block"]);
        $rental->setBlockNo($contract["block"]["block_no"] ?? "");
        $rental->setExpense($contract["expense"] ?? 0);
        $rental->setBlockArea($contract["block"]["block_area"] ?? 0);

        $images = [];

        foreach ($parameter["images"] as $k => $image) {
            $name = $hash ."_". $k;

            if (strlen($image) > 10) {
                $image = "data:image/png;base64," . $image;
            }

            $images[$k] = $this->saveBase64ToImage($image, $name);
        }

        $rental->setImages($images);

        $em = $this->container->get("doctrine")->getManager();

        $block = $em->getRepository("NiwoBundle\Entity\LandBlock")->findBy([
            "blockNo" => $rental->getBlockNo()
        ]);

        if (count($block) > 0) {
            $block[0]->setUsageStatus(1);
            $block[0]->setContractIdHash($hash);
            $em->persist($block[0]);
        }

        $em->persist($rental);
        $em->flush();

        $response->setContent(json_encode([
            "ret_code" => 0,
            "value" => [ "hash" => $hash, "images" => $images ],
            "reason_string" => ""
        ]));

        return $response;
    }

    /**
     * 查询股权占比
     */
    private function equityProportion(array $parameter): JsonResponse
    {
        // TODO
        // 1. 查出所有合同的面积
        // 2. 加上新合同的面积后计算新合同的股权占比

        $rentals = $this->container->get("doctrine")->getManager()->getRepository("NiwoBundle\Entity\Rental")->findAll();

        /* 已租赁 */
        $static = 300;

        foreach ($rentals as $rental) {
            $static += floatval($rental->getBlockArea());
        }

        $area = $parameter["area"];

        $response = new JsonResponse();
        $response->setContent(json_encode([
            "ret_code" => 0,
            "value" => [
                "current" => $static,
                "after" => $static + $area,
                "percent" => number_format($area / ($static + $area), 4)
            ],
            "reason_string" => "获取成功"
        ]));

        return $response;
    }

    /**
     * 把base64的编码的图片转换并保存为本地图片, 每天变更多次则只保存最后一次的图片
     *
     * @param string $base64
     *
     * @return string      返回图片地址
     */
    private function saveBase64ToImage(string $base64, string $name): string
    {
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64, $result)) {

            $type = $result[2];

            $web_path = "/upload/image/".date('Ymd',time())."/" . $name . ".{$type}";

            $path = realpath($this->container->get("kernel")->getRootDir()."/../web/")."/upload/image/".date('Ymd',time())."/";

            if(!file_exists($path)) {
                try {
                    mkdir($path, 0700, true);
                } catch(\Exception $e) {
                    $this->container->get("logger")->critica("创建目录失败", [
                        "message" => $e->getMessage()
                    ]);
                    return "";
                }
            }

            $file = $path.$name.".{$type}";
            if (file_put_contents($file, base64_decode(str_replace($result[1], '', $base64)))){
                return $web_path;
            }

            return "";
        }

        return "";
    }

    /**
     * 发送存证
     *
     * @param string $ckey        ;;发起者身份标志(客户端无需填写，由服务器填写)
     * @param string $did         ;;必填，用户DID
     * @param string $hash        ;;必填，存证HASH
     * @param string $tags        ;;必填，存证维度
     * @param string $content     ;;存证内容
     * @param string $sig         ;;对存证hash进行签名
     * @param string $seq_no      ;;交易流水号，发起方系统生成，每笔交易需要保证唯一
     */
    public function sendCert(string $ckey = "",
                             string $did,
                             string $hash,
                             array $tags,
                             string $content = "",
                             string $sig = "",
                             string $seq_no = ""): string
    {
        $send_cert_api = $this->container->getParameter("niwo")["chain"]["send_cert_api"];

        $curl = new Curl();
        $curl->setOpt(CURLOPT_TIMEOUT, $this->container->getParameter('niwo')['chain']['timeout']);

        $curl->setHeader("content-type", "application/json");

        $text = [
            "Template" => "1",
            "Did" => $did,
            "CertHash" => "",
            "Tag" => $tags,
            "Content" => $content
        ];

        $data =  [
            "Action" => "sendrecordtransaction",
            "Version" => "1.0.0",
            "RecordData" =>  [
                "CAkey" => "",
                "Data" => [
                    "Algrithem" => "sha256",
                    "Hash" => $hash,
                    "Text" => json_encode($text),
                    "Signature" => $sig
                ],
                "SeqNo" => $seq_no,
                "Timestamp" => time()
            ]
        ];

        try {
            $res = $curl->post($send_cert_api, json_encode($data));
            $hash = json_decode($res->response, true)["Result"];

            if ($hash == null) {
                $this->container->get("logger")->error("发送存证失败", ["api" => $send_cert_api, "http_code" => $res->http_status_code, "message" => $res->error_message, "code" => $res->error_code, "response" => $res->response]);
            }

            return $hash ?? "";
        } catch(\Exception $e) {
            $this->container->get("logger")->critica("存证请求失败", [
                "message" => $e->getMessage()
            ]);
            return "";
        }
    }

    private function getDid(string $hash): string
    {
        $result = $this->container->get("doctrine")->getManager()->getRepository("NiwoBundle\Entity\Person")->findBy(["hash" => $hash]);

        if (count($result) == 0) {
            return "";
        }

        return $result[0]->getBcId();
    }


    /**
     * 获取乙方信息
     */
    private function getPartyB(): JsonResponse
    {
        $response = new JsonResponse();

        $response->setContent(json_encode([
            "ret_code" => 0,
            "value" => [
                "partyb_name" => "清镇市凤山果蔬种植农民专业合作社",
                "partyb_id"   => "93520181596351871L",
                "partyb_contact" => "13511954462"
            ]
        ]));

        return $response;
    }

    public function getCreditScore(array $parameter)
    {
        $id      = $parameter["id"];
        $sig     = $parameter["sig"] ?? "";
        $hash    = hash("sha256", hash("sha256", "1".$id));

        $response = new JsonResponse();

        $timeout = $this->container->getParameter('niwo')['sanbian']['timeout'];
        $api     = $this->container->getParameter('niwo')['sanbian']['credit'];

        $curl = new Curl();
        $curl->setOpt(CURLOPT_TIMEOUT, $timeout);


        try {
            $result = $curl->get("$api?sig=$id");

            if ($result->error || $result->http_error) {
                $response->setContent(json_encode([
                    "ret_code" => 500,
                    "value" => null,
                    "reason_string" => "网络错误",
                ]));

                $this->container->get('logger')->error("获取诚信分失败", ['detail' => $result]);
                return $response;
            }
        } catch(\Exception $e) {
            $this->container->get('logger')->error("获取诚信分失败", ['detail' => $e]);
        }


        $this->sendCert("", $this->getDid($hash), $hash, ["获取诚信分"], "获取诚信分", $sig);

        $data= json_decode($result->response, true);

        if ($data['ret_code'] !== 0) {
            $response->setContent(json_encode([
                'ret_code' => $data['ret_code'],
                'value' => null,
                "reason_string" => $data['reason_string']
            ]));

            return $response;
        }

        $response->setContent(json_encode([
            'ret_code' => 0,
            'value' => [
                'score' => $data['value']
            ],
            'reason_string' => ''
        ]));

        return $response;
    }

    public function getDiscounts(array $parameter)
    {
        $id      = $parameter["id"];
        $sig     = $parameter["sig"] ?? "";
        $hash    = hash("sha256", hash("sha256", "1".$id));

        $response = new JsonResponse();

        $timeout = $this->container->getParameter('niwo')['sanbian']['timeout'];
        $api     = $this->container->getParameter('niwo')['sanbian']['discounts'];

        $curl = new Curl();
        $curl->setOpt(CURLOPT_TIMEOUT, $timeout);


        try {
            $result = $curl->get("$api?sig=$id&status=1");

            if ($result->error || $result->http_error) {
                $response->setContent(json_encode([
                    "ret_code" => 500,
                    "value" => null,
                    "reason_string" => "网络错误",
                ]));

                $this->container->get('logger')->error("获取优惠政策分失败", ['detail' => $result]);
                return $response;
            }
        } catch(\Exception $e) {
            $this->container->get('logger')->error("获取优惠政策失败", ['detail' => $e]);
        }


        $this->sendCert("", $this->getDid($hash), $hash, ["获取优惠政策"], "获取优惠政策", $sig);

        $data= json_decode($result->response, true);

        if ($data['ret_code'] !== 0) {
            $response->setContent(json_encode([
                'ret_code' => $data['ret_code'],
                'value' => null,
                "reason_string" => $data['reason_string']
            ]));

            return $response;
        }

        $response->setContent(json_encode([
            'ret_code' => 0,
            'value' => [
                'discounts' => $data['value']
            ],
            'reason_string' => ''
        ]));

        return $response;
    }
}




