<?php


namespace App\Controller;


use App\Entity\ArticleSearch;
use App\Repository\ArticleRepository;
use App\Form\ArtcileSerchType;
use App\Service\Cart\CartService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;

//use Doctrine\Persistence\ObjectManager;




class ArticleController extends AbstractController
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
     * @Route("/articles", name="article.index")
     * @return Response
     */
    public function index(Request $request): Response
    {

        $search = new ArticleSearch();
        $form = $this->createForm(ArtcileSerchType::class, $search);
        $form->handleRequest($request);

        $articles = $this->repository->findAllVisibleQuery($search);
        //$articles = $this->repository->findAll($search);
        $all_articles = $this->repository->findAll();
        dump($articles);
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
            //'all_articles' => $all_articles,
            'current_menu' => 'articles',
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/articles/{id}", name="article.show")
     * @return Response
     */
    public function show($id): Response
    {
        $article = $this->repository->find($id);
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'current_menu' => 'articles'
        ]);
    }

    /**
     * @Route("/articles_search", name="")
     * @param Request $request
     * @return Response
     */
    public function search(Request $request)
    {
        $search = new ArticleSearch();
        $form = $this->createForm(ArtcileSerchType::class, $search);
        $form->handleRequest($request);

        $articles_search = $this->repository->findAllVisibleQuery($search);
        dump($articles_search);
        return $this->render('article/index.html.twig', [
            'articles_search' => $articles_search,
            'current_menu' => 'articles',
            'form' => $form->createView()
        ]);
    }

}