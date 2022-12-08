<?php

declare(strict_types=1);

namespace Proton\Sniffs\Naming;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use SlevomatCodingStandard\Helpers\TokenHelper;

class InterfaceNameSniff implements Sniff
{
    public function register(): array
    {
        return [T_INTERFACE];
    }

    public function process(File $phpcsFile, $stackPtr): void
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[$stackPtr]['code'] !== T_INTERFACE) {
            return;
        }

        $opener = $tokens[$stackPtr]['scope_opener'];
        $nameStart = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), $opener, true);
        $nameEnd = $phpcsFile->findNext([T_WHITESPACE, T_COLON], $nameStart, $opener);
        if ($nameEnd === false) {
            $name = $tokens[$nameStart]['content'];
        } else {
            $name = trim($phpcsFile->getTokensAsString($nameStart, ($nameEnd - $nameStart)));
        }

        if (substr($name, strlen($name) - 9, 9) !== 'Interface') {
            $phpcsFile->addError(
                'An interface should always end with `Interface`',
                $nameStart,
                'Found',
            );
        }

    }
}
