<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * Class CountWithoutHtmlTag
 * @package App\Validator
 * @Annotation
 */
class CountWithoutHtmlTag extends Constraint
{
    public $message = "Votre texte doit contenir au moins 5 caractères";
}