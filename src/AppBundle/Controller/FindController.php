<?php

namespace AppBundle\Controller;

use AppBundle\Controller\Classes\Generator;
use AppBundle\Controller\Classes\VersionParser;
use AppBundle\Controller\Constant\Region;
use AppBundle\Controller\Form\Find\ChampionFindType;
use AppBundle\Controller\Form\VerificationForm;
use AppBundle\Controller\Service\ChampionService;
use AppBundle\Controller\Service\MasteriesService;
use AppBundle\Controller\Service\MatchService;
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

class FindController extends Controller
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
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var VerificationService
     */
    private $verificationService;

    /**
     * @var SummonerService
     */
    private $summonerService;

    /**
     * @var ChampionRepository
     */
    private $championRepository;

    /**
     * @var VersionParser
     */
    private $versionParser;

    /**
     * @var MatchService
     */
    private $matchService;

    /**
     * Constructor
     * @param ContainerInterface $serviceContainer
     */
    public function __construct(
        ChampionService $championService,
        Generator $generator,
        TimerService $timer,
        EntityManager $em,
        MasteriesService $masteryService,
        FormFactoryInterface $formFactory,
        VerificationService $verificationService,
        SummonerService $summonerService,
        ChampionRepository $championRepository,
        VersionParser $versionParser,
        MatchService $matchService
    ) {
        $this->championService = $championService;
        $this->timer = $timer;
        $this->em = $em;
        $this->generator = $generator;
        $this->masteryService = $masteryService;
        $this->formFactory = $formFactory;
        $this->verificationService = $verificationService;
        $this->summonerService = $summonerService;
        $this->championRepository = $championRepository;
        $this->versionParser = $versionParser;
        $this->matchService = $matchService;
    }

    /**
     * @Route("/find", name="find_homepage")
     * @Security("is_granted('ROLE_USER')")
     */
    public function indexAction(Request $request)
    {
        $form = $this->formFactory->create(ChampionFindType::class);
        $form->handleRequest($request);

        $champions = $this->championRepository->findAll();
        $timer = $this->timer->checkTimer(Region::EUNE);

        $dragonData = $this->versionParser->getDragonData();

        if ($form->isSubmitted() && $form->isValid()) {
            dump(explode(",", $form->get('champion_list')->getData()));
            unset($form);
            $form = $this->formFactory->create(ChampionFindType::class);

            dump($this->matchService->getMatchesBySummonerId(40142082, Region::EUNE));
        }

        return $this->render(':template/find:find.html.twig', [
            'dragonData' => $dragonData,
            'champions' => $champions,
            'form' => $form->createView(),
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/verify", name="verify")
     * @Security("is_granted('ROLE_USER')")
     */
    public function verifying(Request $request)
    {
        $form = $this->formFactory->create(VerificationForm::class);
        $form->handleRequest($request);

        $verification = $this->verificationService->getVerification();

        if (!$verification->getVerified()) {
            if ($form->isSubmitted() && $form->isValid()) {
                $summoner = $this->summonerService->getSummonerByName($form->get('nickname')->getData(), $form->get('region')->getData());

                dump($this->verificationService->checkVerification($summoner->getSummonerId(), $form->get('region')->getData()));
                if ($this->verificationService->checkVerification($summoner->getSummonerId(), $form->get('region')->getData())) {
                    $this->verificationService->updateVerification($verification);
                }
            }
        }

        return $this->render(':default:verify.html.twig', [
            'verification' => $verification,
            'form' => $form->createView(),
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }
}