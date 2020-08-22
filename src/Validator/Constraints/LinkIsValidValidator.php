<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class LinkIsValidValidator extends ConstraintValidator
{
    /**
     * @inheritDoc
     * @Annotation
     */
    public function validate($values, Constraint $constraint)
    {
        if (!$constraint instanceof LinkIsValid) {
            throw new UnexpectedTypeException($constraint, LinkIsValid::class);
        }
        foreach ($values as $video) {
            $url = $video->getIFrame();
            if (preg_match('#^https:\/\/youtu.be#', $url)
                || preg_match('#^https:\/\/dai.ly#', $url))
            {
                return true;
            }
            if (!preg_match('#^https:\/\/youtu.be#', $url) || !preg_match('#^https:\/\/dai.ly#', $url)) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('%string%',$url)
                    ->addViolation();
            }
        }
    }
}