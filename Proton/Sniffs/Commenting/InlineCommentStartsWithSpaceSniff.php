<?php

declare(strict_types=1);

namespace Proton\Sniffs\Commenting;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class InlineCommentStartsWithSpaceSniff implements Sniff
{
    /**
     * @inheritDoc
     */
    public function register(): array
    {
        return [T_COMMENT];
    }

    /**
     * @inheritDoc
     */
    public function process(File $phpcsFile, $stackPtr): void
    {
        $tokens = $phpcsFile->getTokens();
        $content = $tokens[$stackPtr]['content'];

        switch (true) {
            case $content[0] === '#':
                $commentStyle = '#';
                break;
            case $content[0] === '/' && $content[1] === '/':
                $commentStyle = '//';
                break;
            case $content[0] === '/' && $content[1] === '*':
                $commentStyle = '/*';
                break;
            default:
                return;
        }

        $phpcsFile->recordMetric($stackPtr, 'Inline comment style', $commentStyle . '...');

        $this->checkMissingSpaceSeparator($commentStyle, $content, $phpcsFile, $stackPtr);
    }

    private function checkMissingSpaceSeparator(string $style, string $content, File $phpcsFile, int $stackPtr): void
    {
        $styleLength = strlen($style);
        if (trim($content) === $style || $content[$styleLength] === ' ') {
            return;
        }

        $error = 'Missing space between comment start and comment description.';
        $fix = $phpcsFile->addFixableError($error, $stackPtr, 'WrongStyle');
        if ($fix === true) {
            $type = substr($content, 0, $styleLength);
            $newComment = sprintf("%s %s", $type, ltrim($content, $type));
            $phpcsFile->fixer->replaceToken($stackPtr, $newComment);
        }
    }
}
