<?php

namespace PMI\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * User controller.
 *
 * @Route("/test")
 */
class TestController extends Controller
{

    /**
     * Lists all UsersTasks entities.
     *
     * @Route("/", name="test_pmi")
     * @Template()
     */
    public function indexAction()
    {
        
        return array( );
    }


}
