<?php

declare(strict_types=1);

namespace Proton\Sniffs\Naming;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use SlevomatCodingStandard\Helpers\TokenHelper;

class AbstractClassNameSniff implements Sniff
{
    public function register(): array
    {
        return [T_ABSTRACT];
    }

    public function process(File $phpcsFile, $stackPtr): void
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[$stackPtr]['code'] === T_ABSTRACT) {
            $namePointer = TokenHelper::findNext($phpcsFile, T_STRING, $stackPtr + 1);

            if (substr($tokens[$namePointer]['content'], 0, 8) !== 'Abstract') {
                $phpcsFile->addError(
                    'An abstract class should always start with `Abstract`',
                    $namePointer,
                    'Found',
                );
            }
        }
    }
}
