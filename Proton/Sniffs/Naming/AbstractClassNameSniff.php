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
        return [T_CLASS];
    }

    public function process(File $phpcsFile, $stackPtr): void
    {
        if (!TokenHelper::findPrevious($phpcsFile, T_ABSTRACT, $stackPtr)) {
            return;
        }

        $tokens = $phpcsFile->getTokens();

        $opener = $tokens[$stackPtr]['scope_opener'];
        $nameStart = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), $opener, true);
        $nameEnd = $phpcsFile->findNext([T_WHITESPACE, T_COLON], $nameStart, $opener);
        if ($nameEnd === false) {
            $name = $tokens[$nameStart]['content'];
        } else {
            $name = trim($phpcsFile->getTokensAsString($nameStart, ($nameEnd - $nameStart)));
        }


        if (substr($name, 0, 8) !== 'Abstract') {
            $phpcsFile->addError(
                'An abstract class should always start with `Abstract`',
                $nameStart,
                'Found',
            );
        }
    }
}
