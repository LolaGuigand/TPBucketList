<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Wish;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
/*use Symfony\Component\Form\SubmitButton;*/
use Symfony\Component\OptionsResolver\OptionsResolver;

class WishFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, ['label' => 'Titre du Wish'] )
            ->add('description',null,['label'=>'Description'] )
            ->add('author', null, ['label' => 'Auteur'])
            ->add('category', EntityType::class, [
                'label'=>'Catégorie',
                'class' => Category::class,
                'choice_label' => 'name',
                // expanded:false= liste déroulante
                'expanded'=>false,
                //multiple:false = sélection unique
                'multiple'=>false,
                ])

/*            ->add('envoyer', SubmitButton::class)*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Wish::class,
        ]);
    }
}
