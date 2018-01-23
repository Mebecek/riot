<?php

namespace AppBundle\Controller;

use AppBundle\Controller\Constant\Region;
use FindSummonerBundle\Service\LeagueService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomepageController extends Controller
{
    /**
     * @var LeagueService
     */
    private $leagueService;

    public function __construct(LeagueService $leagueService)
    {
        $this->leagueService = $leagueService;
    }

    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        if ($request->query->get('key') === 'PSdCnMqjZzDRkRh7WZ0R')
        {
            dump($this->leagueService->saveRecievedData());
        }

        return $this->render(':template/homepage:homepage.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }
}