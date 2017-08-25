<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\Service\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return Response::Json(Response::SUCCESS, "请求成功", true, ["name" => "renshan"]);
    }
}
