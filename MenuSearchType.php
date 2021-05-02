<?php

namespace App\Form;

use App\Entity\MenuSerach;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Menu;

class MenuSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('menu',EntityType::class,['class' => Menu::class,
            'choice_label' => 'Entree' ,
            'label' => 'menu' ]);
        ;
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MenuSerach::class,
        ]);
    }
}
