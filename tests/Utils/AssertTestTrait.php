<?php

namespace App\Tests\Utils;

use Symfony\Component\Validator\ConstraintViolation;

trait AssertTestTrait
{
    public function assertHasErrors(mixed $entity, int $number = 0): void
    {
        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($entity);

        $messages = [];

        /** @var ConstraintViolation $error */
        foreach ($errors as $error) {
            $messages[] = $error->getPropertyPath().' -> '.$error->getMessage();
        }

        $this->assertCount($number, $errors, implode(', ', $messages));
    }
}
