<?php

declare(strict_types=1);

namespace Proton\Sniffs\Spacing;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class ArrowFunctionSpacingSniff implements Sniff
{
    /**
     * @inheritDoc
     */
    public function register(): array
    {
        return [T_FN];
    }

    /**
     * @inheritDoc
     */
    public function process(File $phpcsFile, $stackPtr): void
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[$stackPtr]['code'] === T_FN && $tokens[$stackPtr + 1]['code'] !== T_WHITESPACE) {
            $phpcsFile->addError(
                'The fn arrow function token should always be followed by a space.',
                $stackPtr,
                'Found',
            );
        }
    }
}
