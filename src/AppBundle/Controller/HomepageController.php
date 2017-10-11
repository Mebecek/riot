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
use AppBundle\Controller\Form\VerificationForm;
use AppBundle\Controller\Service\ChampionService;
use AppBundle\Controller\Service\MasteriesService;
use AppBundle\Controller\Service\SummonerService;
use AppBundle\Controller\Service\TimerService;
use AppBundle\Controller\Service\VerificationService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;

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
        SummonerService $summonerService
    ) {
        $this->championService = $championService;
        $this->timer = $timer;
        $this->em = $em;
        $this->generator = $generator;
        $this->masteryService = $masteryService;
        $this->formFactory = $formFactory;
        $this->verificationService = $verificationService;
        $this->summonerService = $summonerService;
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

        dump($this->masteryService->getMasteriesById(35504770, Region::EUNE));

        dump($this->generator->getRandomString());

        return $this->render('default/homepage.html.twig', [
            'champions' => $champions,
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