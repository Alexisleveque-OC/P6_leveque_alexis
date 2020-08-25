<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class LinkIsValidValidator extends ConstraintValidator
{
    /**
     * @inheritDoc
     * @Annotation
     */
    public function validate($url, Constraint $constraint)
    {
        if (!$constraint instanceof LinkIsValid) {
            throw new UnexpectedTypeException($constraint, LinkIsValid::class);
        }

        if (preg_match('#^https:\/\/youtu\.be#', $url)
            || preg_match('#^https:\/\/dai\.ly#', $url)) {
            return true;
        }
        if (preg_match('#^https:\/\/youtube\.com\/embed#', $url)
            || preg_match('#^https:\/\/dailymotion\.com\/embed\/video#', $url)) {
            return true;
        }


        $this->context->buildViolation($constraint->message)
            ->setParameter('%string%', $url)
            ->addViolation();
        return false;
    }
}