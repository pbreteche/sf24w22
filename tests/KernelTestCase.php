<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase as SfKernelTestCase;

/**
 * Workaround
 * https://github.com/symfony/symfony/issues/53812
 *
 * Fix this error:
 * "Test code or tested code did not remove its own exception handlers"
 */
class KernelTestCase extends SfKernelTestCase
{
    protected function restoreExceptionHandler(): void
    {
        while (true) {
            $previousHandler = set_exception_handler(static fn() => null);

            restore_exception_handler();

            if ($previousHandler === null) {
                break;
            }

            restore_exception_handler();
        }
    }
}