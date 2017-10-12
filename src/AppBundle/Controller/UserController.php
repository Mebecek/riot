<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 18. 7. 2017
 * Time: 10:30
 */

namespace AppBundle\Controller;


use AppBundle\Controller\Form\UserRegistrationForm;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     */
    public function registerAction(Request $request)
    {
        $form = $this->createForm(UserRegistrationForm::class);

        $form->handleRequest($request);

        if ($form->isValid())
        {
            /** @var User $user */
            $user = $form->getData();
            $user->setNickname("");
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            //$this->addFlash('success', 'Welcome '.$user->getEmail());

            return $this->get('security.authentication.guard_handler')
                ->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $this->get('app.security.login_form_authenticator'),
                    'main'
                );
        }

        return $this->render('form/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}