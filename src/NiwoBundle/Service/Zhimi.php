<?php

namespace NiwoBundle\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Curl\Curl;

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
        if (!in_array($request_data["op_type"], [1, 2, 3, 4, 5, 6, 10])) {
            $response->setContent(json_encode([
                "ret_code" => 40400,
                "reason_string" => "没有对应的操作类型,操作类型为[1, 2, 3, 4, 5, 6, 10]"
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
                "ret_code" => 40600,
                "reason_string" => "参数格式错误",
            ]));

            return $response;
        }

        $parameter = $request_data["parameter"];

        /**
         * 参数不全
         * ret_code 40700
         */
        if (!array_key_exists("id_type", $parameter) ||
            !array_key_exists("id", $parameter)
        ) {
            $response->setContent(json_encode([
                "ret_code" => 40700,
                "reason_string" => "参数不全,需要id_type、id、sig(可选)",
            ]));

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
                "ret_code" => 40800,
                "reason_string" => "参数不能为空",
            ]));

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
            return $this->chanquan($parameter);
        }

        /**
         * 获取农村房屋产权信息
         */
        if ($op_type == 5) {
            return $this->housingPropertyRights($parameter);
        }

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

        $curl = new Curl();
        $curl->setOpt(CURLOPT_TIMEOUT, 10);
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
                "reason_string" => "注册请求网络错误"
            ]));

            return $response;
        }

        $data= json_decode($result->response, true);

        if ($data["Error"] !== 0 || $data["Result"] == null) {
            $response->setContent(json_encode([
                "ret_code" => 400,
                "value" => null,
                "reason_string" => "注册失败"
            ]));

            return $response;
        }

        /**
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

    private function registerStatus(string $id): JsonResponse
    {
        $response = new JsonResponse();

        $id   = $parameter['id'];
        $hash = hash("sha256", hash("sha256", $id));

        $curl = new Curl();
        $curl->setOpt(CURLOPT_TIMEOUT, 10);
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
                "hash" => md5(uniqid()),
                "history" => [[
                    "timestamp" => "200610010909",
                    "name" => "谁？",
                    "place" => "哪个？",
                    "content" => "发生了什么?"
                ]]
            ]
        ]));

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
        $sig     = $parameter["sig"] ?? null;


        $rep = $this->em->getRepository("NiwoBundle\Entity\WoollandRights");

        $rights = $rep->findByOwnerId($id);

        if ($rights === null) {
            $response->setContent(json_encode([
                'code' => 0,
                'value' => null,
                'reason_string' => "无数据"
            ]));

            return $response;
        }

        $data = [];

        foreach ($rights as $right) {
            array_push($data, [
                "contry_name" => $right->getContryName(),
                "comm_name" => $right->getCommName(),
                "comm_pp_name" => $right->getCommPpName(),
                "owner_name" => $right->getOwnerName(),
                "east" => $right->getEast(),
                "south" => $right->getSouth(),
                "west" => $right->getWest(),
                "north" => $right->getNorth(),
                "woolland_id" => $right->getWoollandId(),
                "land_name" => $right->getLandName(),
                "tree_type" => $right->getTreeType(),
                "valid" => $right->getValid(),
                "authorized_date" => $right->getAuthorizedDate(),
                "processor" => $right->getProcessor()
            ]);
        }

        $response->setContent(json_encode([
            'code' => 0,
            'value' => [
                'hash' => hash("sha256", hash("sha256", $id)),
                "ownership" => $data
            ]
        ]));

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
        $sig     = $parameter["sig"] ?? null;


        $rep = $this->em->getRepository("NiwoBundle\Entity\HousingPropertyRights");

        $rights = $rep->findByOwnerId($id);

        if ($rights === null) {
            $response->setContent(json_encode([
                "ret_value" => 1,
                "value" => null,
                "reason_string" => "无数据"
            ]));

            return $response;
        }


        $value = [];

        foreach ($rights as $right) {
            $r = [
                "address" => $rights->getAddress(),
                "comm_name" => $rights->getCommName(),
                "comm_pp_name" => $rights->getCommPpName(),
                "east" => $rights->getEast(),
                "south" => $rights->getSouth(),
                "east" => $rights->getEast(),
                "west" => $rights->getWest(),
                "construct_area" => $rights->getConstructionArea(),
                "house_area" => $rights->getHouseArea(),
                "house_style" => $rights->getHouseStyle(),
                "owner_name" => $rights->getOwnerName(),
                "authorized_date" => $rights->getAuthorizedDate(),
                "authorized_dept" => $rights->getAuthorizedDept()
            ];

            array_push($value, $r);
        }

        /**
         * 假设获取成功
         */
        $response->setContent(json_encode([
            "ret_value" => 0,
            "value" => [
                "hash" => $rights->getOwnerIdHash(),
                "ownership" => $value
            ],
            "ret_string" => "获取成功"
        ]));

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
            "ret_code" => 20200,
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
}