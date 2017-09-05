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

        $this->assertTrue($ret_code === 4);
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
}
