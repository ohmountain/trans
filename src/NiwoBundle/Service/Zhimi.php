<?php

namespace NiwoBundle\Service;

use Symfony\Component\HttpFoundation\JsonResponse;

class Zhimi
{
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
        if (!in_array($request_data["op_type"], [1, 2, 3, 4, 5])) {
            $response->setContent(json_encode([
                "ret_code" => 40400,
                "reason_string" => "没有对应的操作类型,操作类型为[1, 2, 3, 4, 5]"
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
            !array_key_exists("id_hash", $parameter) ||
            !array_key_exists("sig", $parameter)
        ) {
            $response->setContent(json_encode([
                "ret_code" => 40700,
                "reason_string" => "参数不全,需要id_type、id_hash、sig",
            ]));

            return $response;
        }

        $id_type = $parameter["id_type"];
        $id_hash = $parameter["id_hash"];
        $sig     = $parameter["sig"];

        /**
         * 参数不能为空
         * ret_code 40800
         */
        if (empty($id_hash) || empty($id_type) || empty($sig)) {
            $response->setContent(json_encode([
                "ret_code" => 40800,
                "reason_string" => "注册参数不能为空",
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
         * 获取三变信息
         */
        if ($op_type == 3) {
            return $this->sanbian($parameter);
        }

        /**
         * 获取产权信息
         */
        if ($op_type == 4) {
            return $this->chanquan($parameter);
        }

        /**
         * 是否取得社会救助
         */
        if ($op_type == 5) {
            return $this->jiuzhu($parameter);
        }

    }

    /**
     * 处理注册请求
     *
     * @param array $parameter
     *
     * @return JsonResponse
     */
    private function register(array $request_data)
    {

        $response = new JsonResponse();

        /**
         * TODO
         * 1. 执行正常的注册逻辑
         * 2. 可能注册失败
         * 3. 可能已被注册
         */

        /**
         * 假设注册成功
         * ret_code 20200
         */
        $response->setContent(json_encode([
            "ret_code" => 20200,
            "value" => [
                "bc_id" => md5(uniqid())
            ]
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
            "ret_code" => 20200,
            "value" => [
                "hash" => md5(uniqid()),
                "history" => [[
                    "timestamp" => time(),
                    "name" => "谁？",
                    "place" => "哪个？",
                    "content" => "发生了什么?"
                ]]
            ]
        ]));

        return $response;
    }

    private function sanbian(array $parameter): JsonResponse
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
                "hash" => md5(uniqid()),
                "type" => 1,
                "ownership" => [[
                    "onwer_id" => md5(uniqid()),
                    "onwer_name" => "王二麻子",
                    "sid" => "522900190001010909",
                    "spouse_name" => "王二麻子的媳妇",
                    "family_member" => 4,
                    "county_name" => "某个乡镇",
                    "group" => 1,
                    "land_owner" => "王二麻子",
                    "cons_time" => (new \DateTime()),
                    "floor_number" => 3,
                    "layout" => "结构非常好",
                    "land_area" => 100,
                    "confirmed_area" => 100,
                    "east" => "东海",
                    "south" => "南海",
                    "west" => "西太平洋",
                    "north" => "北冰洋",
                    "comments" => "备注",
                    "input" => "我"
                ]]
            ]
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