<?php

namespace AppBundle\Controller;

use AppBundle\Controller\Form\CommentForm;
use AppBundle\Repository\CommentRepository;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CommentController extends Controller
{
    /**
     * @var CommentRepository $commentRepository
     */
    private $commentRepository;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorsge;

    public function __construct(CommentRepository $commentRepository, \Twig_Environment $twig, FormFactoryInterface $formFactory, EntityManagerInterface $em, TokenStorageInterface $tokenStorsge)
    {
        $this->commentRepository = $commentRepository;
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->tokenStorsge = $tokenStorsge;
    }


    /**
     * @Route("/article/{productId}/new", name="comment_new")
     * @Security("is_granted('ROLE_USER')")
     */
    public function newAction(Request $request, $productId)
    {
        $comment = new Comment();
        $form = $this->formFactory->create(CommentForm::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->get('doctrine')->getManager();
            /** @var Product $product */
            $product = $em->getRepository(Product::class)->find($productId);

            $comment->setAuthor($this->getUser());
            $comment->setProduct($product);
            $comment->setContent($form->get('content')->getData());

            $this->em->persist($comment);
            $this->em->flush();

        }

        return $this->render(':form:comment.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/article/{productId}/{commentId}/new", name="comment_comment_new")
     * @Security("is_granted('ROLE_USER')")
     */
    public function newcomAction(Request $request, $productId, $commentId)
    {
        $comment = new Comment();
        $form = $this->formFactory->create(CommentForm::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->get('doctrine')->getManager();
            /** @var Product $product */
            $product = $em->getRepository(Product::class)->find($productId);
            $commentt = $em->getRepository(Comment::class)->find($commentId);


            $comment->setAuthor($this->getUser());
            $comment->setProduct($product);
            $comment->setContent($form->get('content')->getData());
            $comment->setCommentlist($commentt);

            $this->em->persist($comment);
            $this->em->flush();

        }

        return $this->render(':form:comment.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}