<?php

namespace App\Form;

use App\Entity\Group;
use App\Entity\Trick;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickCreateType extends PictureType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('name')
            ->add('description', TextareaType::class, [
                'label' => 'Description du trick',
                'required' => false,
                'attr' => [
                    'class' => 'tinymce'
                ]
            ])
            ->add('groupName', EntityType::class, [
                'label' => 'Nom du groupe de figure',
                'class' => Group::class,
                'choice_label' => 'title'
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
            'empty_data' => function (FormInterface $form) {
                return new Trick();
            }
        ]);
    }
}
