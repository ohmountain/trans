<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use ApiBundle\Service\Response;
use Curl\Curl;

use NiwoBundle\Entity\Rental;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $data = json_decode($request->get("data"));

        $res = $this->get("niwo.sanbian")->woodland(1);

        dump($res);
        die;

        return Response::Json(Response::SUCCESS, "请求成功", true, ["name" => "renshan", "data" => $data]);
    }
}
