<?php

namespace NiwoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use RandBuilder\Builder;
use NiwoBundle\Entity\Person;
use NiwoBundle\Entity\Portrait;

class ZhimiController extends Controller
{
    public function indexAction(Request $request)
    {
        $data = $request->get("data");

        /**
         *  没有请求参数
         *  ret_code 40100
         */
        if (empty($data)) {
            $response = new Response(json_encode(array(
                "ret_code" => 40100,
                "reason_string" => "需要请求参数"
            )));

            $response->headers->set("content-type", "application/json");

            return $response;
        }

        $json_data = json_decode($data, true);

        /**
         *  参数不是JSON格式
         *  ret_code 40200
         */
        if (json_last_error() != JSON_ERROR_NONE || !is_array($json_data)) {
            $response = new Response(json_encode(array(
                "ret_code" => 40200,
                "reason_string" => "参数格式错误"
            )));

            $response->headers->set("content-type", "application/json");

            return $response;
        }

        $zhimi_service = $this->get("niwo.zhimi");

        return $zhimi_service->handleRequestData($json_data);
    }

    public function gAction()
    {
        dump($this->get('niwo.zhimi')->isRegistered("1111232"));
    }
}
