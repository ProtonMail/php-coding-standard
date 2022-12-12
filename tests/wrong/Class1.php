<?php


namespace Test;

use Something\Foo;

use Something\bar;

abstract final class Test {

	private $unused_field;

    const TEST = 'NOTOK';

    use MyTrait, MyTrait2;

    public function __construct()
    {
        echo `test`;

        phpinfo2();

        print_r([
            1
          ]);

        $this->test = new class() {
        };

        call_user_func(fn() => {});
    }

    private function unused() {
        $fooBar = 1;
    	$foo_bar = '1';;

    	IF($foo_bar == '1') {
    		return true;
    		return true;
    	}

    	$this->foo(
    	    'a',
            2
        );
    }

    /**
     * @param string $a
     * @deprecated
     */
    private static function Foo(string $a, $b, $c) : array |object
    {
        return [$a, $b];
    }

    private function testUnion(null|float|int|string $a,): null|int|float
    {
        return 1;
    }

    private function testAssignmentInCondition(int $a): void {
        if ($a == 1 && $b = 2) {
            $c = 3;
        }

        $c == 3 && $d = 4;
    }
}