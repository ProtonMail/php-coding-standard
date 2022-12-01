<?php

declare(strict_types=1);

namespace Proton\Sniffs\Naming;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use SlevomatCodingStandard\Helpers\TokenHelper;

class InterfaceNameSniff implements Sniff
{
    public function register()
    {
        return [T_INTERFACE];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        
        if ($tokens[$stackPtr]['code'] === T_INTERFACE) {
            $namePointer = TokenHelper::findNext($phpcsFile, T_STRING, $stackPtr + 1);
            $className   = $tokens[$namePointer]['content'];

            if (substr($className, strlen($className) - 9, 9) !== 'Interface') {
                $phpcsFile->addError(
                    'An interface should always end with `Interface`',
                    $namePointer,
                    'Found'
                );
            }
        }
    }
}
