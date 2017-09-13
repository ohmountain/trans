<?php

namespace  NiwoBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Curl\Curl;

/**
 ** 获取三变信息
 **/
class Sanbian
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * 获取土地确权信息
     *
     * @param string $id
     *
     * @return array
     */
    public function land(string $id): \stdClass
    {
        $curl = new Curl();

        $curl->setOpt(CURLOPT_TIMEOUT, $this->container->getParameter("niwo")["sanbian"]["timeout"]);
        $url  = $this->container->getParameter("niwo")["sanbian"]["land"];
        $url  = "{$url}?bc_id={$id}";

        $result = $curl->get($url);

        if ($result->error == true) {

            $this->container->get("logger")->error("获取土地确权信息出错",["url" => $url, "message" => $result->error_message]);

           return json_decode(json_encode([
                    "error" => true,
                    "message" => $result->error_message,
                    "data" => null
                ]));
        }

        $data = json_decode($result->response, true);

        return json_decode(json_encode([
            "error" => false,
            "message" => "",
            "data" => $data["value"]
        ]));
    }


    /**
     * 获取林权信息
     *
     * @param string $id
     *
     * @return array
     */
    public function woodland(string $id): \stdClass
    {
        $curl = new Curl();

        $curl->setOpt(CURLOPT_TIMEOUT, $this->container->getParameter("niwo")["sanbian"]["timeout"]);
        $url  = $this->container->getParameter("niwo")["sanbian"]["woodland"];
        $url  = "{$url}?bc_id={$id}";

        $result = $curl->get($url);

        if ($result->error == true) {

            $this->container->get("logger")->error("获取林权信息出错",["url" => $url, "message" => $result->error_message]);

            return json_decode(json_encode([
                "error" => true,
                "message" => $result->error_message,
                "data" => null
            ]));
        }

        $data = json_decode($result->response, true);

        return json_decode(json_encode([
            "error" => false,
            "message" => "",
            "data" => $data["value"]
        ]));
    }


    /**
     * 获取房屋产权信息
     *
     * @param string $id
     *
     * @return array
     */
    public function housing(string $id): \stdClass
    {
        $curl = new Curl();

        $curl->setOpt(CURLOPT_TIMEOUT, $this->container->getParameter("niwo")["sanbian"]["timeout"]);
        $url  = $this->container->getParameter("niwo")["sanbian"]["housing"];
        $url  = "{$url}?bc_id={$id}";

        $result = $curl->get($url);

        if ($result->error == true) {

            $this->container->get("logger")->error("获取房屋产权信息出错",["url" => $url, "message" => $result->error_message]);

            return json_decode(json_encode([
                "error" => true,
                "message" => $result->error_message,
                "data" => null
            ]));
        }

        $data = json_decode($result->response, true);

        return json_decode(json_encode([
            "error" => false,
            "message" => "",
            "data" => $data["value"]
        ]));
    }
}