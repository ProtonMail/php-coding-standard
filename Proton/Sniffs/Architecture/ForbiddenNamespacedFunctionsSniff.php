<?php

declare(strict_types=1);

namespace Proton\Sniffs\Architecture;

use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\ForbiddenFunctionsSniff;
use SlevomatCodingStandard\Helpers\NamespaceHelper;

class ForbiddenNamespacedFunctionsSniff extends ForbiddenFunctionsSniff
{
    /**
     * @inheritDoc
     */
    protected function addError($phpcsFile, $stackPtr, $function, $pattern = null): void
    {
        $fqfn = NamespaceHelper::resolveName($phpcsFile, $function, 'function', $stackPtr);
        $canonicalName = NamespaceHelper::normalizeToCanonicalName($fqfn);

        $currentNS = NamespaceHelper::findCurrentNamespaceName($phpcsFile, $stackPtr);
        $canonicalFunction = NamespaceHelper::normalizeToCanonicalName($currentNS . '\\' . $function);

        if ($canonicalName ===  $canonicalFunction) {
            parent::addError($phpcsFile, $stackPtr, $function, $pattern);
        }
    }
}
