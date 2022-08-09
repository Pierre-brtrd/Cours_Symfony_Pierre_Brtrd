<?php

namespace App\Tests\Validator;

use App\Validator\EmailDomain;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\MissingOptionsException;

class EmailDomainTest extends TestCase
{
    public function testRequiredParameters()
    {
        $this->expectException(MissingOptionsException::class);

        new EmailDomain();
    }

    public function testBadShapedBlockedParameter()
    {
        $this->expectException(ConstraintDefinitionException::class);

        new EmailDomain(['blocked' => 'sjkhdfkjshdf']);
    }

    public function testOptionIsSetAsProperty()
    {
        $arr = ['a', 'b'];
        $domain = new EmailDomain(['blocked' => $arr]);
        $this->assertEquals($arr, $domain->blocked);
    }
}
