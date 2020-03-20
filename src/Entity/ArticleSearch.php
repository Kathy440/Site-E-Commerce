<?php


namespace App\Entity;


class ArticleSearch
{
    const COULEUR = [
        0 => 'Noir',
        1 => 'Or',
        2 => 'Gris',
        3 => 'Vert',
        4 => 'Rouge',
        5 => 'Bleu',
        6 => 'Blanc'
    ];

    const CATEGORIE = [
        0 => 'Smartphone',
        1 => 'Smartphone reconditionner',
        3 => 'Télévisions',
        4 => 'Casque sans fil',
        5 => 'Enceintes ',
    ];

    /**
     * @var int|null
     */
    private $maxPrix;

    /**
     * @var int|null
     */
    private $couleur;

    /**
     * @return int|null
     */
    public function getCouleur(): ?int
    {
        return $this->couleur;
    }

    /**
     * @param int|null $couleur
     * @return ArticleSearch
     */
    public function setCouleur(int $couleur): ArticleSearch
    {
        $this->couleur = $couleur;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxPrix(): ?int
    {
        return $this->maxPrix;
    }


    /**
     * @param int|null $maxPrix
     * @return ArticleSearch
     */
    public function setMaxPrix(int $maxPrix): ArticleSearch
    {
        $this->maxPrix = $maxPrix;
        return $this;
    }

    /**
     * @var int|null
     */
    private $categorie;

    /**
     * @return int|null
     */
    public function getCategorie(): ?int
    {
        return $this->categorie;
    }

    /**
     * @param int|null $categorie
     * @return ArticleSearch
     */
    public function setCategorie(int $categorie): ArticleSearch
    {
        $this->categorie = $categorie;
        return $this;
    }

    public function getCategorieType(): string
    {
        return self::CATEGORIE[$this->categorie];
    }
}