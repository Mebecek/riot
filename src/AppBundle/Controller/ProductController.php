<?php

namespace AppBundle\Controller;

use AppBundle\Controller\Service\FileUploader;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductPicture;
use FOS\CommentBundle\Tests\Functional\Bundle\CommentBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\Form\ProductType;

class ProductController extends Controller
{
    /**
     * @Route("/article/new", name="article_new")
     * @Security("is_granted('ROLE_USER')")
     */
    public function newAction(Request $request, FileUploader $fileUploader)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->get('doctrine')->getManager();

            $product->setAuthor($this->getUser());
            $product->setTitle($form->get('title')->getData());
            $product->setPerex($form->get('perex')->getData());
            $product->setText($form->get('text')->getData());

            $em->persist($product);
            $em->flush();
            $this->addFlash("success", "Article was successfully added");

        }

        return $this->render('form/article.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/article/", name="article")
     */
    public function showAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $records = $em->getRepository(Product::class)->findAll();

        $paginator  = $this->get('knp_paginator');

        $blogPosts = $paginator->paginate(
            $records,
            $request->query->getInt('page', 1),5
        );

        return $this->render('article/articles.html.twig', [
            'data' => $records,
            'blog_posts' => $blogPosts,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/article/{productId}", name="article_single")
     * @Method("GET")
     */
    public function singleAction($productId)
    {
        $em = $this->get('doctrine')->getManager();
        $product = $em->getRepository(Product::class)
            ->find($productId);

        $images = $em->getRepository(ProductPicture::class)
                ->findBy(['product' => $productId]);

        $repository = $em->getRepository(Comment::class);
        $allcomments = $repository->findBy(['product' => $productId, 'comment' => null], ['id' => 'DESC']);

        $comentary = $repository->findBy(['product' => $productId, 'comment' => $allcomments], ['id' => 'DESC']);

        $cmts = $repository->findBy(['product' => $productId, 'comment' => $comentary], ['id' => 'DESC']);

        return $this->render('article/article_view.html.twig', [
            'data' => $product,
            'allcomments' => $allcomments,
            'comments' => $comentary,
            'cmts' => $cmts,
            'images' => $images,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

}