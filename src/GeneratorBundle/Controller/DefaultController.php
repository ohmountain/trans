<?php

namespace GeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GeneratorBundle\Service\Land;

class DefaultController extends Controller
{
    public function indexAction()
    {

        // (new Land($this->get("service_container")))->generate_land();
        // (new Land($this->get("service_container")))->generate_block();

        return $this->render('GeneratorBundle:Default:index.html.twig');
    }
}
