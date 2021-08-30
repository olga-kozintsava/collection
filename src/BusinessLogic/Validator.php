<?php

namespace App\BusinessLogic;

use Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validator
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    /**
     * @param $data
     * @throws Exception
     */
    public function validate($data): void
    {
        $violationList = $this->validator->validate($data);
        if ($violationList->count() > 0) {
            throw new Exception((string)$violationList);
        }
    }
}