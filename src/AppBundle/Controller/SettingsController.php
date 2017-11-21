<?php

namespace AppBundle\Controller;

use AppBundle\Controller\Form\ChangePasswordForm;
use AppBundle\Controller\Form\VerificationForm;
use AppBundle\Controller\Service\SummonerService;
use AppBundle\Controller\Service\VerificationService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;

class SettingsController extends Controller
{
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

    public function __construct(
        FormFactoryInterface $formFactory,
        VerificationService $verificationService,
        SummonerService $summonerService
    ) {
        $this->formFactory = $formFactory;
        $this->verificationService = $verificationService;
        $this->summonerService = $summonerService;
    }

    /**
     * @Route("/settings", name="settings")
     * @Security("is_granted('ROLE_USER')")
     */
    public function settingsAction()
    {
        return $this->render('settings/settings.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR
        ]);
    }

    /**
     * @Route("settings/changepassword", name="settings_changepassword")
     * @Security("is_granted('ROLE_USER')")
     */
    public function changepasswordAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $form = $this->createForm(ChangePasswordForm::class);
        $form->handleRequest($request);

        $em = $this->get('doctrine')->getManager();

        if ($form->isValid())
        {
            $user = $this->getUser();
            $plainPassword = $form->get('newPassword')->getData();
            $encoded = $encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encoded);

            $em->persist($user);
            $em->flush();
        }


            return $this->render('settings/settings.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/settings/verify", name="settings_verify")
     * @Security("is_granted('ROLE_USER')")
     */
    public function verifyAction(Request $request)
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