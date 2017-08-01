<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12. 7. 2017
 * Time: 15:44
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    /**
     * @Route("/homepage", name="home")
     */
    public function indexAction()
    {
        return $this->render('default/homepage.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }
}