<?php

namespace App\Validator;

use App\Repository\ConfigRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EmailDomainValidator extends ConstraintValidator
{
    private array $globalBlockedDomains = [];

    public function __construct(
        private ConfigRepository $configRepository,
        $globalBlockedDomains = ''
    ) {
        $this->globalBlockedDomains = explode(',', $globalBlockedDomains);
    }

    public function validate($value, Constraint $constraint)
    {
        /* @var App\Validator\EmailDomain $constraint */

        if (null === $value || '' === $value) {
            return;
        }

        $domain = substr($value, strpos($value, '@') + 1);
        $blockedDomain = array_merge(
            $constraint->blocked,
            $this->configRepository->getAsArray('blocked_domains'),
            $this->globalBlockedDomains
        );

        if (in_array($domain, $blockedDomain)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
