<?php

namespace ApiBundle\Service;

use Symfony\Component\HttpFoundation\Response as BaseResponse;

class Response
{
    const SUCCESS  = 200;            // (成功) 服务器已成功处理了请求
    const CREATED  = 201;            // (已创建) 请求成功并且服务器创建了新的资源
    const ACCEPTED = 202;            // (已接受) 服务器已接受请求，但尚未处理
    const EMPTY    = 204;            // (无内容) 服务器成功处理了请求，但没有返回任何内容

    const UNKNOW    = 400;           // (错误请求) 服务器不理解请求的语法
    const NOT_AUTH  = 401;           // (未授权) 请求要求身份验证
    const FORBIDDEN = 403;           // (禁止) 服务器拒绝请求
    const TIMEOUT   = 408;           // (请求超时）  服务器等候请求时发生超时
    const REQUIRE_PARAMETERS = 412;  // (未满足前提条件) 服务器未满足请求者在请求中设置的其中一个前提条件

    const SERVER_ERROR = 500;        // (服务器内部错误) 服务器遇到错误，无法完成请求

    /**
     * @param int $code
     * @param string $message
     * @param bool $success
     * @param array $content
     *
     * @return Symfony\Component\HttpFoundation\Response
     */
    public static function json(int $code, string $message, bool $success, array $content): BaseResponse
    {
        $response = new BaseResponse();

        $response->headers->set("Content-Type", "Application/Json");

        $data = [
            "code" => $code,
            "message" => $message,
            "success" => $success,
            "content" => $content
        ];

        $response->setContent(json_encode($data));

        return $response;
    }
}
