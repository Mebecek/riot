<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 19. 7. 2017
 * Time: 9:16
 */

namespace AppBundle\Controller;


use AppBundle\Controller\Form\ChangePasswordForm;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SettingsController extends Controller
{
    /**
     * @Route("/settings", name="settings")
     */
    public function settingsAction()
    {
        return $this->render('settings/settings.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR
        ]);
    }

    /**
     * @Route("settings/changepassword", name="changepassword")
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
}