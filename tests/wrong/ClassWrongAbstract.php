<?php

declare(strict_types=1);

namespace wrong;

abstract class ClassWrongAbstract
{

    abstract public function setOne(int $one = 1): void;

    public function getOne(): int
    {
        return 1;
    }
}
