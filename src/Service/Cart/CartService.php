<?php


namespace App\Service\Cart;


use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    //conteneur
    protected $session;
    protected $articleRepository;

    public function __construct(SessionInterface $session, ArticleRepository $articleRepository)
    {
        $this->session = $session;
        $this->articleRepository = $articleRepository;
    }



    public function add(int $id)
    {
        //récupere le panier
        $panier = $this->session->get('panier', []);

        //Si j'ai deja un produit avec le meme id et add
        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }
        //sauvegarde l'etat du panier actuel
        $this->session->set('panier', $panier);

    }


    public function remove(int $id)
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }
        $this->session->set('panier', $panier);
        //dump($this->session->set('panier', $panier));
    }


    public function getFullCart(): array
    {
        $panier = $this->session->get('panier', []);

        $panierWithData = [];

        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'articles' => $this->articleRepository->find($id),
                'quantity' => $quantity
            ];
        }
        //dump($panierWithData);
        return $panierWithData;
    }

    public function getTotal(): float
    {
        $total = 0;
        dump('coucou');
        dump($total);
        dump("fin");

        foreach ($this->getFullCart() as $item) {
            //$total += $item['articles']->getPrix() * $item['quantity'];
           // $total += $item['articles']->getPrix() * $item['quantity'];

        }
        dump($total);

        return $total;
    }
}