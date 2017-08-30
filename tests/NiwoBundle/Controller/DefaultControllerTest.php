<?php

namespace NiwoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $post_data = [
            "op_type" => 1,
            "parameter" => [
                "id" => "522630199009010658",
                "id_type" => 1
            ]
        ];

        $json_data = json_encode($post_data);

        $crawler = $client->request('GET', "/zhimi?data={$json_data}");

        $content = $client->getResponse()->getContent();

        $result  = json_decode($content, true);

        $this->assertTrue($result["ret_code"] === 0);
        $this->assertTrue(is_array($result["value"]));
        $this->assertTrue(array_key_exists("bc_id", $result["value"]));
        $this->assertTrue(array_key_exists("state", $result["value"]));
        $this->assertTrue($result["value"]["state"] === "sent" ||
                          $result["value"]["state"] === "comfirmed");

    }
}
