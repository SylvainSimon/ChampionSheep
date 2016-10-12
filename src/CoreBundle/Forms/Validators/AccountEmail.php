<?php

namespace CoreBundle\Forms\Validators;

use Symfony\Component\Validator\Context\ExecutionContextInterface;

class AccountEmail {

    public static function validateUnique($object, ExecutionContextInterface $context, $payload) {
        $objAccount = \LibraryHelper::getAccountRepository()->findOneBy(["email" => $object]);
        if ($objAccount !== null) {
            $context->buildViolation(\TranslationHelper::trans("validator.register.email.unique", [], "validators"))->atPath('email')->addViolation();
        }
    }

}
