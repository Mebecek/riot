<?php

namespace FindSummonerBundle\Controller;

use AppBundle\Controller\Classes\Generator;
use AppBundle\Controller\Classes\VersionParser;
use AppBundle\Controller\Constant\Region;
use Doctrine\ORM\EntityManagerInterface;
use FindSummonerBundle\Service\FindService;
use UserBundle\Model\Form\ChampionFindType;
use AppBundle\Controller\Form\VerificationForm;
use ChampionBundle\Service\ChampionService;
use AppBundle\Controller\Service\SummonerService;
use AppBundle\Controller\Service\TimerService;
use AppBundle\Controller\Service\VerificationService;
use ChampionBundle\Model\Repository\ChampionRepository;
use FindSummonerBundle\Service\LeagueService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;

class FindSummonerController extends Controller
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
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var Generator
     */
    private $generator;

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
     * @var LeagueService
     */
    private $leagueService;

    /**
     * @var FindService
     */
    private $findService;

    public function __construct(
        ChampionService $championService,
        Generator $generator,
        TimerService $timer,
        EntityManagerInterface $em,
        FormFactoryInterface $formFactory,
        VerificationService $verificationService,
        SummonerService $summonerService,
        ChampionRepository $championRepository,
        VersionParser $versionParser,
        LeagueService $leagueService,
        FindService $findService
    ) {
        $this->championService = $championService;
        $this->timer = $timer;
        $this->em = $em;
        $this->generator = $generator;
        $this->formFactory = $formFactory;
        $this->verificationService = $verificationService;
        $this->summonerService = $summonerService;
        $this->championRepository = $championRepository;
        $this->versionParser = $versionParser;
        $this->leagueService = $leagueService;
        $this->findService = $findService;
    }

    /**
     * @Route("/find", name="find_homepage")
     * @Security("is_granted('ROLE_USER')")
     */
    public function indexAction(Request $request)
    {
        $form = $this->formFactory->create(\FindSummonerBundle\Model\Form\ChampionFindType::class);
        $form->handleRequest($request);

        $champions = $this->championRepository->findByAlphabetical('name');
        $this->timer->checkTimer(Region::EUNE);
        $matched = null;
        $inf = null;

        $dragonData = $this->versionParser->getDragonData();

        if ($form->isSubmitted() && $form->isValid()) {
            $championsId = explode(",", $form->get('champion_list')->getData());

            $inf = $this->findService->findSummonersByFilter(
                $form->get('region')->getData(),
                $form->get('points')->getData(),
                $championsId);
        }
            unset($form);
            $form = $this->formFactory->create(\FindSummonerBundle\Model\Form\ChampionFindType::class);


        return $this->render(':template/find:find.html.twig', [
            'inf' => $inf,
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