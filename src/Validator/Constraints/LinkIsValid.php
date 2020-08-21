<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;


/**
 * Class LinkIsValid
 * @package App\Validator
 * @Annotation
 */
class CountWithoutHtmlTag extends Constraint
{
    public $message = 'Votre texte n\'est pas assez long. Vous devez rentrer au moins {{limit}} caractères.';
    public $min;

    public function __construct($options = null)
    {
        if (null !== $options && !\is_array($options)) {
            $options = [
                'min' => $options,
            ];
        }
        parent::__construct($options);
    }
}