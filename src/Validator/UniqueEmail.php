<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

class UniqueEmail extends Constraint
{
    /**
     * @Annotation
     */
    public string $message = 'This email already exist';

}

