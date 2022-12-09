<?php

declare(strict_types=1);

namespace wrong;

trait TraitInvalid
{
    public function getOne(): int
    {
        return 1;
    }
}
