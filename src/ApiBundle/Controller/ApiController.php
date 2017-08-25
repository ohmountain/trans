<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use ApiBundle\Service\Response;

class ApiController extends Controller
{
    public function getInfoAction(Request $request)
    {
        $id     = $request->get("id");
        $page   = $request->get("page", 1);
        $count  = $request->get("count", 20);


        $data = [
            "page" => $page,
            "count" => $count,
            "maxPage" => 0,
            "maxCount" => 0,
            "info" => null
        ];

        if ($id == null) {
            return Response::Json(Response::REQUIRE_PARAMETERS, "ID不能为空", false, $data);
        }

        return Response::Json(Response::REQUIRE_PARAMETERS, "ID不能为空", false, $data);
    }

    public function exampleAction(Request $request)
    {
        $data = $request->get("data");

        if ($data == null) {
            return Response::Json(Response::REQUIRE_PARAMETERS, "参数不能为空", false, []);
        }

        $tmp = json_decode($data, true);

        $data = null;

        if (json_last_error() !== 0) {
            return Response::Json(Response::UNKNOW, "参数解析错误", false, []);
        }

        if (empty($tmp["username"]) || empty($tmp["password"])) {
            return Response::Json(Response::REQUIRE_PARAMETERS, "username 或 password 为空", false, []);
        }

        $username = $tmp["username"];
        $password = $tmp["password"];

        if ($username === "root" && $password == "123456") {
            $data = [
                "username" => $username,
                "password" => $password
            ];
            return Response::Json(Response::SUCCESS, "验证成功", true, $data);
        }

        return Response::Json(Response::ACCEPTED, "验证失败", false, []);
    }
}