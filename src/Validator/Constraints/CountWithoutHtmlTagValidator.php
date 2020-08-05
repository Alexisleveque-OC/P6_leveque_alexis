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
        $lenght = strlen(strip_tags($value));

        if(!is_int($lenght)){
            throw new UnexpectedValueException($lenght,'string');
        }

        if ($lenght < $constraint->min) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%',$lenght)
                ->setParameter('{{limit}}',$constraint->min)
                ->addViolation();
        }
    }
}