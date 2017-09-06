<?php

namespace NiwoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NiwoControllerTest extends WebTestCase
{
    /**
     * 测试 unix时间戳作为证件号注册
     */
    public function testCreate()
    {
        $client = static::createClient();

        $post_data = [
            "op_type" => 1,
            "parameter" => [
                "id" => time(),
                "id_type" => 1
            ]
        ];

        $json_data = json_encode($post_data);

        $crawler = $client->request('GET', "/zhimi?data={$json_data}");

        $content = $client->getResponse()->getContent();

        $result  = json_decode($content, true);

        $ret_code = $result["ret_code"];

        $this->assertTrue($ret_code === 0);

        $this->assertTrue(is_array($result["value"]));
        $this->assertTrue(array_key_exists("bc_id", $result["value"]));
        $this->assertTrue(array_key_exists("state", $result["value"]));
        $this->assertTrue($result["value"]["state"] =="0");

    }

    /**
     * 测试一个已经注册的号码
     */
    public function testCreateExisted()
    {
        $client = static::createClient();

        $post_data = [
            "op_type" => 1,
            "parameter" => [
                "id" => "1",
                "id_type" => 1
            ]
        ];

        $json_data = json_encode($post_data);

        $crawler = $client->request('GET', "/zhimi?data={$json_data}");

        $content = $client->getResponse()->getContent();

        $result  = json_decode($content, true);

        $ret_code = $result["ret_code"];

        $this->assertEquals($ret_code, 4);
    }

    /**
     * 测试诚信API
     */
    public function testChengxin()
    {
        $client = static::createClient();

        $post_data = [
            "op_type" => 2,
            "parameter" => [
                "id" => "1",
                "id_type" => 1
            ]
        ];

        $json_data = json_encode($post_data);

        $crawler = $client->request('GET', "/zhimi?data={$json_data}");

        $content = $client->getResponse()->getContent();

        $result  = json_decode($content, true);

        $ret_code  = $result["ret_code"];
        $ret_value = $result["value"];

        $this->assertTrue($ret_code === 0);
        $this->assertTrue(is_array($ret_value));
        $this->assertTrue(array_key_exists("hash", $ret_value));
        $this->assertTrue(array_key_exists("history", $ret_value));
    }

    /**
     * 土地权益的测试
     */
    public function testLandRights()
    {
        $client = static::createClient();

        $post_data = [
            "op_type" => 3,
            "parameter" => [
                "id" => "1",
                "id_type" => 1
            ]
        ];

        $json_data = json_encode($post_data);

        $crawler = $client->request('GET', "/zhimi?data={$json_data}");

        $content = $client->getResponse()->getContent();

        $result  = json_decode($content, true);

        $ret_code  = $result["ret_code"];
        $ret_value = $result["value"];

        $this->assertTrue($ret_code === 0);
        $this->assertTrue(is_array($ret_value));
        $this->assertTrue(array_key_exists("hash", $ret_value));
        $this->assertTrue(array_key_exists("ownership", $ret_value));
    }


    /**
     * 房屋产权的测试
     */
    public function testhousingRights()
    {
        $client = static::createClient();

        $post_data = [
            "op_type" => 5,
            "parameter" => [
                "id" => "1",
                "id_type" => 1
            ]
        ];

        $json_data = json_encode($post_data);

        $crawler = $client->request('GET', "/zhimi?data={$json_data}");

        $content = $client->getResponse()->getContent();

        $result  = json_decode($content, true);

        $ret_code  = $result["ret_code"];
        $ret_value = $result["value"];

        $this->assertTrue($ret_code === 0);
        $this->assertTrue(is_array($ret_value));
        $this->assertTrue(array_key_exists("hash", $ret_value));
        $this->assertTrue(array_key_exists("ownership", $ret_value));
    }

    /**
     * 测试没有参数
     */
    public function testRequestWithoutParameters()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', "/zhimi");

        $content = $client->getResponse()->getContent();
        $result  = json_decode($content, true);

        $ret_code = $result["ret_code"];
        $reason_string = $result["reason_string"];

        $this->assertEquals($ret_code, 40100);
        $this->assertEquals($reason_string, "需要请求参数");
    }

    /**
     * 测试参数格式错误
     */
    public function testParametersIsNotJson()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', "/zhimi?data=123");

        $content = $client->getResponse()->getContent();
        $result  = json_decode($content, true);

        $ret_code = $result["ret_code"];
        $reason_string = $result["reason_string"];

        $this->assertEquals($ret_code, 40200);
        $this->assertEquals($reason_string, "参数格式错误");
    }

    /**
     * 测试缺少操作类型
     */
    public function testWithoutOpType()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', "/zhimi?data={}");

        $content = $client->getResponse()->getContent();
        $result  = json_decode($content, true);

        $ret_code = $result["ret_code"];
        $reason_string = $result["reason_string"];

        $this->assertEquals($ret_code, 40300);
        $this->assertEquals($reason_string, "缺少操作类型参数");
    }

    /**
     * 测试操作类型不存在
     */
    public function testOutOfOpType()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', "/zhimi?data={\"op_type\": 100}");

        $content = $client->getResponse()->getContent();
        $result  = json_decode($content, true);

        $ret_code = $result["ret_code"];
        $reason_string = $result["reason_string"];

        $this->assertEquals($ret_code, 40400);
        $this->assertEquals($reason_string, "没有对应的操作类型,操作类型为[1, 2, 3, 4, 5, 6, 10]");
    }

    public function testWithoutParameters()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', "/zhimi?data={\"op_type\": 1}");

        $content = $client->getResponse()->getContent();
        $result  = json_decode($content, true);

        $ret_code = $result["ret_code"];
        $reason_string = $result["reason_string"];

        $this->assertEquals($ret_code, 40500);
        $this->assertEquals($reason_string, "缺少参数");
    }


    public function testParametersIsNotArray()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', "/zhimi?data={\"op_type\": 1, \"parameter\": 1}");

        $content = $client->getResponse()->getContent();
        $result  = json_decode($content, true);

        $ret_code = $result["ret_code"];
        $reason_string = $result["reason_string"];

        $this->assertEquals($ret_code, 5);
        $this->assertEquals($reason_string, "参数格式错误");
    }

    /**
     * 测试id异常
     */
    public function testIdAbnormal()
    {
        $client = static::createClient();

        $post_data = [
            "op_type" => 2,
            "parameter" => [
                "id_hash" => "1",
                "id_type" => 1
            ]
        ];

        $json_data = json_encode($post_data);

        $crawler = $client->request('POST', "/zhimi?data={$json_data}");

        $content = $client->getResponse()->getContent();

        $result  = json_decode($content, true);

        $ret_code  = $result["ret_code"];
        $reason_string = $result["reason_string"];

        $this->assertEquals($ret_code, 1);
        $this->assertEquals($reason_string, "id 异常");
    }

    /**
     * 测试id_type异常
     */
    public function testIdTypeAbnormal()
    {
        $client = static::createClient();

        $post_data = [
            "op_type" => 2,
            "parameter" => [
                "id" => 1,
            ]
        ];

        $json_data = json_encode($post_data);

        $crawler = $client->request('POST', "/zhimi?data={$json_data}");

        $content = $client->getResponse()->getContent();

        $result  = json_decode($content, true);

        $ret_code  = $result["ret_code"];
        $reason_string = $result["reason_string"];

        $this->assertEquals($ret_code, 2);
        $this->assertEquals($reason_string, "id_type 异常");
    }
}
