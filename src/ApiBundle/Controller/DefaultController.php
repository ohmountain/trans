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
        $root_dir = $this->get("kernel")->getRootDir();
        $web_dir = realpath($root_dir . "/../web");

        dump($web_dir);
        die;
        return Response::Json(Response::SUCCESS, "Welcom", true, []);
    }
}
