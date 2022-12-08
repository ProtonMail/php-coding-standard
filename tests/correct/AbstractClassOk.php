<?php

declare(strict_types=1);

namespace Proton\Test;

abstract class AbstractClassOk
{
    abstract public function setOne(int $one = 1): void;

    public function getOne(): int
    {
        return 1;
    }
}
