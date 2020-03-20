<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticleController extends AbstractController
{
    /**
     * @var ArticleRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;
    public function __construct(ArticleRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    /**
     * @Route("/admin", name="admin.article.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $articles = $this->repository->findAll();
        return $this->render('admin/article/index.html.twig', compact('articles'));
    }
    /**
     * @Route("/admin/create", name="admin.article.create")
     */
    public function new(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($article);
            $this->em->flush();
            return $this->redirectToRoute('admin.article.index');
        }
        return $this->render('admin/article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/{id}", name="admin.article.edit", methods="GET|POST")
     * @param Article $article
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Article $article, Request $request)
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('admin.article.index');
        }
        return $this->render('admin/article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/{id}", name="admin.article.delete", methods="DELETE")
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Article $article, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->get('_token')))
        {
            $this->em->remove($article);
            $this->em->flush();
            $this->addFlash('success', 'Article Supprimer !');
        }
        return $this->redirectToRoute('admin.article.index');
    }
}