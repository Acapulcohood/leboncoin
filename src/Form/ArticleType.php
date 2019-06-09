<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label'=>'Nom de l\'article'
            ))
            ->add('description', null, array(
            'label'=> 'Description du produit'
            ))
            ->add('category', null, array(
                'label'=> 'Nom de la catégorie'
                ))
            ->add('price', null, array(
                'label'=> 'Prix'
                ))
            ->add('seller', null, array(
                'label'=> 'Vendeur'
                ))
            ->add('image', null, array(
                'label'=> 'Image'
                ))
            ->add('createdAt', null, array(
                'date_widget'=>'single_text',
                'label'=> 'Date d\'ajout'
                ))
            ->add('localisation', null, array(
                'label'=>'localisation'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
