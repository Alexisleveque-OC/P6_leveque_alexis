<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;


/**
 * Class LinkIsValid
 * @package App\Validator
 * @Annotation
 */
class LinkIsValid extends Constraint
{
    public $message = 'Votre lien n\'est pas valide, regardez les astuces pour intégrer votre vidéo';

    public function __construct($options = null)
    {
        parent::__construct($options);
    }
}