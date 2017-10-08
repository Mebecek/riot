<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12. 7. 2017
 * Time: 15:44
 */

namespace AppBundle\Controller;

use AppBundle\Controller\Classes\Generator;
use AppBundle\Controller\Constant\Region;
use AppBundle\Controller\Service\ChampionService;
use AppBundle\Controller\Service\MasteriesService;
use AppBundle\Controller\Service\TimerService;
use AppBundle\Controller\Service\VersionService;
use AppBundle\Entity\Version;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;

class HomepageController extends Controller
{
    /**
     * @var ChampionService
     */
    private $championService;

    /**
     * @var TimerService
     */
    private $timer;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var Generator
     */
    private $generator;

    /**
     * @var MasteriesService
     */
    private $masteryService;

    /**
     * Constructor
     * @param ContainerInterface $serviceContainer
     */
    public function __construct(ChampionService $championService,Generator $generator, TimerService $timer, EntityManager $em, MasteriesService $masteryService) {
        $this->championService = $championService;
        $this->timer = $timer;
        $this->em = $em;
        $this->generator = $generator;
        $this->masteryService = $masteryService;
    }

    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        /*$champions = $this->championService
            ->getChampions(Region::EUNE);
        dump($champions);*/
        $champions = $this->timer->checkTimer(Region::EUNE);
        dump($champions);

        dump($this->masteryService->getMasteriesById(48533768, Region::EUNE));

        dump($this->generator->getRandomString());

        return $this->render('default/homepage.html.twig', [
            'champions' => $champions,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }
}