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

        $rental = new Rental();

        $rental->setPartyaName("甲方-".time());
        $rental->setPartyaId(hash("sha256", uniqid()));
        $rental->setPartyaContact("19989912345");
        $rental->setPartybName("乙方-".time());
        $rental->setPartybId(hash("sha256", uniqid()));
        $rental->setPartybContact("085188823333");
        $rental->setHash(hash("sha256", uniqid()));
        $rental->setStartTime("19900101");
        $rental->setEndTime("20990101");
        $rental->setBlock([
            "block_name" => "地块1".rand(),
            "block_area" => rand(),
            "block_type" => "田",
            "block_cordinate" => "x24534342.120,Y34343434.309",
            "block_shape" => "方形",
        ]);
        $rental->setExpense(10000.00);
        $rental->setImages([
            "p0" => file_get_contents("/home/mio/a.txt"),
            "p1" => file_get_contents("/home/mio/a.txt"),
            "p2" => file_get_contents("/home/mio/a.txt"),
            "p3" => file_get_contents("/home/mio/a.txt"),
        ]);

        $this->get("doctrine")->getManager()->persist($rental);
        $this->get("doctrine")->getManager()->flush();

        return Response::Json(Response::SUCCESS, "请求成功", true, ["name" => "renshan", "data" => $data]);
    }
}
