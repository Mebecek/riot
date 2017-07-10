<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7. 7. 2017
 * Time: 18:17
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends Controller
{
    /**
     * @Route("/lucky/number/lol/{max}", name="ayy")
     */
    public function numberAction($max)
    {
		$number = mt_rand(10, $max);

        return $this->render('lucky/number.html.twig', array('number' => $number,));
    }

    public function indexAction(Request $request, $firstName, $lastName)
    {
        $page = $reguest->query->get('page', 1);
    }
}