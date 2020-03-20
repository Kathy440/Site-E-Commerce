<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\ArticleSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtcileSerchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('couleur', ChoiceType::class, [
                'choices' => $this->getChoicesCouleurs(),
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Couleurs'
                ]
            ])*/
            ->add('categorie', ChoiceType::class, [
                'choices' => $this->getChoicesCategories(),
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Categories'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
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

    private function getChoicesCouleurs()
    {
        $choices = Article::COULEUR;
        $output = [];
        foreach ($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
