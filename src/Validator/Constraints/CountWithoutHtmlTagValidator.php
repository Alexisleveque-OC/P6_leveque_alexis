<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class CountWithoutHtmlTagValidator extends ConstraintValidator
{

    /**
     * @inheritDoc
     * @Annotation
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof CountWithoutHtmlTag) {
            throw new UnexpectedTypeException($constraint, CountWithoutHtmlTag::class);
        }
//        $newValue = str_replace('<','',$value);
        $newValue = preg_replace('#<[^>]+>#', '', $value);

        if(!is_string($newValue)){
            throw new UnexpectedValueException($newValue,'string');
        }
        $counter = strlen($newValue);

        if ($counter < 5) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%',$newValue)
                ->addViolation();
        }
    }
}