<?php

namespace App\Tests\Validator;

use App\Repository\ConfigRepository;
use App\Validator\EmailDomain;
use App\Validator\EmailDomainValidator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

class EmailDomainValidatorTest extends TestCase
{
    public function getValidator($expectedViolation = false, $dbBlockedDomain = [])
    {
        $repository = $this->getMockBuilder(ConfigRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repository->expects($this->any())
            ->method('getAsArray')
            ->with('blocked_domains')
            ->willReturn($dbBlockedDomain);

        /** @var ConfigRepository $repository */
        $validator = new EmailDomainValidator($repository);

        $context = $this->getContext($expectedViolation);

        /* @var ExecutionContextInterface $context */
        $validator->initialize($context);

        return $validator;
    }

    public function testCatchBadDomains()
    {
        $constraint = new EmailDomain([
            'blocked' => ['baddomain.fr', 'aze.com'],
        ]);

        $this->getValidator(true)->validate('demo@baddomain.fr', $constraint);
    }

    public function testCatchGoodDomains()
    {
        $constraint = new EmailDomain([
            'blocked' => ['baddomain.fr', 'aze.com'],
        ]);

        $this->getValidator(false)->validate('demo@gooddomain.fr', $constraint);
    }

    public function testBlockedDomainFromDatabase()
    {
        $constraint = new EmailDomain([
            'blocked' => ['baddomain.fr', 'aze.com'],
        ]);

        $this->getValidator(true, ['baddbdomain.fr'])->validate('demo@baddbdomain.fr', $constraint);
    }

    /*
    public function testParameterSetCorrectly()
    {
        $constraint = new EmailDomain([
            'blocked' => []
        ]);

        self::bootKernel();
        $validator = self::getContainer()->get(EmailDomainValidator::class);

        $validator->initialize($this->getContext(true));
        $validator->validate('demo@globalblocked.fr', $constraint);
    }
    **/
    private function getContext(bool $expectedViolation): ExecutionContextInterface
    {
        $context = $this->getMockBuilder(ExecutionContextInterface::class)->getMock();

        if ($expectedViolation) {
            $violiation = $this->getMockBuilder(ConstraintViolationBuilderInterface::class)->getMock();
            $violiation
                ->expects($this->any())
                ->method('setParameter')->willReturn($violiation);
            $violiation
                ->expects($this->once())
                ->method('addViolation');

            $context
                ->expects($this->once())
                ->method('buildViolation')
                ->willReturn($violiation);
        } else {
            $context
                ->expects($this->never())
                ->method('buildViolation');
        }

        /* @var ExecutionContextInterface $context */
        return $context;
    }
}
