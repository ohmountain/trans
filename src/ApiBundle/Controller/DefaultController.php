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
        return Response::Json(Response::SUCCESS, "Welcom", true, []);
    }
}
