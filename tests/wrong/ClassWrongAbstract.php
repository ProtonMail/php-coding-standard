<?php

declare(strict_types=1);


namespace wrong;

use RuntimeException;

/**
 * Class ClassWrongAbstract
 */
abstract class ClassWrongAbstract
{

    abstract public function setOne(int $one = 1): void;

    /**
     * one getter.
     *
     * Created by me.
     * User: me
     * Date: now
     * Time: now
     *
     */
    public function getOne(): int
    {
        //There should be a space separator
        return 1;
    }

    #[Attribute1, Attribute2('var')]
    #[Attribute3(), Attribute4]
    /**
     * Method comment
     */
    public function method(
        #[Attribute1] #[Attribute2] #[Attribute3]
        #[Attribute4] #[Attribute5] #[Attribute6]
        /** @param int $parameter */
        int $parameter,
    ): void {
        /*There should be a space separator*/
        echo $parameter;
        # This comment is not allowed
        #This is wrong, too
        //
        /**/

        //
        //The space is missing again
        //
    }
}
