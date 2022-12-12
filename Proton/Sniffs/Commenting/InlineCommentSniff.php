<?php

declare(strict_types=1);

namespace Proton\Sniffs\Commenting;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class InlineCommentSniff implements Sniff
{
    /**
     * @inheritDoc
     */
    public function register()
    {
        return [T_COMMENT];
    }

    /**
     * @inheritDoc
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[$stackPtr]['content'][0] === '#') {
            $phpcsFile->recordMetric($stackPtr, 'Inline comment style', '# ...');

            $error = 'Perl-style comments are not allowed. Use "// Comment."';
            $error .= ' or "/* comment */" instead.';
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'WrongStyle');
            if ($fix === true) {
                $newComment = ltrim($tokens[$stackPtr]['content'], '# ');
                $newComment = '// ' . $newComment;
                $phpcsFile->fixer->replaceToken($stackPtr, $newComment);
            }
        } elseif ($tokens[$stackPtr]['content'][0] === '/'
            && $tokens[$stackPtr]['content'][1] === '/'
        ) {
            $phpcsFile->recordMetric($stackPtr, 'Inline comment style', '// ...');

            $this->checkMissingSpaceSeparator($tokens[$stackPtr]['content'], $phpcsFile, $stackPtr);
        } elseif ($tokens[$stackPtr]['content'][0] === '/'
            && $tokens[$stackPtr]['content'][1] === '*'
        ) {
            $phpcsFile->recordMetric($stackPtr, 'Inline comment style', '/* ... */');

            $this->checkMissingSpaceSeparator($tokens[$stackPtr]['content'], $phpcsFile, $stackPtr);
        }
    }

    private function checkMissingSpaceSeparator(string $content, File $phpcsFile, int $stackPtr): void
    {
        if ($content[2] === ' ') {
            return;
        }

        $error = 'Missing space between comment start and comment description.';
        $fix = $phpcsFile->addFixableError($error, $stackPtr, 'WrongStyle');
        if ($fix === true) {
            $type = substr($content, 0, 2);
            $newComment = sprintf("%s %s", $type, ltrim($content, $type));
            $phpcsFile->fixer->replaceToken($stackPtr, $newComment);
        }
    }
}
