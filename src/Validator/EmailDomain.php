<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class EmailDomain extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'The value "{{ value }}" is not valid.';

    public $blocked = [];

    public function __construct($options = null)
    {
        parent::__construct($options);
        if (!is_array($options['blocked'])) {
            throw new ConstraintDefinitionException('The "blocked" option must be an array of blocked domain');
        }
    }

    public function getRequiredOptions(): array
    {
        return ['blocked'];
    }
}
