<?php

declare(strict_types=1);

namespace Proton\Test;

use Proton\Http\Request;
use function Proton\Support\phpinfo2;

final class ClassOk
{
    use MyTrait;

    /**
     * Foo.
     * @var array
     */
    protected $foo = [];

    public function __construct(array $config)
    {
        $this->foo = $config + [
            'foo' => 'bar',
        ];

        phpinfo2();

        call_user_func(fn () => {});
    }

    public function ping(Request $request)
    {
        try {
            $this->foo(
                'a',
                'b',
            );
        } catch (\RuntimeException) {
            // ...
        }

        return $request->query->get('test');
    }

    /**
     * @deprecated This is a message
     * @return bool|string
     */
    public function foo(string $a, string $b)
    {
        $a = $a . 'test';

        if ($a === $b) {
            return true;
        }

        /** @var string|null $foo */
        $foo = $this->foo['a'] ?? null;

        if (
            $a === 'a'
            || $b === 'b'
        ) {
            return $foo;
        }

        if ($a === 'z') {
            throw new \RuntimeException();
        }

        return false;
    }

    public static function create(
        string $name,
        string|int|float|null $defaultValue = null,
    ): string|int|float|null|array|object {
        return match ($name) {
            'foo' => [1, 2, 3],
            'bar' => [],
            default => $defaultValue,
        };
    }
}
