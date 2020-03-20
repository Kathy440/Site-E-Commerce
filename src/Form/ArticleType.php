<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('prix')
            ->add('couleur', ChoiceType::class, [
                'choices' => $this->getChoicesCouleurs()
            ])
            ->add('promotion')
            ->add('categorie', ChoiceType::class, [
                'choices' => $this->getChoicesCategories()
            ])
            //->add('address')
            ->add('sold')
            ->add('image_article')
            ->add('poids')
            ->add('capacite')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'translation_domain' => 'forms'
        ]);
    }

    private function getChoicesCouleurs()
    {
        $choices = Article::COULEUR;
        $output = [];
        foreach ($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }

    private function getChoicesCategories()
    {
        $choices = Article::CATEGORIE;
        $output = [];
        foreach ($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }
}
