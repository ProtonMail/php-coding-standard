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

    /**
     * Method comment
     */
    #[Attribute1, Attribute2('var')]
    #[Attribute3(), Attribute4]
    public function method(
        /** @param int $parameter */
        #[Attribute1] #[Attribute2] #[Attribute3]
        #[Attribute4] #[Attribute5] #[Attribute6]
        int $parameter,
    ): void {
        echo $parameter;
    }
}
