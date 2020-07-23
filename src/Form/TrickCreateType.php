<?php

namespace App\Form;

use App\Entity\Group;
use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\User;
use App\Entity\Video;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('groupName', EntityType::class, [
                'label' => 'Nom du groupe de figure',
                'class' => Group::class,
                'choice_label' => 'title'
            ])
//            ->add('images',EntityType::class,[
//                'class'=>Image::class
//            ])
//            ->add('videos',EntityType::class,[
//                'class'=>Video::class
//            ])
//            ->add('save',ButtonType::class,[ 'attr'=>[
//                'class' => 'btn btn-primary'
//            ]])
//            ->add('user', EntityType::class, [
//                'class' => User::class
//            ])
        ;
//
//        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
//            $group = $event->getData();
//            $form = $event->getForm();
//            if (!$group || null === $group->getId()) {
//                $form->add('groupTitle')
//                    ->add('groupDescription');
//            }
//        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
