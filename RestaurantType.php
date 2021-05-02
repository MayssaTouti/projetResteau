<?php

namespace App\Form;

use App\Entity\Menu;
use App\Entity\Restaurant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('IdResto')
            ->add('NomResto')
            ->add('Adresse')
            ->add('Telephone')
            ->add('NomChef')
            ->add('NbEtoile')
            ->add('menu',EntityType::class,['class' => Menu::class,
 'choice_label' => 'entree','label' => 'menu']);
}
        
 

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class,
        ]);
    }
}
