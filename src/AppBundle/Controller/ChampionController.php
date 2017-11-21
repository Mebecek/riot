<?php

namespace AppBundle\Controller;

use AppBundle\Controller\Classes\Generator;
use AppBundle\Controller\Classes\VersionParser;
use AppBundle\Controller\Constant\Region;
use AppBundle\Controller\Form\Find\ChampionFindType;
use AppBundle\Controller\Form\VerificationForm;
use AppBundle\Controller\Service\ChampionService;
use AppBundle\Controller\Service\MasteriesService;
use AppBundle\Controller\Service\SummonerService;
use AppBundle\Controller\Service\TimerService;
use AppBundle\Controller\Service\VerificationService;
use AppBundle\Repository\ChampionRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;

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
     * Constructor
     *
     * @param ChampionRepository $championRepository
     * @param VersionParser $versionParser
     */
    public function __construct(
        ChampionRepository $championRepository,
        VersionParser $versionParser
    ) {
        $this->championRepository = $championRepository;
        $this->versionParser = $versionParser;
    }

    /**
     * @Route("/champions", name="champions_homepage")
     */
    public function indexAction()
    {
        $champions = $this->championRepository->findAll();
        $dragonData = $this->versionParser->getDragonData();


        return $this->render(':template/champion:champion.html.twig', [
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
        $champion = $this->championRepository->findOneBy(['championId' => $id], ['name' => 'DESC']);
        $dragonData = $this->versionParser->getDragonData();

        return $this->render(':template/champion:champion_info.html.twig', [
            'dragonData' => $dragonData,
            'champion' => $champion,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }
}