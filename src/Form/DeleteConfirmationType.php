<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormBuilderInterface;

class DeleteConfirmationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('save',ButtonType::class,[ 'attr'=>[
                'class' => 'btn btn-primary',
                'value' => 'Oui je veux supprimer ce trick'
            ]])
        ;
    }
}
