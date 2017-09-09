<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use ApiBundle\Service\Response;
use Curl\Curl;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $data = json_decode($request->get("data"));
        return Response::Json(Response::SUCCESS, "请求成功", true, ["name" => "renshan", "data" => $data]);
    }
}
