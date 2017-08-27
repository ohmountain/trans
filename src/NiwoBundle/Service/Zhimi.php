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
         * 注册
         */
        if ($op_type == 1) {
            return $this->register($request_data);
        }

        /**
         * 获取诚信信息
         */
        if ($op_type == 2) {
            return $this->chengxin($request_data);
        }

        /**
         * 获取三变信息
         */
        if ($op_type == 3) {
            return $this->sanbian($request_data);
        }

        /**
         * 获取产权信息
         */
        if ($op_type == 4) {
            return $this->chanquan($request_data);
        }

        /**
         * 是否取得社会救助
         */
        if ($op_type == 5) {
            return $this->jiuzhu($request_data);
        }

    }

    /**
     * 处理注册请求
     *
     * @param array $request_data
     *
     * @return JsonResponse
     */
    private function register(array $request_data)
    {

        $response = new JsonResponse();

        /**
         * 缺少注册参数
         * ret_code 40500
         */
        if (!array_key_exists("parameter", $request_data)) {
            $response->setContent(json_encode([
                "ret_code" => 40500,
                "reason_string" => "缺少注册参数",
            ]));

            return $response;
        }

        /**
         * 注册参数格式错误
         * ret_code 40600
         */
        if (!is_array($request_data["parameter"])) {
            $response->setContent(json_encode([
                "ret_code" => 40600,
                "reason_string" => "注册参数格式错误",
            ]));

            return $response;
        }

        $parameter = $request_data["parameter"];

        /**
         * 注册参数不全
         * ret_code 40700
         */
        if (!array_key_exists("id_type", $parameter) ||
            !array_key_exists("id_hash", $parameter) ||
            !array_key_exists("sig", $parameter)
        ) {
            $response->setContent(json_encode([
                "ret_code" => 40700,
                "reason_string" => "注册参数不全,需要id_type、id_hash、sig",
            ]));

            return $response;
        }

        $id_type = $parameter["id_type"];
        $id_hash = $parameter["id_hash"];
        $sig     = $parameter["sig"];

        /**
         * 注册参数不能为空
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
}