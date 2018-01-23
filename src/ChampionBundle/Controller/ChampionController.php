<?php

namespace ChampionBundle\Controller;

use AppBundle\Controller\Classes\VersionParser;
use AppBundle\Controller\Constant\Region;
use AppBundle\Controller\Service\TimerService;
use ChampionBundle\Model\Repository\ChampionRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChampionController extends Controller
{
    /**
     * @var ChampionRepository
     */
    private $championRepository;

    /**
     * @var VersionParser
     */
    private $versionParser;

    /**
     * @var TimerService
     */
    private $timerService;

    /**
     * Constructor
     *
     * @param ChampionRepository $championRepository
     * @param VersionParser $versionParser
     */
    public function __construct(
        ChampionRepository $championRepository,
        VersionParser $versionParser,
        TimerService $timerService
    ) {
        $this->championRepository = $championRepository;
        $this->versionParser = $versionParser;
        $this->timerService = $timerService;
    }

    /**
     * @Route("/champions", name="champions_homepage")
     */
    public function indexAction()
    {
        $champions = $this->championRepository->findByAlphabetical('name');
        $dragonData = $this->versionParser->getDragonData();
        $this->timerService->checkTimer(Region::EUNE);

        return $this->render(':ChampionBundle/components/champion:champion.html.twig', [
            'dragonData' => $dragonData,
            'champions' => $champions,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/champions/{id}", name="champions_info")
     */
    public function championAction($id)
    {
        $champion = $this->championRepository->getRepository()->findOneBy(['championId' => $id]);
        $dragonData = $this->versionParser->getDragonData();

        return $this->render(':ChampionBundle/components/champion:champion_info.html.twig', [
            'dragonData' => $dragonData,
            'champion' => $champion,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }
}